<div class='timePeriod clearfix row'>
<div class='listOfActiveTasks clear'>
    @foreach ($time_period->notes as $time_period_note)
        <div class='row'>
            <div class='col-lg-6'>
                @include('Note.destroy', ["note"=>$time_period_note, "type"=>"timePeriodNote" ])
                @include('Note.edit', ['note'=>$time_period_note])
            </div>
        </div>
    @endforeach
    @foreach ($time_period->tasks as $task)
         <div class='col-xs-8 col-lg-3' style='padding:0px;'>
             @include('Task.destroy')
         </div>
         <div class='col-xs-4 col-lg-9'>
             <button id='showNewTaskNotes{{ $task->id }}' class='showNewTaskNotes btn btn-info'>
                 Note
             </button>
         </div>
        <div id='newTaskNote{{ $task->id }}' class='newTaskNote' >
        </div>
        <div class='margin-left-3'>
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
</div>
