<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Project;
use App\Functions\Helpers;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data = Technology::all();

      return view('admin.technologies.index', compact('data'));
    }

    public function technologiesProjects()
    {
      $technologies = Technology::all();
      $projects = Project::all();

      return view('admin.technologies.technologies-projects', compact('technologies', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
          'name' => 'required|min:2|max:100'
        ],
        [
          'name.required' => 'Inserire il nome',
          'name.min' => 'Il nome deve avere almeno :min caratteri',
          'name.max' => 'Il nome deve avere massimo :max caratteri'
        ]);

        $exists = Technology::where('name', $request->name)->first();
        if($exists){

          return redirect()->route('admin.technologies.index')->with('error', 'Il nome inserito è già esistente');

        } else{

          $form_data = $request->all();

          $new_item = new Technology();
          $new_item->name = $form_data['name'];
          $new_item->slug = Helpers::generateSlug($new_item->name, new Technology());

          $new_item->save();

          return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia inserita correttamente');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {

      $valid_data = $request->validate([
        'name' => 'required|min:2|max:100'
      ],
      [
        'name.required' => 'Inserire il nome',
        'name.min' => 'Il nome deve avere almeno :min caratteri',
        'name.max' => 'Il nome deve avere massimo :max caratteri'
      ]);

      $exists = Technology::where('name', $request->name)->first();
        if($exists){

          return redirect()->route('admin.technologies.index')->with('error', 'Il nome inserito è già esistente');

        } else{

          $valid_data['slug'] = Helpers::generateSlug($valid_data['name'], new Technology());

          $technology->update($valid_data);

          return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia modificata correttamente');

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia eliminata correttamente');
    }
}
