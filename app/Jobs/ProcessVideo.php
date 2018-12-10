<?php

namespace App\Jobs;

use App\IndexVideo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $storeResult;
    protected $extension;
    protected $offset;
    protected $video;
    protected $play_time;
    protected $imgName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($storeResult,$extension,$offset,$video,$play_time,$imgName)
    {
        $this->storeResult=$storeResult;
        $this->extension=$extension;
        $this->offset =$offset;
        $this->video =$video;
        $this->play_time=$play_time;
        $this->imgName=$imgName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //视频信息是否已经添加到首页
        $flag = false;

        $time_array = explode(':',$this->play_time);
        $play_seconds = $time_array[0]*60+$time_array[1];

        $video_storage_path = storage_path().'/app/'.$this->storeResult;

        /*如果用户没有上传视频封面，则使用ffmpeg截取封面*/
        if(!empty($this->imgName)){
            $imgPath = public_path("img/".$this->video->type."/".$this->imgName);
            $thumbName = Str::random(40).'.jpeg';
            $thumbPath = public_path("img/".$this->video->type."/".$thumbName);
            $cmd = "ffmpeg -i $imgPath -vf scale=220:308 $thumbPath";
            exec($cmd);
        }else{
            $thumbName = Str::random(40).'.jpg';
            $cmd = "ffmpeg -i $video_storage_path -vframes 1 -q:v 3 -s 220x308 ".public_path("img/".$this->video->type."/".$thumbName);
            exec($cmd,$output,$return);
        }
        /*生成缩略图和精灵图*/
        $url = $this->video->url;
        $subFolder = storage_path()."/app/uploads/temp/$url/";
        for($index=1,$s=0,$ss=0,$time_gap=8*8*5,$t=$time_gap+$ss-1;
            $s<$play_seconds;
            $index++,$s+=8*8*5,$ss+=$time_gap,$t=$ss+$time_gap-1)
        {
            if(!File::isDirectory($subFolder)){
                mkdir($subFolder,0777,true);
            }
            $frame_cmd = "ffmpeg -i $video_storage_path -ss $ss -t $t -vf fps=1/5 -s 180x120 $subFolder%02d.jpg";
            exec($frame_cmd);
            $sprite_cmd = "ffmpeg -i $subFolder%02d.jpg -filter_complex tile=8x8 ".storage_path()."/app/uploads/formatted/$url-".str_pad($index,2,0,0).".jpg";
            exec($sprite_cmd);
            File::deleteDirectory(storage_path()."/app/uploads/temp/$url");
        }
//        出错处理代码
//        if($return){}

        //使用glue生成图片精灵
//        exec('glue '.storage_path()."/app/uploads/temp/$url ".storage_path()."/app/uploads/formatted --project");
//        File::deleteDirectory(storage_path()."/app/uploads/temp/$url");




        /*生成vtt文件*/
        $sprite_index = 1;
        $webvtt = "WEBVTT\n\n";
        $currentHour = 0;
        $currentMinute = 0;
        $currentSecond = 0;
        $row_index = 1;
        $column_index = 0;
        $w = 180;
        $h = 120;
        for($index = 0;$index<=$play_seconds;$index+=5){
            $column_index++;
            if($column_index>8){
                $column_index=1;
                $row_index++;
                if($row_index>8){
                    $row_index=1;
                    $sprite_index++;
                }
            }
            $hours = str_pad($currentHour,2,0,STR_PAD_LEFT);
            $minutes = str_pad($currentMinute,2,0,STR_PAD_LEFT);
            $seconds = str_pad($currentSecond,2,0,STR_PAD_LEFT);
            $start = "$hours:$minutes:$seconds.000";
            $currentSecond+=5;
            if($currentSecond>=60){
                $currentSecond-=60;
                $currentMinute+=1;
                if($currentMinute>=60){
                    $currentMinute-=60;
                    $currentHour+=1;
                }
            }
            $hours = str_pad($currentHour,2,0,STR_PAD_LEFT);
            $minutes = str_pad($currentMinute,2,0,STR_PAD_LEFT);
            $seconds = str_pad($currentSecond,2,0,STR_PAD_LEFT);
            $end = "$hours:$minutes:$seconds.000";
            $symbol = "-->";
            $x = ($column_index-1)*$w;
            $y = ($row_index-1)*$h;
            $row1 = "$start $symbol $end\n";
            $sprite_name = $this->video->url."-".str_pad($sprite_index,2,0,STR_PAD_LEFT).".jpg";
            $row2 = "$sprite_name#xywh=$x,$y,$w,$h\n";
            $webvtt="$webvtt$row1$row2\n";
        }
        File::put(storage_path()."/app/uploads/formatted/$url.vtt",$webvtt);
//
//
//        /*改变视频的分辨率和格式*/
        $resolution_ratio_list_keys = array_keys(config('constants.resolution_ratio_list'));
        $resolution_ratio_list_values = array_values(config('constants.resolution_ratio_list'));
        for($offset=$this->offset;$offset<count($resolution_ratio_list_values);$offset++){
            $current = $resolution_ratio_list_values[$offset];
            $randomname = Str::random(40).'.mp4';
//            $video_storage_path = storage_path().'\app\\'.$this->storeResult;
            $outputPath = storage_path().'/app/uploads/formatted/'.$randomname;
            $this->video[$resolution_ratio_list_keys[$offset]] = url('qq/storage/app/uploads/formatted')."/$randomname";
            $cmd = "ffmpeg -i \"$video_storage_path\" -vf scale=$current[0]:$current[1] \"$outputPath\" -hide_banner";
            exec($cmd,$output,$return);
            if(!$return){
                if(!$flag){
                    $indexVideo = new IndexVideo;
                    $indexVideo->url = $this->video->url;
                    $indexVideo->video_type = $this->video->type;
                    $indexVideo->title = $this->video->videoName;
                    $indexVideo->desc = $this->video->videoDesc;
                    $indexVideo->img = "img/".$this->video->type."/".$thumbName;
                    $indexVideo->save();
                    $flag=true;
                }
                $this->video->save();
            }
            //$output = shell_exec($cmd);
            //echo output不加也可以在控制台看到视频处理的进度
        }
    }
}
