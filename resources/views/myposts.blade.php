@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">

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


@endsection