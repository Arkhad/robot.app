@extends('layouts.master')

@section('title', $title)

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @if(!empty($robot))
        <h2>{{$robot->name}}</h2>
        <div class="content">
            @if($robot->link != null)
                <img class="responsive-img" src="{{url('images', $robot->link)}}">
            @endif
            {{ $robot->description }}
            @include('partials.meta')
        </div>
    @endif
@endsection