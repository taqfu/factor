<div class='listOfActiveTasks clearfix ' id="time-period{{$time_period->id}}">
@if(isset($time_period_is_empty) && $time_period_is_empty)

            <h3 class='empty-time-period text-center'>???</h3>

@endif
  	<div class=' row '>
        <div class='col-1  '></div>
  	    @foreach($time_period->people as $person)
  	        @include("Person.destroy")
  	    @endforeach
  	</div>
    @foreach ($time_period->notes as $time_period_note)
        <div class='  row'>

            <div class='col-1 '></div>
                @include('Note.destroy', ["note"=>$time_period_note, "type"=>"timePeriodNote" ])
                @include('Note.edit', ['note'=>$time_period_note])
        </div>
    @endforeach
    @foreach ($time_period->tasks as $task)
        <div class=' row'>
    			<div class='col-9'>
                	@include('Task.destroy')
    			</div><div class='col-1' style=''>
            <button class='btn btn-primary'>+</button>
            <!--
    			            <button id='showNewTaskNotes{{ $task->id }}'
    			              class='showNewTaskNotes btn btn-primary show-task-menu'>
    			                Note
    			            </button>
    			            <button id='hideNewTaskNotes{{ $task->id }}'
    			              class='hideNewTaskNotes btn btn-info hidden hide-task-menu'>
    			                Hide
    			            </button>
    			            <button id='show-new-person-task{{$task->id}}'
    			              class='show-new-person btn btn-primary show-task-menu'>
    			                Person
    			            </button>
    			            <button id='hide-new-person-task{{$task->id}}'
    			              class='hide-new-person btn btn-info hidden hide-task-menu'>
    			                Hide
    			            </button>
          -->
            </div>
            <div id='new-person-task{{$task->id}}' class='new-person col-lg-6 task-menu'>
            </div>
            <div id='newTaskNote{{ $task->id }}' class='newTaskNote task-menu' >
            </div>
        </div>

            @foreach($task->people as $person)
            <div class='row col-12 col-md-9' style='margin-left:17px;'>


                @include("Person.destroy")

            </div>
            @endforeach
            @foreach ( $task->notes as $task_note )
                <div class='row col-12 col-md-9' style='margin-left:17px;'>
                        @include('Note.destroy', ["note"=>$task_note, "type"=>"taskNote"])
                        @include('Note.edit', ['note'=>$task_note])
                </div>
            @endforeach
    @endforeach
</div>
