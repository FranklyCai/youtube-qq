<h5 class="text-black-50 mt-4 ml-1">我的评论</h5>
<div class="comment-box">
    @component('components.emoji-keyboard')@endcomponent
    <div id="comment-text" class="bg-white" contenteditable></div>
        <div class="input-group comment-box-footer">
            <button class="btn btn-primary" id="publish">发表</button>
            <div class="input-group-append">
                <button id="emoji" class="btn btn-success"><i class="fa fa-smile-o" aria-hidden="true"></i></button>
            </div>
        </div>
</div>