<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helpers;
use App\Models\Project;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data = Type::all();

      return view('admin.types.index', compact('data'));
    }

    public function typesProjects()
    {
      $types = Type::all();
      $projects = Project::all();

      return view('admin.types.types-projects', compact('types', 'projects'));
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

      $exists = Type::where('name', $request->name)->first();
      if($exists){

        return redirect()->route('admin.types.index')->with('error', 'Il nome inserito è già esistente');

      } else{

        $form_data = $request->all();

        $new_item = new Type();
        $new_item->name = $form_data['name'];
        $new_item->slug = Helpers::generateSlug($new_item->name, new Type());

        $new_item->save();

        return redirect()->route('admin.types.index')->with('success', 'Tipo inserito correttamente');;

      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
      $projects = Project::where('type_id', $type->id)->get();
      return view('admin.types.show', compact('type', 'projects'));
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
    public function update(Request $request, Type $type)
    {

      $valid_data = $request->validate([
        'name' => 'required|min:2|max:100'
      ],
      [
        'name.required' => 'Inserire il nome',
        'name.min' => 'Il nome deve avere almeno :min caratteri',
        'name.max' => 'Il nome deve avere massimo :max caratteri'
      ]);

      $exists = Type::where('name', $request->name)->first();
        if($exists){

          return redirect()->route('admin.types.index')->with('error', 'Il nome inserito è già esistente');

        } else{

          $valid_data['slug'] = Helpers::generateSlug($valid_data['name'], new Type());

          $type->update($valid_data);

          return redirect()->route('admin.types.index')->with('success', 'Tipo modificato correttamente');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
      $type->delete();

      return redirect()->route('admin.types.index')->with('success', 'Tipo eliminato correttamente');
    }
}
