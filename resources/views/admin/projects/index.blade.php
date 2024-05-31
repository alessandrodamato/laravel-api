@extends('layouts.admin')



@section('title')
 - Progetti
@endsection



@section('content')

  <h1 class="text-center mb-5">Progetti</h1>

  <div class="container">

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul class="m-0">
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger" role="alert">
      {{session('error')}}
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

    <table class="table crud-table">
      <thead>
        <tr>
          <th class="w-5" scope="col">
            <a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'id', 'dir' => $dir])}}">ID
              @if ($dir === 'desc' && $col === 'id')
                <i class="fa-solid fa-sort-down"></i>
              @elseif ($dir === 'asc' && $col === 'id')
                <i class="fa-solid fa-sort-up"></i>
              @endif
            </a>
          </th>
          <th class="w-15" scope="col">
            <a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'name', 'dir' => $dir])}}">Nome
              @if ($dir === 'desc' && $col === 'name')
                <i class="fa-solid fa-sort-down"></i>
              @elseif ($dir === 'asc' && $col === 'name')
                <i class="fa-solid fa-sort-up"></i>
              @endif
            </a>
          </th>
          <th class="w-15" scope="col">
            <a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'creator', 'dir' => $dir])}}">Creatore
              @if ($dir === 'desc' && $col === 'creator')
                <i class="fa-solid fa-sort-down"></i>
              @elseif ($dir === 'asc' && $col === 'creator')
                <i class="fa-solid fa-sort-up"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'objective', 'dir' => $dir])}}">Obiettivo
              @if ($dir === 'desc' && $col === 'objective')
                <i class="fa-solid fa-sort-down"></i>
              @elseif ($dir === 'asc' && $col === 'objective')
                <i class="fa-solid fa-sort-up"></i>
              @endif
            </a>
          </th>
          <th scope="col">Tipo</th>
          <th class="w-15" scope="col">Descrizione</th>
          <th scope="col" class="text-center">Azioni</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <form class="d-inline-block" action="{{route('admin.projects.store')}}" method="POST">
            @csrf
            <td><strong>#</strong></td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi nome" name="name" value="{{old('name')}}"></td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi creatore" name="creator" value="{{old('creator')}}"></td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi obiettivo" name="objective" value="{{old('objective')}}"></td>
            <td>
              <select style="-webkit-appearance: none; -moz-appearance: none;" class="select-empty" onchange="this.value === '' ? this.className = 'select-empty' : this.className = 'text-black'" name="type_id">
                <option class="text-black" value="">Seleziona tipo</option>
                @foreach ($types as $type)
                  <option class="text-black" value="{{$type->id}}" @if($type->id == old('type_id')) selected @endif>{{$type->name}}</option>
                @endforeach
              </select>
            </td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi descrizione" name="description" value="{{old('description')}}"></td>
            <td class="text-center">
              <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
              <a href="{{route('admin.projects.create')}}" class="btn btn-primary"><i class="fa-solid fa-file-circle-plus"></i></a>
              <button onclick="formReset()" type="reset" class="btn btn-danger"><i class="fa-solid fa-rotate-right"></i></button>
            </td>
          </form>
        </tr>
        @forelse ($projects as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->creator}}</td>
          <td>{{$item->objective}}</td>
          <td>{{$item->type?->name ? $item->type->name : '---'}}</td>
          <td>{{$item->description}}</td>
          <td class="text-center w-25">
            <a href="{{route('admin.projects.show', $item)}}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
            <a href="{{route('admin.projects.edit', $item)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
            <form onsubmit="return confirm('Sei sicuro di voler eliminare {{$item->name}} ?')" action="{{route('admin.projects.destroy', $item)}}" method="POST" class="d-inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center"><h6 class="my-2">Tabella vuota</h6></td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @include('admin.partials.form-reset')

@endsection
