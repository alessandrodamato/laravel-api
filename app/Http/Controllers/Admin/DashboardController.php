<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class DashboardController extends Controller
{
    public function index() {

      $n_projects = Project::count();
      $n_technologies = Technology::count();
      $n_types = Type::count();

      return view('admin.home', compact('n_projects', 'n_technologies', 'n_types'));

    }
}
