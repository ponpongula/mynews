<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileControlle extends Controller
{
      public function add(100)
  {
   return view('admin.profile.create');
  }
    public function create(100)
  {
    return redirect('admin/profile/create');
  }

    public function edit(100)
  {
    return view('admin.profile.edit');
  }

 public function update(100)
  {
    return redirect('admin/profile/edit');
  }
}
