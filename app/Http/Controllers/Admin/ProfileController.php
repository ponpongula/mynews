<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
      public function add()
  {
   return view('admin.profile.create');
  }

  public function create(Request $request)
  {

      $this->validate($request, Profile::$rules);

      $profile = new Profile();
      $form = $request->all();

      if ($form['_token']) {
        $path = $request->file('_token')->store('public/_token');
        $profile->_token_path = basename($path);
      } else {
          $profile->_token_path = null;
      }


      unset($form['remove']);
      unset($form['_token']);


      $Profile->fill($form);
      $Profile->save();

      return redirect('admin/profile/create');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

/*
  return view('admin.profile.edit');
}

public function update();
{
  return redirect('admin/profile/edit');
}
*/

 public function edit(Request $request)
   {
     $profile = Profile::find($request->id);
     if (empty($profile)){
        abort(404);
   }
     return view('admin.profile.edit', ['profile_form' => $profile]);
   }

 public function update(Request $request)
  {
    $this->validate($request, Profile::$rules);
    $profile = Profile::find($request->id);
    $profile_form = $request->all();

    unset($profile_form['remove']);
    unset($profile_form['_token']);

    $profile->fill($profile_form)->save();
    return redirect('admin/profile/');
  }

  public function delete(Request $request)
  {
    $profile = Profile::find($request->id);
    $profile->delete();
    return redirect('admin/profile/');
  }
}
