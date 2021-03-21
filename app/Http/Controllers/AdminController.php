<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use App\Models\Article;

class AdminController extends Controller
{
  public function index(Request $request)
  {
    $articles = Article::all();
    return view('admin.index', ['articles' => $articles]);
  }

  public function addArticle(Request $request)
  {
      $article = new Article;
      $article->content = $request->content;
      $article->title = $request->title;
      $article->save();

      return redirect()->route('home');
  }
}
