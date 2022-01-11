@foreach($comments as $comment)
    <div class="display-comment">
        <strong>@if($comment->user)  {{ $comment->user->name }}  @endif</strong>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('reply.add') }}">
            @csrf
            <div class="input-group">
                <input placeholder="Reply" type="text" name="comment_body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            <div class="input-group-append">
                <button type="submit" class="btn btn-sm btn-outline-dark"><i class="fas fa-reply"></i></button>
            </div>
            </div>
        </form>
        @include('partials._comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach