@extends('layouts.admin')

@section('content')

   <div class="row">
<h3>Robot <b>{{$robot->name}}</b></h3>
@if (count($errors) > 0)
    @foreach($errors->all() as $message)
        <b class="valign-wrapper">
            <i class="material-icons tiny">error</i>
            &nbsp;{{$message}}
        </b>
    @endforeach
@endif
<form class="col s12" action="{{route('robot.update', $robot->id)}}" method="post" enctype="multipart/form-data" >
    {{csrf_field()}}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="input-field col s12">
            <input name="name" placeholder="Placeholder" id="name" type="text" class="validate" value="{{$robot->name}}">
            <label for="name">Name (*)</label>
            @if($errors->has('name')) <span>{{$errors->first('name')}}</span>@endif
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <textarea name="description" id="description" class="materialize-textarea">{{$robot->description}}</textarea>
            <label for="description">Description</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <select name="category_id">
                 <option value="" >Pas de catégorie</option>
                 @forelse($categories as $id => $title)
                 
                 <option {{ selected_fields($id,  $robot->category_id, 'selected') }}  value="{{$id}}">{{$title}}</option>
                 
                 @empty
                 aucune catégorie
                 @endforelse
            </select>
            <label>Materialize Select</label>
        </div>
    </div>
    <div class="row">
         <h3>Mots clés</h3>
         <div class="col s6 offset-3">
         <p>
         @forelse($tags as $id => $name)
         
         <input {{ $robot->isTag($id)? 'checked' : '' }} value="{{$id}}" name="tags[]" type="checkbox" id="tag{{$id}}" />
         
         <label for="tag{{$id}}">{{$name}}</label>
             @empty
             aucun tag
             @endforelse
             @if($errors->has('tags')) <span>{{$errors->first('tags')}}</span>@endif
             </p>
          </div>
    </div>  
    <div class="row">
        <div class="col s12">
            <h3>Publication</h3>
            <div class="switch">
                <label>
                    Unpublished
                    <input {{$robot->status == 'published'? 'checked' : ''}} type="checkbox" name="status" value="published">
                    <span class="lever"></span>
                    Published
                </label>
            </div>
        </div>
    </div>
   <div class="row">
        <div class="col s12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Photo</span>
                    <input name="link" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" id="img-robot" type="text" name="imageRobot" value="{{$robot->link}}">
                </div>
            </div>

            <a id="clear" onclick="$('#img-robot').val('')" style="cursor:pointer">Supprimer la photo</a>
    </div>    
</div>
    <div class="row robot-marge">
        <div class="input-field col s12 ">
            <button class="btn waves-effect waves-light" type="submit" name="action">Update
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>
</div>

@endsection