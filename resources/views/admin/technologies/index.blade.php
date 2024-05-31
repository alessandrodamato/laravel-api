@extends('layouts.admin')



@section('title')
 - Tecnologie
@endsection



@section('content')

  <h1 class="text-center mb-5">Tecnologie</h1>

  <div class="container">

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      {{$errors->all()[0]}}
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

    <div class="row">
      <div class="col d-flex justify-content-center">
        <table class="table w-50 crud-table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th class="text-center" scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $item)
            <tr>
              <td>
                <form id="form-edit-{{$item->id}}" action="{{route('admin.technologies.update', $item)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <input class="w-100" type="text" value="{{$item->name}}" name="name">
                </form>
              </td>
              <td class="text-center">
                <button type="submit" onclick="editSubmit({{$item->id}})" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button>
                <form onsubmit="return confirm('Sei sicuro di voler eliminare {{$item->name}} ?')" action="{{route('admin.technologies.destroy', $item)}}" method="POST" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center"><h6 class="my-2">Tabella vuota</h6></td>
            </tr>
            @endforelse
            <tr>
              <form class="d-inline-block" action="{{route('admin.technologies.store')}}" method="POST">
                @csrf
                <td><input class="w-100" type="text" placeholder="Aggiungi" name="name"></td>
                <td class="text-center">
                  <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                  <button type="reset" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                </td>
              </form>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('admin.partials.edit-submit')

@endsection
