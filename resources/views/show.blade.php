@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row user-info">
                        <div class="nav-item dropdown text-right col-md-12">
                            @if(!Auth::guest())
                            @if(Auth::user()->id == $post->user_id)
                            <a id="navbarDropdown" class="text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-ellipsis-h" viewBox="0 0 16 16" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('post.edit', ['id' => $post->id]) }}">Edit <i class="fas fa-edit"></i></a>
                                <form class="dropdown-item" id="deleteform" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                    @method('delete')
                                    <button onclick="myFunction()" class="btn btn-sm btn-outline-danger shadow-none">Delete <i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div><br>
                    <img class="card card-img-top" src="{{ asset('images')}}/{{$post->image }}" alt="" onerror="this.style.display='none';">
                    <br>
                    <p><b>{{ $post->title }}</b></p>
                    <p>
                        {{ $post->body }}
                    </p>
                    <p> Posted BY: <b>{{$post->user->name}}</b></p>
                    <hr />
                    <td class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200 ">
                        <form action="{{ route('post.like', $post->id) }}" method="post">
                            @csrf
                            <button class="{{ $post->liked() ? 'bg-blue-600' : '' }} px-4 py-2 text-white btn btn-info btn-sm">
                                <i class="fas fa-thumbs-up"></i> {{ $post->likeCount }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200">
                        <form action="{{ route('post.unlike', $post->id) }}" method="post">
                            @csrf
                            <button class="{{ $post->liked() ? 'block' : 'hidden'  }} px-4 py-2 text-white btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-down"></i>
                            </button>
                        </form>
                    </td>
                    @if(!Auth::guest())
                    <br>



                    <h4>Comments</h4>
                    @include('partials._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                    <hr />
                    <form method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="input-group">
                            <input placeholder="Comment here..." type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-sm btn-outline-dark">Comment <i class="fas fa-comment-dots"></i></button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        if (confirm("Are you sure you want to delete it?")) {
            document.getElementbyId('#deleteform').submit();
        } else {
            return false;
        }
    }

    function updateFunction() {
        document.getElementbyId('#updateform').submit();
    }
</script>
@endsection