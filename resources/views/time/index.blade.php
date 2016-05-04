@extends ('master')

@section ('content')
<?php $route_name = Route::getCurrentRoute()->getName(); ?>
<div style='padding-bottom:32px;'>
    <div>
    <a href="{{ route('time.today') }}">[ Today ]</a>
    <a href="{{ route('time', ['period'=>'yesterday']) }}">[ Yesterday ]</a>
    <a href="{{ route('time', ['period'=>'week']) }}">[ Week ]</a>
    <a href="{{ route('time.all') }}">[ All ]</a>
    </div>
    <a href="{{ route('log') }}">Log</a>
</div>

@include ('TimePeriod.create') 

<input type='button' id='showNewTaskTypes' class='textButton' value='[ Show Task Types ]' />
<input type='button' id='hideNewTaskTypes' class='textButton' value='[ Hide Task Types ]' />
<input type='button' id='showInactiveTimePeriods' class='textButton' value='[ Show Inactive Time Periods ]' />
<input type='button' id='hideInactiveTimePeriods' class='textButton' value='[ Hide Inactive Time Periods ]' />

@include ('TaskType.index')

<div id='newTaskForm'>
</div>

@include ("TimePeriod.index")

@endsection
