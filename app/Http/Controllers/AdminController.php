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

      if (hash_equals(csrf_token(), $request->_token)) {
          $article = new Article;
          $article->content = htmlspecialchars($request->content);
          $article->title = htmlspecialchars($request->title);
          $article->save();
          return redirect()->route('home');
      }
      return back()->withErrors(['csrf' => "Une erreur s'est produite ! Veuillez vous reconnecter"]);


  }
}
