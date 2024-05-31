@extends('layouts.admin')



@section('title')
 - Dashboard
@endsection



@section('content')

<div class="text-center">
  <h1 class="mb-5">Dashboard</h1>
  <h4>Nel database sono presenti {{$n_projects}} progetti, {{$n_technologies}} tecnologie e {{$n_types}} tipi</h4>
</div>

@endsection
