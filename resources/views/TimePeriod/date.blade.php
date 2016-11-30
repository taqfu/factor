<?php
    use App\TimePeriod;
?>
@extends ('master')

@section('content')

    <a href="{{url('/')}}" class='lead'>Home</a>
    <div class='margin-top'>
    <?php $date = date('Y-m-d', strtotime($earliest_time_period->created_at)); ?>
    @while (strtotime($date) <= strtotime($last_time_period->created_at)) 
        <div class='margin-left'>
            @if (TimePeriod::any_entries_on($date))
                <a href="{{route('indexDate', [
                  'month'=>date('m', strtotime($date)), 
                  'day'=>date('d', strtotime($date)),
                  'year'=>date('y', strtotime($date)),
                  ])}}">
                    {{date("F j, Y (l)", strtotime($date))}}
                </a>
            @endif
        </div>
        <?php
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        ?>
    @endwhile
    </div>
@endsection
