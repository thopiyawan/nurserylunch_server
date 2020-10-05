@extends('layouts.app')
@section('content')
    @php
    $day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
    $day_in_week_th = ["จันทร์", "อังคาร", "พุธ", "พฤหัสดี", "ศุกร์"];
    $date_in_week = $dayInweek;
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
                            <div class="col col-food-name" 
                                data-energy="{{$food->getEnergy()}}" 
                                data-protien="{{$food->getProtien()}}"
                                data-fat="{{$food->getFat()}}"
                                id="{{$food->id}}">
                                {{ $food->food_thai }}
                            </div>
                            <div class="col col-delete">
                                <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                                    <span><i class="fas fa-times"></i></span>
                                </a>
                            </div>
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
            @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key], 'date_in_week' =>
            $date_in_week[$key]])
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
            let day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
            let morningList = []
            $(document).ready(function() {
                let day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
                let mondayData = new Date($('.meal-panel.row.monday').data('date'))
                let tuesdayData = new Date($('.meal-panel.row.tuesday').data('date'))
                let wednesdayData = new Date($('.meal-panel.row.wednesday').data('date'))
                let thursdayData = new Date($('.meal-panel.row.thursday').data('date'))
                let fridayData = new Date($('.meal-panel.row.friday').data('date'))
                let mealPlanData = []
                day_in_week.forEach((day) => {
                    let mealLogs = {
                        mealDate: "",
                        breakfast: [],
                        breakfastSnack: [],
                        lunch: [],
                        lunchSnack: [],
                    }
                    let mealDate = new Date($(`.meal-panel.row.${day}`).data('date')).toLocaleDateString()
                    let breakfast = $(`#breakfast-meal-${day} > .ui-sortable .col-food-name`)
                    let breakfastSnack = $(
                        `#breakfast-snack-meal-${day} > .ui-sortable .col-food-name`
                    )
                    console.log("handleClick -> breakfastSnack", breakfastSnack)
                    let lunch = $(`#lunch-meal-${day} > .ui-sortable .col-food-name`)
                    let lunchSnack = $(`#lunch-snack-meal-${day} > .ui-sortable .col-food-name`)
                    mealLogs['mealDate'] = mealDate;
                    $.each(breakfast, function(key, value) {
                        if (value.id !== "") {
                            mealLogs['breakfast'].push(value.id)
                        }
                    })
                    $.each(breakfastSnack, function(key, value) {
                        if (value.id !== "") {
                            mealLogs['breakfastSnack'].push(value.id)
                        }
                    })
                    $.each(lunch, function(key, value) {
                        if (value.id !== "") {
                            mealLogs['lunch'].push(value.id)
                        }
                    })
                    $.each(lunchSnack, function(key, value) {
                        if (value.id !== "") {
                            mealLogs['lunchSnack'].push(value.id)
                        }
                    })
                    mealPlanData.push(mealLogs)
                })
                console.log('addLog function')
                console.log(mealPlanData);
                addFoodLogs(mealPlanData)
            })
        }

        function addFoodLogs(mealPlanData) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/mealplan/foodlogs',
                data: {
                    mealPlanData: mealPlanData
                },
                success: function(data) {
                    //location.reload();
                    alert(data.success)
                }
            });
        }

        //calculate nutrition 
        var targetNutrition = {!! json_encode($targetNutrition) !!};

        console.log("HELLo KELLY");
        console.log(targetNutrition);


        $(".energy .target").text(targetNutrition["energy"][1] + "-" + targetNutrition["energy"][2]);
        $(".protien .target").text(targetNutrition["protien"][1] + "-" + targetNutrition["protien"][2]);
        $(".fat .target").text(targetNutrition["fat"][1] + "-" + targetNutrition["fat"][2]);
        
    </script>
@endsection
