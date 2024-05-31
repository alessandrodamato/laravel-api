@extends('layouts.admin')



@section('title')

- {{$action}} Fumetto

@endsection



@section('content')

<div class="container py-5 text-center">

  <h1 class="mb-3">{{$action}}
    @isset($project)
    <form onsubmit="return confirm('Sei sicuro di voler eliminare {{$project->name}} ?')"
      action="{{route('admin.projects.destroy', $project)}}" method="POST" class="d-inline-block">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
    </form>
    @endisset
  </h1>

  @if($errors->any())
  <div class="alert alert-danger text-start " role="alert">
    <ul class="m-0">
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="row">

    <div class="col-6 offset-3">

      <form action="{{$route}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div class="container-fluid">

          <div class="row">

            <div class="col-4">
              <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                  placeholder="Aggiungi nome" value="{{old('name', $project?->name)}}">
                @error('name')
                <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                @enderror
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="creator" class="form-label">Creatore</label>
                <input name="creator" type="text" class="form-control @error('creator') is-invalid @enderror"
                  id="creator" placeholder="Aggiungi creatore" value="{{old('creator', $project?->creator)}}">
                @error('creator')
                <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                @enderror
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="objective" class="form-label">Obiettivo</label>
                <input name="objective" type="text" class="form-control @error('objective') is-invalid @enderror"
                  id="objective" placeholder="Aggiungi obiettivo" value="{{old('objective', $project?->objective)}}">
                @error('objective')
                <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                @enderror
              </div>
            </div>

            <div class="col-3">
              <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" id="type" style="-webkit-appearance: none; -moz-appearance: none;"
                  name="type_id">
                  <option value="">---</option>
                  @foreach ($types as $type)
                    <option value="{{$type->id}}" @if($type->id == old('type_id', $project?->type?->id)) selected @endif>{{$type->name}}</option>
                  @endforeach
                </select>
                @error('type')
                <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                @enderror
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label for="file" class="form-label">File .pdf</label>
                <input type="hidden" name="isUploaded" value="true" id="isUploaded">
                <div class="d-flex">
                  <div id="uploaded-file" class="w-100 overflow-auto d-flex align-items-center rounded-2 px-2 {{old('file', $project?->file) ? 'd-block' : 'd-none'}}"><span>{{$project?->file_original_name}}</span></div>
                  <input name="file" type="file" class="form-control {{old('file', $project?->file) ? 'd-none' : 'd-inline-block'}} @error('file') is-invalid @enderror" id="file"
                    placeholder="Carica un file .pdf" value="{{old('file', $project?->file)}}" onchange="addFile()">
                </div>
                @error('file')
                <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                @enderror
              </div>
            </div>

            <div class="col-3">
              <div class="mb-3">
                <button class="btn btn btn-outline-danger {{old('file', $project?->file) ? 'd-inline-block' : 'd-none'}}" id="file-remover" onclick="event.preventDefault(); resetFile()">Rimuovi file</button>
              </div>
            </div>

            <div class="col">
              <div class="mb-3">
                <label for="technologies" class="form-label">Tecnologie</label>
                <div class="btn-group btn-group-sm" role="group">
                  @foreach ($technologies as $technology)
                  <input
                    name="technologies[]"
                    value="{{$technology->id}}"
                    type="checkbox"
                    class="btn-check"
                    id="technology-{{$technology->id}}"
                    autocomplete="off"
                    @if ($errors->any() && in_array($technology->id, old('technologies', [])) || !$errors->any() && $project?->technologies->contains($technology))
                      checked
                    @endif
                  >
                  <label class="btn btn-outline-secondary" for="technology-{{$technology->id}}">{{$technology->name}}</label>
                  @endforeach
                </div>
                @error('technology')
                <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                @enderror
              </div>
            </div>

            <div class="col-12">
              <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea name="description" class="form-control" id="description"
                  rows="8">{{old('description', $project?->description)}}</textarea>
              </div>
            </div>

            <div class="col-12">
              <div class="mb-3 float-end">
                <button type="submit" class="btn btn-primary ms-3">{{$btn}}</button>
              </div>
            </div>

          </div>

        </div>

      </form>

    </div>

  </div>

</div>

<script>

  isUploaded = document.getElementById('isUploaded');
  uploadedFile = document.getElementById('uploaded-file');
  fileRemover = document.getElementById('file-remover');
  file = document.getElementById('file');

  function resetFile(){
    isUploaded.value = false;
    file.value = '';
    uploadedFile.classList.add('d-none');
    fileRemover.classList.add('d-none');
    file.classList.remove('d-none');
    file.classList.add('d-inline-block');
  }

  function addFile(){
    isUploaded.value = true;
    fileRemover.classList.remove('d-none');
    fileRemover.classList.add('d-inline-block');
  }

</script>

@endsection
