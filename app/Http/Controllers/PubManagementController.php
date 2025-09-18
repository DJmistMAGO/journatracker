<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PubManagementController extends Controller
{
  public function index()
  {
    return view('content.article.pub-management');
  }
}
