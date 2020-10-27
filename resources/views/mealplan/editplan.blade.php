@extends('layouts.app')
@section('content')
    @php
    $day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
    $day_in_week_th = ["จันทร์", "อังคาร", "พุธ", "พฤหัสดี", "ศุกร์"];
    $date_in_week = $dayInweek;
    @endphp
    <div class="sidebar-scroll">
        <aside id="aside-menu" class="">

            <div id="navigation" style="overflow: hidden; width: auto; height: 100%;">
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
                        <select id="" name="{{ $ig->ingredient_group_eng_name }}"
                            class="{{ $ig->ingredient_group_eng_name }}-select in-group-select" multiple="multiple"
                            data-style="btn-select-picker">
                            @foreach ($ig->ingredients()->get() as $in)
                                {{ $in->ingredient_name }}
                                <option value="{{ $in->id }}" data-icon="">{{ $in->ingredient_name }}</option>
                            @endforeach
                        </select>
                    @endforeach
                </div>
                <div class="m-b">
                    <h4 class="">ผลลัพธ์</h4>
                    <div class="" id="filter-result">
                        @foreach ($foodList as $food)
                            <div class="ui-sortable food-list">
                                <div class="menu-body">
                                    <div class="col col-food-name" data-energy="{{ $food->getEnergy() }}"
                                        data-protein="{{ $food->getProtein() }}" data-fat="{{ $food->getFat() }}"
                                        id="{{ $food->id }}">
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
            </div>
        </aside>
    </div>
    <div id="wrapper">
        <div class="row">
            <div class="col-lg-2">
                <h1 class="page-title"> แก้ไขเมนูอาหาร </h1>
            </div>
            <div class="col-lg-3 heading-p-t">
                <h3>
                    <i class="fas fa-calendar-alt color-gray"></i>
                    <span id="startDate"></span>
                    <span id="startDate"></span>
                    <span> - </span>
                    <span id="endDate"></span>
                </h3>
            </div>
            <div class="col-lg-4 heading-p-t">
                <h3>
                    <span><i class="fas fa-user-friends color-gray"></i></span>
                    <span> เด็กอายุต่ำกว่า 1 ปี </span>
                </h3>
            </div>
            <div class="col-lg-3 heading-p-t">
                <button class="btn btn-primary pull-right" type="submit" name="update" value="school"
                    onclick="handleClick()">บันทึกรายการอาหาร</button>
            </div>
        </div>
        <div class="row">

        </div>

        <div class="hpanel plan-panel">
            <ul class="nav nav-tab">
                <li class="">
                    <a data-toggle="tab" href="#tab-1" aria-expanded="true" class="active">ต่ำกว่า 1 ปี (ปกติ)</a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#tab-2" aria-expanded="false">ต่ำกว่า 1 ปี (มุสลิม)</a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#tab-3" aria-expanded="false">ต่ำกว่า 1 ปี (แพ้กุ้ง)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="">
                        <div id="">
                            @foreach ($day_in_week as $key => $day)
                                @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key], 'date_in_week' => $date_in_week[$key], 'kelly_type' => 'normal'])
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="">
                        <div id="">
                            @foreach ($day_in_week as $key => $day)
                                @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key], 'date_in_week' =>$date_in_week[$key], 'kelly_type' => 'special_muslim'])
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="">
                        <div id="">
                            @foreach ($day_in_week as $key => $day)
                                @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key], 'date_in_week' =>$date_in_week[$key], 'kelly_type' => 'special_shrimp'])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="form-group">
            <div class="col-lg-8 col-sm-offset-4">
                <button class="btn btn-default" type="">ยกเลิก</button>
                <button class="btn btn-primary" type="submit" name="update" value="school"
                    onclick="handleClick()">บันทึกข้อมูล</button>
            </div>
        </div> -->
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
        $('.mdate.monday').text(mondayDate.getDate())
        $('.mdate.tuesday').text(tuesdayDate.getDate())
        $('.mdate.wednesday').text(wednesdayDate.getDate())
        $('.mdate.thursday').text(thursdayDate.getDate())
        $('.mdate.friday').text(fridayDate.getDate())
        $('.meal-panel.row.monday').attr("data-date", mondayDate)
        $('.meal-panel.row.tuesday').attr("data-date", tuesdayDate)
        $('.meal-panel.row.wednesday').attr("data-date", wednesdayDate)
        $('.meal-panel.row.thursday').attr("data-date", thursdayDate)
        $('.meal-panel.row.friday').attr("data-date", fridayDate)
        $('#startDate').text(mondayDate.toLocaleDateString('th-TH', {
            year: '2-digit',
            month: 'short',
            day: 'numeric',
        }))
        $('#endDate').text(fridayDate.toLocaleDateString('th-TH', {
            year: '2-digit',
            month: 'short',
            day: 'numeric',
        }))


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

        //---- ui-sortable (drag and drop food) ----
        $(".ui-sortable").sortable({
            cancel: ".ui-state-disabled",
            connectWith: ".ui-sortable-meal",
            cursor: "move",
            cursorAt: {
                top: 5,
                left: 5
            },
            dropOnEmpty: false,
            remove: onSortableRemove,
            receive: onSortableReceive,

        });

        function onSortableRemove(event, ui) {
            var target = event.target;
            if (target.classList.contains("food-list")) {
                ui.item.clone(true).appendTo(target);
            }
            var parent = $(event.target).parents('.meal-panel');
        }

        function onSortableReceive(event, ui) {
            var parent = $(event.target).parents('.meal-panel');
            calculateNutrition(parent);

            //---
            console.log(ui);
            var parent = $(ui.item).parent();
            var meal = parent.data('meal');
            var day = parent.data('day');
            var food_type = parent.data('type');
            console.log(parent);
            console.log(meal);

            if(food_type == "normal"){
                var slector = meal+"-"+day;
                var target = $(".ui-sortable-meal."+slector).not(".normal");
                var food_clone = ui.item.clone(true).addClass("ui-state-disabled");
                food_clone.prependTo(target);
            }
            //ui.item.clone(true).appendTo();
        }


        $('[data-toggle="tooltip"]').tooltip();

        $(".col-delete").on('click', onColDeleteClick);

        function onColDeleteClick(event) {
            var parent = $(this).parents('.meal-panel');
            $(this).parent().remove();
            calculateNutrition(parent);
        }

        //calculate nutrition 
        var targetNutrition = JSON.parse('<?php echo json_encode($targetNutrition); ?>')

        initCalculation();
        initTarget();


        function initCalculation() {
            $('.meal-panel').each(function() {
                calculateNutrition($(this));
            });
        }

        function initTarget() {
            var keys = Object.keys(targetNutrition);
            $.each(keys, function() {
                var key = this;
                var target = "." + key + " .target";
                var scale = targetNutrition[key];
                $(target).text(scale[1] + "-" + scale[2]);
            });
        }

        function calculateNutrition(parent) {
            var sumEnergy = 0;
            var sumProtein = 0;
            var sumFat = 0;
            var currentEnergyDom = parent.find(".energy .current");
            var currentProteinDom = parent.find(".protein .current");
            var currentFatDom = parent.find(".fat .current");
            var allFoodLog = parent.find(".col-food-name");

            allFoodLog.each(function(index) {
                sumEnergy += parseFloat($(this).attr("data-energy"));
                sumProtein += parseFloat($(this).attr("data-protein"));
                sumFat += parseFloat($(this).attr("data-fat"));
            });

            currentEnergyDom.text(sumEnergy.toFixed(0));
            currentProteinDom.text(sumProtein.toFixed(0));
            currentFatDom.text(sumFat.toFixed(0));

            updateNutritionBar(parent, "energy", sumEnergy);
            updateNutritionBar(parent, "protein", sumProtein);
            updateNutritionBar(parent, "fat", sumFat);

        }

        function updateNutritionBar(parent, key, sum) {
            // update nutirion bar
            var scale = targetNutrition[key];
            //console.log(scale);
            var grade = "";
            if (sum >= scale[3]) {
                grade = "toohigh";
            } else if (sum >= scale[2]) {
                grade = "high";
            } else if (sum >= scale[1]) {
                grade = "ok";
            } else if (sum >= scale[0]) {
                grade = "low";
            } else {
                grade = "toolow";
            }

            parent.find("." + key).find(".nut-bar").removeClass("selected");
            parent.find("." + key).find(".nut-bar." + grade).addClass("selected");
        }


        let fillterSelect = {
            meat: [],
            vegetable: [],
            protein: []
        }

        $('select[name="meat"]').change(function() {
            let values = $(this).val();
            fillterSelect['meat'] = values
            filterFoodList(fillterSelect)
        });
        $('select[name="vegetable"]').change(function() {
            let values = $(this).val();
            fillterSelect['vegetable'] = values
            filterFoodList(fillterSelect)
        });
        $('select[name="protein"]').change(function() {
            let values = $(this).val();
            fillterSelect['protein'] = values
            filterFoodList(fillterSelect)
        });
        $('select[name="fruit"]').change(function() {
            let values = $(this).val();
            fillterSelect['fruit'] = values
            filterFoodList(fillterSelect)
        });

        function filterFoodList(fillterSelect) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/mealplan/filterIngredient',
                data: {
                    filterSelected: fillterSelect
                },
                success: function(data) {
                    $("#filter-result").html(data);
                }
            });
        }

    </script>
@endsection
