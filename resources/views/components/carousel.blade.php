<div class="carouselWrapper">
    <div class="slider_nav">
        @foreach($films as $index=>$film)
            @if($loop->first)
                <a href="javascript:;" class="nav_link active" data-bgimage="img/VIP/{{$film['title']}}.jpg"><span>{{$film['title']}}：{{$film['desc']}}</span></a>
            @else
                <a href="javascript:;" class="nav_link" data-bgimage="img/VIP/{{$film['title']}}.jpg"><span>{{$film['title']}}：{{$film['desc']}}</span></a>
            @endif
        @endforeach
    </div>
    <div class="site_slider">
        <a class="slider_item in" target = "_blank"></a>
        <a class="slider_item out" target = "_blank"></a>
    </div>
</div>