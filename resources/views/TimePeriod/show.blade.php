<div class='listOfActiveTasks clearfix'>
  <div class='clearfix margin-bottom'>
      @foreach($time_period->people as $person)
          @include("Person.destroy")
      @endforeach
  </div>
    @foreach ($time_period->notes as $time_period_note)
        <div class='clearfix'>
                @include('Note.destroy', ["note"=>$time_period_note, "type"=>"timePeriodNote" ])
                @include('Note.edit', ['note'=>$time_period_note])
        </div>
    @endforeach
    @foreach ($time_period->tasks as $task)
        <div class='clearfix'>
            <div style='padding:0px;'>
                <a href="{{route('TaskType.show', ['id'=>$task->type_id])}}">
                    {{ $task->type->name }}
                </a>
            </div>
        </div>
        <div class='margin-left-3 clearfix'>
            @foreach($task->people as $person)
                @include("Person.destroy")
            @endforeach
        </div>
        <div class='margin-left-3 clearfix'>
            @foreach ( $task->notes as $task_note )
                <div class='row'>
                    <div class='col-lg-6'>
                        <span id='note-report{{$task_note->id}}' class='note-report'>
                            {{ $task_note->report }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
