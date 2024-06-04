<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
      $projects = Project::with('type', 'technologies')->paginate(12);
      return response()->json($projects);
    }

    public function getTechnologies(){
      $technologies = Technology::all();
      return response()->json($technologies);
    }

    public function getTypes(){
      $types = Type::all();
      return response()->json($types);
    }

    public function getProjectDetail($slug){
      $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

      if($project->image){
        $project->image = asset('storage/' . $project->image);
      } else {
        $project->image = 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=';
        $project->image_original_name = '-';
      }

      return response()->json($project);
    }
}
