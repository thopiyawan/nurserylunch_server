@extends('layouts.app')
@section('content')
    @php
    $day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
    $day_in_week_th = ["จันทร์", "อังคาร", "พุธ", "พฤหัสดี", "ศุกร์"];
    @endphp
    <aside id="aside-menu" class="center">
        <!-- SER|ARCH SECTION  -->
        <div class="m-b">
            <h4 class="">ค้นหาเมนู</h4>
            <input type="text" title="ค้นหาเมนู" placeholder="ค้นหาเมนู" name="searchMenu" id="searchMenu"
                class="form-control">
        </div>
        <!-- FILTER SECTION  -->
        <div class="m-b">
            <h4 class="">ตัวกรอง</h4>
            @foreach ($in_groups as $ig)
                <select id="" class="{{ $ig->ingredient_group_eng_name }}-select in-group-select" multiple="multiple"
                    data-style="btn-select-picker">
                    @foreach ($ig->ingredients()->get() as $in)
                        {{ $in->ingredient_name }}
                        <option value="{{ $in->ingredient_name }}" data-icon="">{{ $in->ingredient_name }}</option>
                    @endforeach
                </select>
            @endforeach
        </div>
        <div class="m-b">
            <h4 class="">ผลลัพธ์</h4>
            <div class="">
                @foreach ($foodList as $food)
                    <div class="ui-sortable food-list">
                        <div class="menu-body">
                            <span id={{ $food->id }}>{{ $food->food_thai }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </aside>
    <div id="wrapper">
        <h1 class="page-title">แก้ไขเมนูอาหาร</h1>
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
        </div>
        @foreach ($day_in_week as $key => $day)
            {{ Debugbar::info() }}
            @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key]])
        @endforeach
        <div class="form-group">
            <div class="col-lg-8 col-sm-offset-4">
                <button class="btn btn-default" type="">ยกเลิก</button>
                <button class="btn btn-primary" type="submit" name="update" value="school"
                    onclick="handleClick()">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="application/javascript">
        // your code
        let mondayDate = new Date(localStorage.getItem('mondayDate'));
        let tuesdayDate = new Date(localStorage.getItem('tuesdayDate'));
        let wednesdayDate = new Date(localStorage.getItem('wednesdayDate'));
        let thursdayDate = new Date(localStorage.getItem('thursdayDate'));
        let fridayDate = new Date(localStorage.getItem('fridayDate'));
        $('#monday').text(mondayDate.getDate())
        $('#tuesday').text(tuesdayDate.getDate())
        $('#wednesday').text(wednesdayDate.getDate())
        $('#thursday').text(thursdayDate.getDate())
        $('#friday').text(fridayDate.getDate())
        $('.meal-panel.row.monday').attr("data-date", mondayDate)
        $('.meal-panel.row.tuesday').attr("data-date", tuesdayDate)
        $('.meal-panel.row.wednesday').attr("data-date", wednesdayDate)
        $('.meal-panel.row.thursday').attr("data-date", thursdayDate)
        $('.meal-panel.row.friday').attr("data-date", fridayDate)
        $('#startDate').text(mondayDate.toLocaleDateString());
        $('#endDate').text(fridayDate.toLocaleDateString());

        function handleClick() {
            let morningList = []
            $(document).ready(function() {
                let date = new Date($('.meal-panel.row.monday').data('date'))
                console.log(date)
                let morning = $("#morning-meal .ui-sortable-handle>span")
                $.each(morning, function(key, value) {
                    if (value.id !== "") {
                        morningList.push(value.id)
                    }
                })
                console.log('morningList = ', morningList)
                getMessage(morningList, date.toDateString())
            })
        }

        function getMessage(morningList, date) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/mealplan/foodlogs',
                data: {
                    morning: morningList,
                    date: date
                },
                success: function(data) {
                    //location.reload();
                    alert(data.success)
                }
            });
        }

    </script>
@endsection
