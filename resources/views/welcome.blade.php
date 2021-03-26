@extends('layouts.app')


@section('content')
  <h1> Last news : </h1>

  @foreach($articles as $article)
  <div>
    <a href="{{ route('home.article', $article->id) }}">
      <h3>{{ $article->title }}</h3>
    </a>
  </div>
  @endforeach

  {{ $articles->links() }}


@endsection
