@extends('layouts.admin')



@section('title')
 - {{$project->name}}
@endsection



@section('content')

<div class="container text-center">

  <h1 class="text-center mb-5">{{$project->name}}
    <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
    <form onsubmit="return confirm('Sei sicuro di voler eliminare {{$project->name}} ?')" action="{{route('admin.projects.destroy', $project)}}" method="POST" class="d-inline-block">
      @csrf
      @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
    </form>
  </h1>

  <div>
    <img src="{{asset('storage/' . $project->image)}}" alt="{{$project->image_original_name}}">
  </div>

  <h3 class="mb-3"><strong>Creatore: </strong>{{$project->creator}}</h3>
  <h3 class="mb-3"><strong>Obiettivo: </strong>{{$project->objective}}</h3>
  @if ($project->type)
    <h3 class="mb-3"><strong>Tipo: </strong>{{$project->type->name}}</h3>
  @endif
  @if (count($project->technologies) > 0)
    <h3 class="mb-3"><strong>Tecnologie: </strong>
      @foreach ($project->technologies as $technology)
        <span class="badge text-bg-secondary">{{$technology->name}}</span>
      @endforeach
    </h3>
  @endif
  <p>{{$project->description}}</p>

</div>

@endsection
