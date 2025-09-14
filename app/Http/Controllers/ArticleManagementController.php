<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleManagementController extends Controller
{
     public function index()
  {
    return view('spj-content.article-management.index');
  }

  //add resources
  public function create()
  {
      return view('spj-content.article-management.create');
  }

  public function edit($id)
  {
      return view('spj-content.article-management.edit', compact('id'));
  }


}

