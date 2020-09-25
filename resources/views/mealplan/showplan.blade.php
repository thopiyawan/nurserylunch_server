@extends('layouts.app')
@section('content')
    {{ Debugbar::info($logs) }}
    {{ Debugbar::info($dayInweek) }}
    <aside id="aside-menu" class="">

        <!-- SER|ARCH SECTION  -->
        @include('mealplan.showsidemenu')

    </aside>
    <div id="wrapper">

        <h1 class="page-title">
            <span>เมนูอาหาร</span>
        </h1>

        <div class="row">
            <div class="col-lg-3">
                <span><i class="far fa-calendar-alt"></i></span>
                <span id="startDate"></span>
                <span id="startDate"></span>
                <span> - </span>
                <span id="endDate"></span>
            </div>
            <div class="col-lg-3">
                <span><i class="fas fa-user-friends"></i></span>
                <span> เด็กอายุต่ำกว่า 1 ปี </span>
            </div>
            <div class="col-lg-3">
                <span><i class="fas fa-utensils"></i></i></span>
                <span> อาหารปกติ</span>
            </div>
            <div class="col-lg-3">
                <a href="/mealplan/edit" class="btn btn-primary pull-right" type="" name="" value="">แก้ไขรายการอาหาร</a>
            </div>
        </div>

        <div class="meal-panel row monday">
            <div class="col col-day">
                <div class="mlabel">จันทร์</div>
                <div class="mdate"><span id="mondayDate"></span></div>
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
                <div class="mdate"><span id="tuesdayDate"></span></div>
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
                <div class="mdate"><span id="wednesdayDate"></span></div>
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
                <div class="mdate"><span id="thursdayDate"></span></div>
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
                <div class="mdate"><span id="fridayDate"></span></div>
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
    @endsection
