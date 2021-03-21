<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use App\Models\Article;

class HomeController extends Controller
{
  public function home(Request $request)
  {
    $articles = Article::orderBy('created_at', 'DESC')->simplePaginate(10);

    return view('welcome', ['articles' => $articles]);
  }

  public function article(Request $request, $article)
  {
    $article = \App\Models\Article::find($article);
    return view('article', ['article' => $article]);
  }

  public function search(Request $request)
  {
    $mysql = new Mysql;

    $articles = $mysql->like('articles', '*', ['title' => $request->search]);

    if(!$articles) $articles = [];

    return view('search', [
      'articles' => $articles,
      'search' => $request->search
    ]);
  }

  public function addComment(Request $request)
  {
    $mysql = new Mysql;

    $mysql->insert('comments', [
      'author' => $request->author,
      'message' => $request->message,
      'article_id' => $request->article_id,
    ]);

    return redirect()->route('home.article', $request->article_id);
  }
}
