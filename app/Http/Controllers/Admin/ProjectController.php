<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helpers;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

      $projects = Project::all()->sortDesc();

      $types = Type::all();

      $dir = 'desc';
      $col = null;

      return view('admin.projects.index', compact('projects', 'types', 'dir', 'col'));

    }

    public function orderBy($col, $dir){

      $dir = $dir === 'desc' ? 'asc' : 'desc';

      $projects = Project::orderBy($col, $dir)->get();

      $types = Type::all();

      return view('admin.projects.index', compact('projects', 'types', 'dir', 'col'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $project = null;
      $types = Type::all();
      $technologies = Technology::all();
      $action = 'Aggiungi un progetto';
      $method = 'POST';
      $btn = 'Aggiungi';
      $route = route('admin.projects.store');
      return view('admin.projects.create-edit', compact('project', 'types', 'technologies', 'action', 'method', 'route', 'btn'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {

      $form_data = $request->all();

      if(array_key_exists('image', $form_data)){

        $file = Storage::disk('public')->put('uploads', $form_data['image']);
        $original_name = $request->file('image')->getClientOriginalName();

        $form_data['image'] = $file;
        $form_data['original_name'] = $original_name;

      } else {
        $form_data['image'] = null;
        $form_data['original_name'] = null;
      }

      $new_item = new Project();
      $new_item->name = $form_data['name'];
      $new_item->slug = Helpers::generateSlug($new_item->name, Project::class);
      $new_item->type_id = $form_data['type_id'];
      $new_item->creator = $form_data['creator'];
      $new_item->objective = $form_data['objective'];
      $new_item->image = $form_data['image'];
      $new_item->image_original_name = $form_data['original_name'];
      $new_item->description = $form_data['description'];

      $new_item->save();

      if(array_key_exists('technologies', $form_data)){
        $new_item->technologies()->attach($form_data['technologies']);
      }

      return redirect()->route('admin.projects.index')->with('success', 'Progetto inserito correttamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
      $types = Type::all();
      $technologies = Technology::all();
      $action = 'Modifica' . ' ' . $project->name;
      $method = 'PUT';
      $btn = 'Aggiorna';
      $route = route('admin.projects.update', $project);
      return view('admin.projects.create-edit', compact('project', 'types', 'technologies', 'action', 'method', 'route', 'btn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {

      $form_data = $request->all();

      if(array_key_exists('image', $form_data) && $form_data['isUploaded'] == 'true'){

        $file = Storage::disk('public')->put('uploads', $form_data['image']);
        $original_name = $request->file('image')->getClientOriginalName();

        $form_data['image'] = $file;
        $form_data['original_name'] = $original_name;

      } elseif (!array_key_exists('image', $form_data) && $form_data['isUploaded'] == 'true') {

        $form_data['image'] = $project->image;
        $form_data['original_name'] = $project->image_original_name;

      } else {

        $form_data['image'] = null;
        $form_data['original_name'] = null;

      }

      if ($form_data['name'] === $project->name){
        $form_data['slug'] = $project->slug;
      } else {
        $form_data['slug'] = Helpers::generateSlug($form_data['name'], Project::class);
      }

      $project->name = $form_data['name'];
      $project->slug = $form_data['slug'];
      $project->type_id = $form_data['type_id'];
      $project->creator = $form_data['creator'];
      $project->objective = $form_data['objective'];
      $project->image = $form_data['image'];
      $project->image_original_name = $form_data['original_name'];
      $project->description = $form_data['description'];

      $project->update();

      if(array_key_exists('technologies', $form_data)){
        $project->technologies()->sync($form_data['technologies']);
      } else {
        $project->technologies()->detach();
      }

      return redirect()->route('admin.projects.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
      $project->delete();

      return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
