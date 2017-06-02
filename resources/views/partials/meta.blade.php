@forelse($robot->tags as $tag)
    @if(isset($tagId) && $tag->id == $tagId)
        <div class="chip brown lighten-2">
            {{ $tag->name }}
        </div>
    @else
        <div class="chip  waves-effect">
            <a href="{{url('tag', $tag->id)}}">{{$tag->name}}</a>
        </div>
    @endif
@empty
    <p>No tags</p>
@endforelse