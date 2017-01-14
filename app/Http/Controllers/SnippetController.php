<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SnippetRepository;
use App\User;
use App\Snippet;

class SnippetController extends Controller
{
  protected $snippets;
  public function __construct(SnippetRepository $snippets)
  {
    $this->snippets = $snippets;
  }
  public function index(Request $request)
  {
    return view('snippets.index', [
      'snippets' => $this->snippets->getLatestFromEachUser(),
      'users' => User::all(),
    ]);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'text' => 'required|max:255',
    ]);

    $request->user()->snippets()->create([
      'text' => $request->text,
    ]);

    return redirect('/snippets');
  }

  public function modify(Request $request, $snippetId)
  {
    $this->validate($request, [
      'text' => 'required|max:255',
    ]);
    $snippet = Snippet::find($snippetId);
    if ($request->user()->id == $snippet->user_id or $request->user()->admin)
      $snippet->text = $request->text;
      $snippet->save();
     return back();
  }

  public function destroy(Request $request, $snippetId)
  {
    $snippet = Snippet::find($snippetId);
    if ($request->user()->id === $snippet->user_id or $request->user()->admin)
      $snippet->delete();
     return back();
  }
}
