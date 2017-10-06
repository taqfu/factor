<div class='listOfActiveTasks clearfix'>
  	<div class=' row'  style='margin-left:0px;'>
  	    @foreach($time_period->people as $person)
  	        @include("Person.destroy")
  	    @endforeach
  	</div>
    @foreach ($time_period->notes as $time_period_note)
        <div class='  row' style='margin-left:0px;'>
                @include('Note.destroy', ["note"=>$time_period_note, "type"=>"timePeriodNote" ])
                @include('Note.edit', ['note'=>$time_period_note])
        </div>
    @endforeach
    @foreach ($time_period->tasks as $task)
        <div class=' row'>

    			<div class='col-md-3'>
                	@include('Task.destroy')
    			</div><div class='col-md-9' style='padding-left:30px;'>
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
            </div>
            <div id='new-person-task{{$task->id}}' class='new-person col-lg-6 task-menu'>
            </div>
            <div id='newTaskNote{{ $task->id }}' class='newTaskNote task-menu' >
            </div>
        </div>
        <div class='task-submenu clearfix'>
            @foreach($task->people as $person)
                @include("Person.destroy")
            @endforeach
        </div>
        <div class='task-submenu clearfix'>
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
