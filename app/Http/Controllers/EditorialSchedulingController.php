<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorialSchedulingController extends Controller
{
     public function index()
  {
    return view('spj-content.editorial-scheduling.index');
  }
}
