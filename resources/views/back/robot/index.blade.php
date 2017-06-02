@extends('layouts.admin')

@section('content')

     {{$robots->links()}}
    <a href="{{route('robot.create')}}" class="waves-effect waves-light btn">Ajouter</a>
    <table class="striped">
        <thead>
        <tr>
            <th data-field="name">Name</th>
            <th data-field="status">status</th>
            <th data-field="user">User</th>
            <th data-field="category">Category</th>
            <th data-field="tags">tags</th>
            <th data-field="tags">date</th>
            <th data-field="action">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($robots as $robot)
            <tr id="robot-{{$robot->id}}">
                <td>
                    <a href="{{route('robot.edit', $robot->id)}}">{{$robot->name}}</a>
                </td>
                 <td>{{$robot->status}}</td>
                <td>{{$robot->user? $robot->user->name: 'aucun auteur'}}</td>
                <td>{{$robot->category? $robot->category->title : 'non catégorisé'}}</td>
                <td>
                    @forelse($robot->tags as $tag)
                    <div class="chip">
                        {{$tag->name}}
                    </div>        
                    @empty
                        aucun mot clé
                    @endforelse
                </td>
                <td>
                <small>{{$robot->created_at}}</small>
                </td>

                @can('update', $robot)
                    <td>
                        <a href="{{route('robot.edit', $robot->id)}}" class="waves-effect waves-light btn">Edit</a>
                    </td>
                @endcan

                @can('delete', $robot)
                    <td>
                    <form action="{{route('robot.destroy', $robot->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <button>
                            <input type="submit" id="destroy-button" value="DELETE" class="waves-effect waves-light btn btn-send" data-robot="{{$robot->name}}">
                        </button>
                    </form>
                    </td>
                @endcan

            </tr>
        @empty
            <td>Aucun robot</td>
        @endforelse
        </tbody>
    </table>
    {{$robots->links()}}

@endsection

@section('scripts')
    @parent
    <script>
        $('#destroy-button').on('click', function() {
            alert('Souhaitez-vous vraiment effacer ce robot ?');
        });
    </script>
@endsection