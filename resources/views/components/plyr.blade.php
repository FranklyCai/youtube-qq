<div style="width:100%;padding-left:1rem;">
<h1 class="text-white">视频：{{$video->videoName}}</h1>
</div>
<div id="container">
    <video controls crossorigin playsinline <?php if(!empty($video->poster)){?>poster="{{asset($video->poster)}}"<?php } ?> id="player">
        <!-- Video files -->
    <?php
    $resolution_ratio_list_keys = array_keys(config('constants.resolution_ratio_list'));
    $resolution_ratio_label = config('constants.resolution_ratio_label');
    for($i=0,$len=count($resolution_ratio_list_keys);$i<$len;$i++){
        if($video[$resolution_ratio_list_keys[$i]]){
            echo "<source src={$video[$resolution_ratio_list_keys[$i]]} type='video/mp4' size={$resolution_ratio_label[$i]}>";
        }
    }
    ?>
    <track kind="metadata" src="{{asset('../storage/app/uploads/formatted').'/'.$video->url.'.vtt'}}" default>
    </video>
</div>
<span id="thumb"></span>
{{--<div class="video-description flex-start bg-warning">--}}
    {{--<h4 class="text-white">视频简介</h4>--}}
    {{--<p>{{$video->videoDesc}}</p>--}}
{{--</div>--}}
<button class="btn btn-info" style="width:100%;text-align: left" data-toggle="collapse" data-target="#videoDesc" id="desc-btn">视频简介(点击以展开)
    <strong class="text-white" id="desc-span" style="float:right;margin-right:.3rem;">+</strong></button>
<div class="collapse" id="videoDesc">
    <div class="card card-body">
        {{$video->videoDesc}}
    </div>
</div>