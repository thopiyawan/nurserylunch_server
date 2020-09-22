@extends('layouts.app')
@section('content')
    {{ Debugbar::info($logs) }}
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
                    {{ Debugbar::info($log) }}
                    <div class="mrecipe"> - {{ $log->food_thai }}</div>
                @endforeach
            </div>
            <div class="col col-meal">
                <div class="mlabel">กลางวัน</div>
                <div class="mrecipe">ข้าวต้มหมูทรงเครื่อง</div>
                <div class="mrecipe">เต้าหู้ผัดเทริยากิ</div>
                <div class="mrecipe">ผัดผักสามสี</div>
            </div>
            <div class="col col-meal">
                <div class="mlabel">ว่างบ่าย</div>
                <div class="mrecipe">ฝักทองนึ่งโรบมะพร้าว</div>
                <div class="mrecipe">กล้วยน้ำหว้า 1 ผล</div>
            </div>

        </div>
        <div class="meal-panel row tuesday">
            <div class="col col-day">
                <div class="mlabel">อังคาร</div>
                <div class="mdate"><span id="tuesdayDate"></div>
            </div>
        </div>
        <div class="meal-panel row wednesday">
            <div class="col col-day">
                <div class="mlabel">พุธ</div>
                <div class="mdate"><span id="wednesdayDate"></div>
            </div>
        </div>
        <div class="meal-panel row thursday">
            <div class="col col-day">
                <div class="mlabel">พฤหัส</div>
                <div class="mdate"><span id="thursdayDate"></div>
            </div>
        </div>
        <div class="meal-panel row friday">
            <div class="col col-day">
                <div class="mlabel">ศุกร์</div>
                <div class="mdate"><span id="fridayDate"></div>
            </div>
        </div>
    </div>
@endsection
