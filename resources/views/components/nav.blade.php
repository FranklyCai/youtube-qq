<nav class="bg-dark">
    <a href="javascript:;" class="link_logo"></a>
    <div class="search-wrapper">
        <div class="search-input-wrapper">
            <input type="text">
        </div>
        <button class="btn btn-info btn-search">搜索</button>
    </div>
    @if(Auth::check())
        <div class="avatar-div" style="position:relative">
            <?php $avatar = Auth::user()->avatar?>
            <img src={{asset("../storage/app/$avatar")}} alt="" class="avatar-arrow">
            <div class="nav-menu">
                <a class="btn font-weight-light" href="{{ route('avatar') }}">
                    更改头像
                </a>
                <a class="btn font-weight-light" href="{{ route('upload') }}">
                    上传视频
                </a>
                <a class="btn font-weight-light" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        @else
        <div class="avatar-div" style="position:relative">
            <i class="fa fa-user fa-2x pointer text-white avatar-arrow nav-avatar" aria-hidden="true" style="position:relative">
            </i>
            <div class="nav-menu nav-menu-2">
                <a class="btn font-weight-bold" style="line-height: 1" href="{{route('register')}}">注册</a>
                <a class="btn font-weight-bold" style="line-height: 1" href="{{route('login')}}">登录</a>
            </div>
        </div>
        @endif
</nav>