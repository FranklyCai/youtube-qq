<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .text-jumbo{
            font-size:60px;
            font-weight:700;
            margin:0rem;
        }
        a{
            text-decoration: none;
            color:red;
        }
    </style>
    <title>404</title>
</head>
<body>
<div style="display: flex;width:50%;justify-content: space-between;top:50%;left:52%;transform:translate(-50%,-50%);position:absolute">
    <div style="display: flex;flex-direction:column;justify-content: space-between">
        <div>
            <h1 class="text-jumbo">哎哟!</h1>
            <h2>{{$message}}</h2>
            <h3 style="color:#484848">错误代码: 404</h3>
        </div>
        <div style="font-size:1.2rem;margin-bottom:1.5rem;font-weight:bolder">您可以&nbsp;<a href="/">返回首页</a></div>
    </div>
    <img src={{asset("img/404.gif")}} width="313" height="428" style="float:left">
</div>
</body>
</html>