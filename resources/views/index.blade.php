@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-deck">
            @foreach($posts as $post)
            <div class="col-md-4 col-xs-6">
                <a href="{{ route('post.show', $post->id) }}" class="text-reset text-decoration-none">
                    <div class="card my-3">
                        <img class="card-img-top" src="{{ asset('images')}}/{{$post->image }}" alt="Card image cap" onerror="this.style.display='none';">
                        <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text text-justify text-truncate">{{ $post->body }}</p>
                        <p class="card-text"><small class="text-muted">Posted at {{ $post->created_at->format('H:i') }}</small></p>
                        <hr>
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-link text-decoration-none">ReadMore</a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<!-- @foreach($posts as $post)
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ url('storage/cover_image/'.$post->cover_image) }}"  alt="" style="width:128px;height:128px;">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->body }}</p>
          <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">ReadMore</a>
          <hr>
          <td
          class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200 ">
          <form action="{{ route('post.like', $post->id) }}"
              method="post">
              @csrf
              <button
                  class="{{ $post->liked() ? 'bg-blue-600' : '' }} px-4 py-2 text-white btn btn-warning">
                  like {{ $post->likeCount }}
              </button>
          </form>

      </td>
      <td
          class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200">
          <form action="{{ route('post.unlike', $post->id) }}"
              method="post">
              @csrf
              <button
                  class="{{ $post->liked() ? 'block' : 'hidden'  }} px-4 py-2 text-white btn btn-danger">
                  unlike
              </button>
          </form>
      </td>

  </tr>

        </div>
      </div>
      @endforeach -->