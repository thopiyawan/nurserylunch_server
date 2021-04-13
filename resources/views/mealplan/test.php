@foreach ($selectedDates as $date)
    <div class="meal-panel row {{$date['engDay']}}">
        <div class="col col-day col-lg-1">
            <div class="mlabel">{{$date['thDay']}} </div>
            <div class="mdate"><span id="{{$date['engDay']}}Date">{{ date('d', strtotime($date['date'])) }}</span></div>
        </div>
        @foreach ($mealSetting as $meal)
            @if ($meal[2] == 1)
                <div class="col">
                    <div class="mlabel">{{$meal[1]}}</div>
                        @php $type =  empty($logs) ? 0 : $logs[0]->food_type @endphp
                        @foreach ($logs as $log)
                            @if ($log->meal_code == $meal[0] && $log->meal_date == $date['date'])
                                <div class="mrecipe"> 
                                    <ul>
                                        <li>
                                        @if($log->food_type != 8 && $log->food_type != 22)
                                            <span class="text-highlight">({{$log->setting_description_thai}})</span>
                                        @endif
                                            {{ $log->food_thai }} 
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endforeach
