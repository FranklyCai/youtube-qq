<div class="grid">
    @if(!empty($comments))
    @foreach ($comments as $index=>$comment)
        <div class="comment clearfix">
            <div class="comment-title">
                <img src="{{asset("../storage/app/$comment->avatar")}}" width="50" height="50" class="comment-avatar rounded-circle">
                <div class="comment-info">
                    <strong class="commentator">{{$comment->name}}</strong>
                    <span class="comment-time">{{$comment->created_at}}</span>
                </div>
            </div>
            <div class="comment-body">
                <span class="comment-content">
                    <?php echo preg_replace('#&lt;br&gt;#', '<br>', $comment->comment)?>
                </span>
            </div>
            <div class="comment-footer float-right">
                <button class="btn btn-primary mr-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$comment->up}}</button>
                <button class="btn btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{$comment->down}}</button>
            </div>
        </div>
    @endforeach
    @endif
</div>