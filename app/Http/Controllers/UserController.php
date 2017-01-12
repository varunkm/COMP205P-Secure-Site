<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Snippet;
class UserController extends Controller
{
    public function profile(Request $request, $userId){
      return view('snippets.profile', [
          'user' => User::where('id',$userId)->get()->first(),
          'snippets' =>Snippet::where('user_id',$userId)->get(),
      ]);
    }

    public function modify(Request $request, $userId)
    {
      if($userId != $request->user()->id){
        echo "id mismatch";
        echo $userId;
        echo $request->user()->id;
        return redirect('/user/'.$request->user()->id);
      }

      $new_username = $request->newUsername;
      $old_pwd = $request->oldPassword;
      $new_pwd = $request->newPassword;
      $new_pwd_confirm = $request->confirmNewPassword;
      $homepage_url = $request->homepage;
      $image_url = $request->imagURL;
      $profile_col = $request->profileColour;

      $user = User::find($userId);
      if($new_username !== "")
      {
        $user->name = $new_username;
      }
      if($homepage_url !== "")
      {
        $user->homepage = $homepage_url;
      }
      if($image_url !== "")
      {
        $user->icon_url = $image_url;
      }
      if($profile_col !== "")
      {
        $user->colour = $profile_col;
      }

      if($old_pwd !== "" && Hash::check($old_pwd, $request->user()->password)) {
          if($new_pwd !== "" && $new_pwd === $new_pwd_confirm){
            $user->password = bcrypt($new_pwd);
          }
      }
      $user->save();
      return redirect('/user/'.$request->user()->id);

    }
}
