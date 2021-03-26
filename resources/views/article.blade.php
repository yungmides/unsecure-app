@extends('layouts.app')


@section('content')
  <h1> {{ $article->title }} </h1>

  <p> {{ $article->content }}</p>


  <h4>Derniers commentaire :</h4>

  @foreach($article->comments as $comment)
  <div>
      {{ $comment->author }} à dit :
    <p>{{ $comment->message }}</p>
  </div>
  @endforeach


  <form method="POST" action="{{ route('article.add.comment') }}" >
      @error('length')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    <p>Author name : </p><input type="text" name="author" maxlength="235" />
    <p>Message : </p><textarea name="message" maxlength="235"></textarea>
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <br>
    <button type="submit">Send my comment !</button>
  </form>


@endsection
