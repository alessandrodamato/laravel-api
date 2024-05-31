@extends('layouts.admin')



@section('title')
 - Progetti suddivisi per tecnologia
@endsection



@section('content')

<h1 class="text-center mb-5">Progetti suddivisi per tecnologia</h1>


<div class="container">
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th class="px-5 py-3" scope="col"><h4>Tecnologia</h4></th>
        <th class="px-5 py-3 w-75 text-center" scope="col"><h4>Progetti</h4></th>
      </tr>
    </thead>
    <tbody>

      @foreach ($technologies as $technology)
        <tr>
          <td class="p-5"><h5>{{$technology->name}}</h5></td>
          <td class="p-5">
            <ul class="list-group">
              @foreach ($technology->projects as $project)
                <li class="list-group-item list-group-item-warning text-center"><a class="text-decoration-none text-black"  href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a></li>
              @endforeach
            </ul>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>
</div>


@endsection
