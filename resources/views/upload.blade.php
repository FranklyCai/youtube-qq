@extends('layouts.master')
@section('title','视频上传')
@section('css')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bundle.css')}}">
@endsection
@section('content')
    @component('components.nav')@endcomponent
    <div class="overlay" style="display: none;"></div>
    <span class="loader"></span>
    <div id="progress"></div>
        <div class="jumbotron text-muted mb-0">
            <h1 class="display-4">视频上传</h1>
            <p class="lead">选择您要上传与大家分享的视频</p>
            <hr class="my-4">
            <p>您可以直接点击下方方框选择，也可直接将视频文件拖入方框中</p>
            <button id="dropzone">
                <h1 class="text-muted">拖放文件到此处</h1>
                <h2 class="text-muted">或点击该区域选择文件</h2>
            </button>
            <div id="video-wrapper">
                <form id="upload-form" action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="video" name="video" type="file" accept="video/*" style="display: none;">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">视频名称</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">视频类型</label>
                                <select class="custom-select"  name="type" required>
                                    <option value="" hidden>请选择视频类型...</option>
                                    <option value="cartoon">动漫精选</option>
                                    <option value="movie">电影</option>
                                    <option value="usuk">英美剧</option>
                                    <option value="kr">韩剧</option>
                                    <option value="doco">纪录片</option>
                                    <option value="child">少儿动画</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="desc">视频描述</label>
                        <textarea class="form-control" name="desc" id="desc" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input accept="image/*" type="file" name="poster" class="custom-file-input" id="poster" lang="zh">
                            <label class="custom-file-label font-italic" for="poster">选择一张图片作为视频封面，若不选择默认取视频第一帧 ......</label>
                        </div>
                    </div>
                    <button type="reset" class="btn btn-danger" style="width:30%">重置</button>
                    <button type="submit" class="btn btn-primary" style="width:30%;float:right">提交</button>
                </form>
            </div>
        </div>
@endsection
@section('javascript')
    <script src="{{asset('js/upload_bundle.js')}}"></script>
@endsection