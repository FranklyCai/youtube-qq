<div class="subject" id={{$subject}}>
    <div class="theme">
        <img src="img/{{$theme[0]}}" alt="{{$theme[1]}}"/>
        <span class="title">{{$theme[1]}}</span>
    </div>
    <div class="card-wrap">
        @foreach ($cards as $index=>$card)
            <div class="item" @if(!empty($card->url))data-url="{{$card->url}}"@endif>
                <img src="{{asset($card->img)}}" alt="{{$card['title']}}">
                <div class="item-body">
                    <h6 title="{{$card['title']}}">{{$card['title']}}</h6>
                    <span title="{{$card['desc']}}">{{$card['desc']}}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>