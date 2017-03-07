<?php
    use App\User;

?>
<div class="col-xs-3"></div>
<div id='time-period-menu' class="col-xs-6" Style='padding:0px;'>
    <div class="">
        &nbsp;
        @include ('TimePeriod.destroy')
        <a href="#" id="close-time-period-menu"class='pull-right margin-right'>X</a>
    </div>
    <div class="text-center">
        <div Style='font-size:2em;'>01/01/17</div>
    </div>
    <div class="margin-bottom" >
        {{ date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->start)))  }} -
        @if ($time_period->end==0)
            @include ('TimePeriod.edit', ['when'=>'now', 'time_period_menu'=>true])
            /
            <button id='specifyEndTime{{ $time_period->id }}' class='specifyEndTime btn btn-link' Style='font-size:1.5em;'>
                Specify
            </button>
            <button id='hideSpecifyEndTime{{ $time_period->id }}'
              class='hideSpecifyEndTime btn btn-info hidden'>
                Hide
            </button>
            <?php
                $begin = new DateTime($time_period->start);
                $end = new DateTime();
            ?>
        @elseif ($time_period->end!=0)
            <div class='inline'>
                {{ date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->end)))  }}
                <?php
                    $begin = new DateTime($time_period->start);
                    $end = new DateTime($time_period->end);
                ?>
            </div>
        @endif
        <div class='inline'>
            <?php
                $interval = $begin->diff($end);
                $hours = (int)$interval->format('%h');
                $minutes = (int)$interval->format('%i');
                $seconds = (int)$interval->format('%S');
            ?>
            (
            <strong>
                @if ($hours>0)
                    {{ $hours }}h
                @endif
                @if ($minutes>0)
                    {{ $minutes }}m
                @endif
                @if ($seconds>0)
                    {{ $seconds }}s
                @endif
            </strong>
            )
            @if ($time_period->end !=0)

                    <form method="POST" action="{{route('time.resume', ['id'=>$time_period->id])}}"
                      class='inline hidden' role='form'>
                        {{csrf_field()}}
                        <button class='btn btn-primary'>
                            Resume
                        </button>
                    </form>



            @endif
            @if ($time_period->end==0)
                <div id='selectEndTimestamp{{ $time_period->id }}'
                  class='selectEndTimestamp hidden clearfix margin-left-3'>
                    @include ('TimePeriod.edit', ['when'=>'specify'])
                </div>
            @endif

    </div>
    <div style='font-size:.75em'>
        <div class="listOfActiveTasks margin-right">
            @foreach ($time_period->tasks as $task)
                <div class="task-item ">
                    <b>{{ $task->type->name }}</b>
                    @foreach ( $task->notes as $task_note )
                        <div class='margin-left-3 clearfix'>
                            <i>{{ $task_note->report }}</i>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div id="time-period-menu-bottom">
        <ul class="nav nav-pills nav-justified bg-primary ">
          <li id="new-task"><a href="#">New Task</a></li>
          <li id="new-note"><a href="#">New Note</a></li>
        </ul>
        <div id="time-period-menu-input-container"></div>
    </div>
</div>
<div class="col-xs-3"></div>
