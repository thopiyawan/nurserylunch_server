<div class="meal-panel row monday">
    <div class="col col-day">
        <div class="mlabel">จันทร์</div>
        <div class="mdate"><span id="mondayDate">{{ date('d', strtotime($dayInweek[0])) }}</span></div>
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างเช้า</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[0])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">กลางวัน</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[0])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างบ่าย</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[0])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
</div>


<div class="meal-panel row tuesday">
    <div class="col col-day">
        <div class="mlabel">อังคาร</div>
        <div class="mdate"><span id="tuesdayDate">{{ date('d', strtotime($dayInweek[1])) }}</span></div>
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างเช้า</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[1])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">กลางวัน</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[1])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างบ่าย</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[1])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
</div>


<div class="meal-panel row wednesday">
    <div class="col col-day">
        <div class="mlabel">พุธ</div>
        <div class="mdate"><span id="wednesdayDate">{{ date('d', strtotime($dayInweek[2])) }}</span></div>
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างเช้า</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[2])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">กลางวัน</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[2])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างบ่าย</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[2])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
</div>

<div class="meal-panel row thursday">
    <div class="col col-day">
        <div class="mlabel">พฤหัสบดี</div>
        <div class="mdate"><span id="thursdayDate">{{ date('d', strtotime($dayInweek[3])) }}</span></div>
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างเช้า</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[3])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">กลางวัน</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[3])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างบ่าย</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[3])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
</div>

<div class="meal-panel row friday">
    <div class="col col-day">
        <div class="mlabel">ศุกร์</div>
        <div class="mdate"><span id="fridayDate">{{ date('d', strtotime($dayInweek[4])) }}</span></div>
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างเช้า</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 2 && $log->meal_date == $dayInweek[4])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">กลางวัน</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 3 && $log->meal_date == $dayInweek[4])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
    <div class="col col-meal">
        <div class="mlabel">ว่างบ่าย</div>
        @foreach ($logs as $log)
            @if ($log->meal_code == 4 && $log->meal_date == $dayInweek[4])
                <div class="mrecipe"> - {{ $log->food_thai }}</div>
            @endif
        @endforeach
    </div>
</div>
