@extends('layouts.master')
@section('title','用户头像')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bundle.css')}}">
@endsection
@section('content')
<div class="avatar-page bg-info">
    <h1 class="text-white">请上传一张照片作为头像</h1>
    <button class="btn btn-warning text-white mt-3" id="choose">从本地选择一张图片</button>
    <input type="file" accept="image/*" style="display: none;">
    <div class="avatar-wrapper"></div>
    <div id="tips" style="color:red;">
        <h6 class="font-weight-bold">提示：鼠标滚轮可以缩放图片大小</h6>
        <h6 class="font-weight-bold">提示：双击中间选区后，可以对图片进行移动</h6>
        <h6 class="font-weight-bold">选区也可以缩放和移动哦^_^</h6>
    </div>
    <button id="crop" class="btn btn-primary" style="width:10%;display:none">确定</button>
</div>
@endsection
@section('javascript')
    <script src="{{asset('js/avatar_bundle.js')}}"></script>
@endsection