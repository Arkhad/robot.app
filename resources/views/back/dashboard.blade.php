@extends('layouts.admin')

@section('content')

    <div class="collection">
        <a class="collection-item" >Gestion des CRUD</a>
        <a class="collection-item" href="{{route('robot.index')}}">robots</a>
    </div>

@endsection