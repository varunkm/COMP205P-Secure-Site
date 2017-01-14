<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\File;
use App\User;

class FileController extends Controller
{
  public function store(Request $request)
  {
      $file = $request->file('image_file');
      $path = $file->store('user_files');
      $file_obj = $request->user()->files()->create([
        'filepath' => 'app/'.$path,
      ]);
      return redirect('/file/'.$file_obj->id);
  }

  public function retrieve(Request $request, $file_id)
  {
    $file = File::find($file_id);
    if($request->user()->id != $file->user_id)
      abort(403, 'You do not have permission to see this.');
    return response()->download(storage_path($file->filepath), null, [], null);
  }
}
