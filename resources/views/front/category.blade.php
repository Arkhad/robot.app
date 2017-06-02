@extends('layouts.master')

@section('title', $title)

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @forelse ($robots as $robot)
        <div class="card">
            <div class="card-image">
                <img src="{{url('images', $robot->link)}}">
                <span class="card-title"><a href="{{url('robot', $robot->id)}}">{{ $robot->name }}</a></span>
            </div>
            <div class="card-content">
                <p>{{ substr($robot->description,0, 100)}}
                    <a href="{{url('robot', $robot->id)}}">lire la suite...</a>
                </p>
                @include('partials.meta')
            </div>
        </div>
    @empty
        <p>Aucun robot trouvé</p>
    @endforelse
@endsection