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
                @include('Task.destroy')
            </div>
            <div id='new-person-task{{$task->id}}' class='new-person col-lg-6 task-menu'>
            </div>
            <div id='newTaskNote{{ $task->id }}' class='newTaskNote task-menu' >
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
                        @include('Note.destroy', ["note"=>$task_note, "type"=>"taskNote"])
                        @include('Note.edit', ['note'=>$task_note])
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
