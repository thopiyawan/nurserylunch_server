@foreach ($dateData as $date)
<!-- foreach ($dateData as $key => $value) {    -->
    <div class="meal-panel row {{$date[0]}}">
        <div class="col col-day col-lg-1">
            <div class="mlabel">{{$date[1]}}</div>
            <div class="mdate"><span id="{{$date[0]}}Date">{{ date('d', strtotime($date[2])) }}</span></div>
        </div>
        @foreach ($mealSetting as $meal)
            @if ($meal[2] == 1)
                <div class="col">
                    <div class="mlabel">{{$meal[1]}}</div>
                        @php $type =  empty($logs) ? 0 : $logs[0]->food_type @endphp
                        @foreach ($logs as $log)
                            @if ($log->meal_code == $meal[0] && $log->meal_date == $date[2])
                               <!--  @if ($type != $log->food_type)
                                    <div class="text-highlight text-italic"> {{$log->setting_description_thai}}</div>
                                @endif -->
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

        <!-- @if ($userSetting->is_breakfast == 1)
            <div class="col col-meal">
                <div class="mlabel">เช้า</div>
                @foreach ($logs as $log)
                    @if ($log->meal_code == 1 && $log->meal_date == $date[2])
                        <div class="mrecipe"> - {{ $log->food_thai }} 0000</div>
                    @endif
                @endforeach
            </div>
        @endif

        @if ($userSetting->is_morning_snack == 1)
            <div class="col col-meal">
                <div class="mlabel">ว่างเช้า</div>
                    @foreach ($logs as $log)
                        @if ($log->meal_code == 2 && $log->meal_date == $date[2])
                            <div class="mrecipe row">
                                <div class="col-lg-1" >
                                    <i class="fas gray-icon fa-utensil-spoon"></i>
                                </div>
                                <div class="col-lg-11" >
                                        {{ $log->food_thai }}
                                    @if ($log->food_type != 8 && $log->food_type != 22)
                                        ( {{$log->setting_description_thai}} )
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
            </div>
        @endif

        @if ($userSetting->is_lunch == 1)
            <div class="col col-meal">
                <div class="mlabel">กลางวัน</div>
                @foreach ($logs as $log)
                    @if ($log->meal_code == 3 && $log->meal_date == $date[2])
                        <div class="mrecipe"> - {{ $log->food_thai }}</div>
                    @endif
                @endforeach
            </div>
        @endif

        @if ($userSetting->is_afternoon_snack)
            <div class="col col-meal">
                <div class="mlabel">ว่างบ่าย</div>
                @foreach ($logs as $log)
                    @if ($log->meal_code == 4 && $log->meal_date == $date[2])
                        <div class="mrecipe"> - {{ $log->food_thai }}</div>
                    @endif
                @endforeach
            </div>
        @endif -->

    </div>
@endforeach
<!-- ddddddd -->
<!-- 
<div class="meal-panel row tuesday">
    <div class="col col-day">
        <div class="mlabel">อังคาร</div>
        <div class="mdate"><span id="tuesdayDate">{{ date('d', strtotime($dayInweek[1])) }}</span></div>
    </div>

    @if ($userSetting->is_breakfast == 1)
        <div class="col col-meal">
            <div class="mlabel">เช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 1 && $log->meal_date == $dayInweek[1])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_morning_snack == 1)
        <div class="col col-meal">
            <div class="mlabel">ว่างเช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[1])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_lunch == 1)
        <div class="col col-meal">
            <div class="mlabel">กลางวัน</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[1])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_afternoon_snack)
        <div class="col col-meal">
            <div class="mlabel">ว่างบ่าย</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[1])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

</div>


<div class="meal-panel row wednesday">
    <div class="col col-day">
        <div class="mlabel">พุธ</div>
        <div class="mdate"><span id="wednesdayDate">{{ date('d', strtotime($dayInweek[2])) }}</span></div>
    </div>

    @if ($userSetting->is_breakfast == 1)
        <div class="col col-meal">
            <div class="mlabel">เช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 1 && $log->meal_date == $dayInweek[2])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_morning_snack == 1)
        <div class="col col-meal">
            <div class="mlabel">ว่างเช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[2])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_lunch == 1)
        <div class="col col-meal">
            <div class="mlabel">กลางวัน</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[2])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_afternoon_snack)
        <div class="col col-meal">
            <div class="mlabel">ว่างบ่าย</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[2])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

</div>

<div class="meal-panel row thursday">
    <div class="col col-day">
        <div class="mlabel">พฤหัสบดี</div>
        <div class="mdate"><span id="thursdayDate">{{ date('d', strtotime($dayInweek[3])) }}</span></div>
    </div>

    @if ($userSetting->is_breakfast == 1)
        <div class="col col-meal">
            <div class="mlabel">เช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 1 && $log->meal_date == $dayInweek[3])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_morning_snack == 1)
        <div class="col col-meal">
            <div class="mlabel">ว่างเช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[3])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_lunch == 1)
        <div class="col col-meal">
            <div class="mlabel">กลางวัน</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[3])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_afternoon_snack)
        <div class="col col-meal">
            <div class="mlabel">ว่างบ่าย</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[3])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif
</div>

<div class="meal-panel row friday">
    <div class="col col-day">
        <div class="mlabel">ศุกร์</div>
        <div class="mdate"><span id="fridayDate">{{ date('d', strtotime($dayInweek[4])) }}</span></div>
    </div>

    @if ($userSetting->is_breakfast == 1)
        <div class="col col-meal">
            <div class="mlabel">เช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 1 && $log->meal_date == $dayInweek[4])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_morning_snack == 1)
        <div class="col col-meal">
            <div class="mlabel">ว่างเช้า</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[4])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_lunch == 1)
        <div class="col col-meal">
            <div class="mlabel">กลางวัน</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[4])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif

    @if ($userSetting->is_afternoon_snack)
        <div class="col col-meal">
            <div class="mlabel">ว่างบ่าย</div>
            @foreach ($logs as $log)
                @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[4])
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endif
            @endforeach
        </div>
    @endif
</div>
 -->