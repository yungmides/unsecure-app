@extends('layouts.app')


@section('content')
  <h1> Hello {{ Auth::user()->name }}</h1>

  <p> Add a new article </p>
  <form method="POST" action="{{ route('admin.article.add') }}">
      @error('csrf')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      @csrf
    <label>Title :</label>
    <input type="text" name="title" maxlength="235"/>
    <label>Content :</label>
    <textarea name="content" maxlength="235"></textarea>
    <button type="submit">Save my new article</button>
  </form>
@endsection
