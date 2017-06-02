@extends('layouts.master')

@section('content')

<form action="{{url('login')}}" method="POST" class="col col-lg-2">

    {{csrf_field()}} {{-- token pour protéger votre formulaire CSRF --}}

    <div class="row">
        <input type="email"  value="{{old('email')}}" name="email">
        <label for="Email">Email</label>
        @if($errors->has('email')) <span>{{$errors->first('email')}}</span>@endif

    </div>

    <div class="row">
        <input type="password" name="password">
        <label for="Password">Password</label>
         @if($errors->has('password')) <span>{{$errors->first('password')}}</span>@endif
    </div>

    <div class="row">
        <div class="input-field col s12">
            <input {{old('remember')? 'checked' : ''}} type="checkbox" id="remember" name="remember" value="remember"/>
            <label for="remember">se souvenir de moi</label>
        </div>
    </div>

    <div class="row robot-marge">
        <div class="input-field col s12 ">
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>

</form>

@endsection