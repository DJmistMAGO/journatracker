<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidentReportController extends Controller
{
      public function index()
  {
    return view('spj-content.incident-report.index');
  }
}
