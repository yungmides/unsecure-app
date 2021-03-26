<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function home(Request $request)
  {

//    $articles = Article::orderBy('created_at', 'DESC')->simplePaginate(10);
    $articles = Article::query()->orderBy('created_at', 'desc')->simplePaginate(10);
    return view('welcome', ['articles' => $articles]);
  }

  public function article(Request $request, $article)
  {
    $article = Article::find($article);
    return view('article', ['article' => $article]);
  }

  public function search(Request $request)
  {

    $articles = DB::table('articles')->where('title', 'like', '%'. htmlspecialchars($request->search) . '%')->get()->toArray();
    if(!$articles) $articles = [];
    return view('search', [
      'articles' => $articles,
      'search' => htmlspecialchars($request->search)
    ]);
  }

  public function addComment(Request $request)
  {
      if (strlen($request->author) < 235 && strlen($request->message) < 235) {
          DB::table('comments')->insert([
              'author' => htmlspecialchars($request->author),
              'message' => htmlspecialchars($request->message),
              'article_id' => htmlspecialchars($request->article_id),
          ]);

          return redirect()->route('home.article', $request->article_id);
      }
    return back()->withErrors(['length' => "Trop long !"]);
  }
}
