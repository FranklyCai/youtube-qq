@extends('layouts.master')
@section('title',"腾讯视频 - $video->videoName")
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bundle.css')}}">
@endsection
@section('content')
    <div class="video-page bg-primary">
        @component('components.nav')@endcomponent
        <div class="video-page-container">
            @component('components.plyr',['video'=>$video])
            @endcomponent
            @component('components.comment-box')
            @endcomponent
            @component('components.separator')
            @endcomponent
                @if(!empty($comments))
            @component('components.comment',["comments"=>$comments])
                @else
            @component('components.comment')
                @endif
            @endcomponent

        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('js/video_bundle.js')}}"></script>
@endsection