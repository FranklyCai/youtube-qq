<?php

namespace App\Http\Controllers;

include app_path().'/includes/ChromePhp.php';
use Illuminate\Http\Request;
use App\Jobs\ProcessVideo;
use getID3;
use Illuminate\Support\Facades\Auth;
use App\Video;
/*
 * 用于处理用户上传的视频控制器
 */
class UploadController extends Controller
{
    public function upload(Request $request){
        if($request->hasFile('video')&&$request->file('video')->isValid()){
            //使用getID3第三方插件来分析文件，获取视频的分辨率
            $uploadedVideo = $request->file('video');
            $uploadedPoster = $request->file('poster');
            $getID3 = new getID3;
            $file_information = $getID3->analyze($uploadedVideo);
            $play_time = $file_information['playtime_string'];
            $resolution_x = $file_information['video']['resolution_x'];
            $resolution_y = $file_information['video']['resolution_y'];
            $resolution = array($resolution_x,$resolution_y);
            //常见视频分辨率列表
            $resolution_ratio_list_values = array_values(config('constants.resolution_ratio_list'));
            //判断用户上传的视频分辨率是否为常见分辨率
            if($offset = array_search($resolution,$resolution_ratio_list_values)){
                //获取视频后缀扩展名
                $originalName = $uploadedVideo->getClientOriginalName();
                $extension = strrchr($originalName,'.');
                //将视频存储到本地磁盘
                $storage_path = $uploadedVideo->store('uploads');
                //Eloquent ORM
                $video = new Video;
                $video->url = uniqid();
                $video->videoName = $request->name;
                $video->videoDesc = $request->desc;
                $video->user_id = Auth::user()->id;
                $video->upload_path = $storage_path;
                $video->type = $request->type;
                $imgName=null;
                if(!empty($uploadedPoster)){
                    $imgName = $uploadedPoster->hashName();
                    $uploadedPoster->move(public_path("img\\$request->type"),$imgName);
//                    $video->poster = "img/$video->type/$imgName";
                }
                $video->save();
                // //dispatch job
                ProcessVideo::dispatch($storage_path,$extension,$offset,$video,$play_time,$imgName);
            }else{
                //用户上传的视频分辨率不属于常见视频分辨率，要用户再次上传
                echo '您上传的非标准格式';
            }
        }
    }
    /*
     * 第三个参数recursive如果为true,可以一次性创建多级目录。默认是false
     * 相对路径是public，如果前面加/就代表根盘符，如C盘
        public function createFolder(){
            File::makeDirectory('',0755,true);
        }
    */
}
