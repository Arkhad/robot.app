@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>Robots publiés : {{ $public }}/30</p>
@endsection

@section('content')
{{$robots->links()}}
    @forelse ($robots as $robot)
        <div class="card">
            <div class="card-image">
                <img src="{{url('images', $robot->link)}}">
                <span class="card-title"><a href="{{url('robot', $robot->id)}}">{{ $robot->name }}</a></span>
            </div>
            <div class="card-content">
                <h4>{{ $robot->category ? $robot->category->title : null }}</h4>
                <h6>Power {{ $robot->power }}%</h6>
                <h6>RAM : {{ $robot->type }}</h6>
                <p>{{ substr($robot->description,0, 100)}}
                    <a href="{{url('robot', $robot->id)}}">lire la suite...</a>
                </p>
               @include('partials.meta')
                <br>
                <i>{{ $robot->status }}</i>
            </div>
        </div>
    @empty
        <p>Aucun robot trouvé</p>
    @endforelse
{{$robots->links()}}

@endsection