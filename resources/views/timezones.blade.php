<?php use DateTimeZone; ?>
@extends('master')

@section('content')
<h4>Tme Zone</h4>
<p class='margin-left'>
    Your time-zone is: {{Auth::user()->timezone}}
</p>
<form method="POST" action="{{route('settings.timezone')}}" class='margin-left'>
    <div>
    @if ($errors->get('timezone'))
        @foreach ($errors->get('timezone') as $error)
        <div class='text-danger'>{{ $error }}</div>
        @endforeach
    @endif
    </div>
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <select name='timezone'>
    <?php
    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        foreach($tzlist as $tz){
            echo "<option ";
            if ($tz == Auth::user()->timezone){
                echo "selected";
            }
            echo ">$tz</option>";
        }
    ?>
    </select>
    <input type='submit' value='Change Time Zone' />
</form>
@endsection
