<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Post;

class PostController extends Controller
{
  /**
   * Returns list of Posts
   *
   * @return Illuminate\Http\Response
   */
  public function index($categoria = null)
  {
      if (isset($categoria)) {
          $posts = Post::where('categoria', 'LIKE', $categoria)->get()->sortByDesc('created_at');
      } else {
          $posts = Post::all()->sortByDesc('created_at');
      }
    return view('blog.index')->with(compact('posts'));
  }

  /**
   * Returns a single Post
   *
   * @return Illuminate\Http\Response
   */
  public function show($slug)
  {
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('blog.show')->with(compact('post'));
  }
  
  
}
