@extends('layouts.master')
@section('title','腾讯视频-中国领先的在线视频媒体平台,海量高清视频在线观看')
@section('css')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bundle.css')}}">
@endsection
@section('content')
    @component('components.nav')
    @endcomponent
    @component('components.carousel',['films'=>[['title'=>'如懿传','desc'=>'周迅霍建华演绎清宫风云'],['title'=>'幸福三重奏','desc'=>'陈建斌下厨炒蛋'],['title'=>'香蜜沉沉','desc'=>'杨紫邓伦守望千年之恋'],['title'=>'明日之子2','desc'=>'火箭少女助攻战'],['title'=>'择天记4','desc'=>'逆天改命少年长生'],['title'=>'夜天子','desc'=>'徐海乔“骗婚”宋祖儿'],['title'=>'TFBOYS演唱会','desc'=>'824直播'],['title'=>'就匠变新家','desc'=>'为孩子重装洗手间'],['title'=>'火箭少女101研究所','desc'=>'新歌幕后'],['title'=>'中国梦','desc'=>'优秀作品展播']]])
    @endcomponent
    <div id="content">
        <div class="container">
            @foreach($types as $type)
                @foreach($subjects as $index=>$subject)
                    @if($index===$type->ename)
                        @component('components.customCard',['theme'=>[$type->ename.'.png',$type->cname],'cards'=>$subject,'subject'=>$type->ename])
                        @endcomponent
                        @break;
                    @endif
                @endforeach
            @endforeach
            @endsection
        </div>
        @section('javascript')
            <script src="{{asset('js/index_bundle.js')}}"></script>
@endsection