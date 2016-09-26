<?php
    use App\User;
?>
<div>
    @if($radio)
        <input id='{{ $timestamp_type }}TimestampSelect' type='radio'
          name='{{ $timestamp_type }}When' value='timestamp' />
    @endif
    <select id='{{ $timestamp_type }}Month' class='{{ $timestamp_type }}Timestamp'
      name="{{ $timestamp_type }}Month" >
        @for($month=1 ; $month<13 ; $month++)
        <?php
            $month_val = $month<10 ? "0".$month : $month;
        ?>
            @if ($month==User::local_now("n"))
                <option selected value='{{ $month_val }}' >
            @elseif ($month!=User::local_now("n"))
                <option value='{{ $month_val }}' >
            @endif
        {{ date("F",mktime(0, 0, 0, $month, 10)) }}</option>
        @endfor
    </select>

    <select id='{{ $timestamp_type }}Day' class='{{ $timestamp_type }}Timestamp'
      name="{{ $timestamp_type }}Day">
        @for($day=1 ; $day<32 ; $day++)
        <?php $day_val = $day<10 ? "0".$day : $day;?>
            @if ($day==User::local_now("j"))
                <option selected value='{{ $day_val }}' >
            @elseif ($day!=User::local_now("j"))
                <option value='{{ $day_val }}' >
            @endif
        {{ $day }}</option
        >@endfor

    </select>

    <select id='{{ $timestamp_type }}Year' class='{{ $timestamp_type }}Timestamp'
      name="{{ $timestamp_type }}Year">
        @for($year=date("Y")-1 ; $year<date("Y")+2 ; $year++)
            @if ($year==User::local_now("Y"))
                <option selected value='{{ $year }}' >
            @elseif ($year!=User::local_now("Y"))
                <option value='{{ $year }}' >
            @endif
        {{ $year }}</option>
        @endfor

    </select>
</div>
<div class='margin-left time-select'>
    <select id='{{ $timestamp_type }}Hour' class='{{ $timestamp_type }}Timestamp'
      name="{{ $timestamp_type }}Hour">

    @for ($hour=0; $hour<24; $hour++)
        <?php $hour = $hour<10 ? "0".$hour : $hour; ?>

        @if ($hour==User::local_now("H"))
           <option selected value="{{$hour}}">
        @elseif ($hour!=User::local_now("H"))
           <option value="{{$hour}}">
        @endif
        {{ $hour }}</option>
    @endfor

    </select>

    <select  id='{{ $timestamp_type }}Minute' class='{{ $timestamp_type }}Timestamp'
      name="{{ $timestamp_type }}Minute">
    @for ($minute=0; $minute<60; $minute++)
        <?php $minute = $minute<10 ? "0".$minute : $minute; ?>
        @if ($minute==User::local_now("i"))
           <option selected value="{{$minute}}">
        @elseif ($minute!=User::local_now("i"))
           <option value="{{$minute}}">
        @endif
        {{ $minute }}</option>
    @endfor

    </select>
    Guess? <input type='checkbox' name='{{ $timestamp_type }}Guess' />
</div>
