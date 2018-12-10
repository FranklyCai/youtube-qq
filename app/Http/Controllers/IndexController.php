<?php

namespace App\Http\Controllers;
include app_path().'/includes/ChromePhp.php';
use App\IndexVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\VideoType;
use ChromePhp;
class IndexController extends Controller
{
    public function index(Request $request){
//        $arr = [];
//        $subjects = VideoType::leftJoin('index_videos','video_types.ecode','=','index_videos.video_type')->select(['ecode','ename','cname','title','desc','img'])->orderBy('ecode')->get();
//        foreach ($subjects as $subject){
//            array_push($arr[$subject->ename],$subject->title,$subject->);
//        }
//        ChromePhp::log($request->root());
        $types = VideoType::all();
        $subjects = [];
        foreach ($types as $type){
//            ChromePhp::table($types);
//            ChromePhp::table($type);
//            $subjects[$type->ename] = $type->indexVideos->query()->limit(3)->get();
            $subjects[$type->ename] = IndexVideo::where('video_type',$type->ename)->orderBy('id','desc')->limit(7)->get();
        }
//        ChromePhp::log($subjects);
//        dd($subjects);
        return view('index',['types'=>$types,'subjects'=>$subjects]);
    }
}
