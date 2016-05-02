<div class='insideLog'>
    @foreach ($log->tags as $tag)
        <form method="POST" action="{{ route('tag.destroy', ['id'=>$tag->id]) }}" class='delete'/>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='hidden' name='logID' value='$log->id' />
            <input type='submit' class='textButton delete' value='x' />
        </form>
        <div style='font-weight:bold;float:left;margin-right:24px;'>
            {{ $tag->type->name }}
        </div>
    @endforeach
</div>
<div class='clear'>
<input type='button' id='showNewTags{{$log->id}}' class='showNewTags textButton insideLog' value='[ Tag ]' />
<input type='button' id='hideNewTags{{$log->id}}' class='hideNewTags textButton insideLog' value='[ - ]' style='display:none'/>
</div>
<div id='listOfNewTags{{$log->id}}' class='insideLog' style='display:none'>
@foreach ($tag_types as $tag_type)
    <form method="POST" action="{{ route('tag.store') }}" style='float:left;margin-left:16px;'/>
        {{ csrf_field() }}
        <input type='hidden' name='typeID' value='{{ $tag_type->id }}' />
        <input type='hidden' name='logID'  value='{{ $log->id }}' />
        <input type='submit' value='{{ $tag_type->name }}' class='textButton' />
    </form>
    <div style='float:left;margin-left:16px;'>
        /
    </div>
@endforeach
</div>

