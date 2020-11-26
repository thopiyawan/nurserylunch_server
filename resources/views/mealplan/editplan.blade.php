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
    <div id="wrapper" class="meal-plan">
        <div class="row fixed-info-box">
            <div class="col">
                <h1 class="page-title"> แก้ไขเมนูอาหาร </h1>
            </div>
            <div class="col heading-p-t">
                <div>
                    <i class="fas fa-calendar-alt"></i>
                    <span id="startDate"></span>
                    <span id="startDate"></span>
                    <span> - </span>
                    <span id="endDate"></span>
                </div>
            </div>
            <div class="col heading-p-t">
                <div>
                    <span><i class="fas fa-user-friends color-gray"></i></span>
                     <span id="age-range-span"> ต่ำกว่า 1 ปี</span>
                </div>

            </div>
            <div class="col heading-p-t">
                <span><i class="fas fa-utensils color-gray"></i></span>
                <span id="food-type-span" class="food-type normal"> อาหารปกติ </span>
            </div>
            <div class="col-lg-3">
                <button id="copy-normal-btn" class="btn btn-primary pull-right">คัดลอกเมนูจากอาหารปกติ</button>
            </div>
        </div>
        <div class="row">
        </div>
        <div class="hpanel plan-panel">
            {{-- <div class="row">
                <div class="col-lg-9">
                    <ul class="nav nav-tab">
                        @php $first = true; @endphp
                        @foreach (array_keys($settings) as $setting_id)
                            <li class="">
                                <a data-toggle="tab" data-detail="{{ $settings[$setting_id] }}" href="#{{ $setting_id }}"
                                    aria-expanded="true" class="type-tab {{ $first ? 'active' : '' }}">
                                    {{ $settings[$setting_id] }}
                                </a>
                            </li>
                            @php $first = false; @endphp
                        @endforeach
                    </ul>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-lg-9">
                    <ul class="nav nav-tab">
                        @php $first = true; @endphp
                        @foreach ($settings as $key => $setting_value)

                            <li class="">
                                <a data-toggle="tab" data-detail="{{ $setting_value['setting_description_thai'] }}"
                                    href="#type_{{ $setting_value['food_type'] }}" aria-expanded="true"
                                    class="type-tab {{ $first ? 'active' : '' }}">
                                    <!-- {{ $setting_value['food_type'] . ' | ' . $setting_value['setting_description_thai'] }} -->
                                    {{ $setting_value['setting_description_thai'] }}
                                </a>
                            </li>
                            @php $first = false; @endphp
                        @endforeach
                    </ul>
                </div>
            </div>



            {{-- <div class="tab-content">
                @php $first = true; @endphp
                @foreach (array_keys($settings) as $setting_id)
                    <div id="{{ $setting_id }}" class="tab-pane {{ $first ? 'active' : '' }} ">
                        <div class="">
                            <div id="">
                                @foreach ($day_in_week as $key => $day)
                                    @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key],
                                    'date_in_week' => $date_in_week[$key], 'setting_id' => $setting_id])
                                    <h>{{ $setting_id }}</h>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @php $first = false; @endphp
                @endforeach
            </div> --}}

            <div class="tab-content">
                @php $first = true; @endphp
                @foreach ($settings as $key => $setting_value)
                    <div id="{{ 'type_' . $setting_value['food_type'] }}" data-type="{{$setting_value['food_type']}}" class="tab-pane {{ $first ? 'active' : '' }} ">
                        <div class="">
                            <div id="">
                                @foreach ($day_in_week as $key => $day)
                                    @include('mealplan.mealdate', ['day' => $day, 'day_th' => $day_in_week_th[$key],
                                    'date_in_week' => $date_in_week[$key], 'setting_id' => $setting_value['food_type']])
                                   <!--  <p>--- {{ $setting_value['setting_description_thai'] . 'setting' }} ----</p> -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @php $first = false; @endphp
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-8 col-sm-offset-4">
                <button class="btn btn-default" type="">ยกเลิก</button>
                <button class="btn btn-primary" type="submit" name="update" value="school"
                    onclick="saveLogs()">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="savedModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content success">
            <div class="modal-body text-center">
                <i class="far icon-success fa-check-circle fa-4x m-b"></i>
                <!-- <h3 class="text-success modal-title m-b">บันทึกสำรับอาหารสำเร็จเรียบร้อย</h3> -->
                <h1 class="text-success m-b">บันทึกสำรับอาหารสำเร็จเรียบร้อย</div>
                
                <button type="button" class="btn success btn-default m-b" data-dismiss="modal"> OK </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="application/javascript">
        // your code
        localStorage.setItem("weekHandle", 1)
        let foodType = localStorage.getItem('foodType');
        var text = foodType == 8 ? "เด็กอายุต่ำกว่า 1 ปี" : "เด็กอายุ 1-3 ปี";
        $("#age-range-span").text(text);

        //console.log("foodType", foodType);
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
        $("#copy-normal-btn").hide();
        $("#copy-normal-btn").on("click", copyFood);
        $('.type-tab').on('click', function() {
            var type = "";
            var target = $("#food-type-span");
            var detail = $(this).data("detail");
            var start = detail.indexOf("(");
            var end = detail.indexOf(")");
            var text = detail.substring(start + 1, end);

            $("#food-type-span").text("อาหาร" + text);

            if (text == "ปกติ") {
                target.removeClass("special");
                target.addClass("normal");
                $("#copy-normal-btn").hide();
            } else {
                target.removeClass("normal");
                target.addClass("special");
                $("#copy-normal-btn").show();
            }
        });


        function saveLogs() {
            $(document).ready(function() {
                let day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
                let morningList = []

                //let day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday"];
                let mondayData = new Date($('.meal-panel.row.monday').data('date'))
                let tuesdayData = new Date($('.meal-panel.row.tuesday').data('date'))
                let wednesdayData = new Date($('.meal-panel.row.wednesday').data('date'))
                let thursdayData = new Date($('.meal-panel.row.thursday').data('date'))
                let fridayData = new Date($('.meal-panel.row.friday').data('date'))
                let mealPlanData = []
                var panels = $(".tab-pane");
                $.each(panels, function() {
                    var type = $(this).data("type");

                    day_in_week.forEach((day) => {
                        let mealLogs = {
                            mealDate: "",
                            food_type: type,
                            breakfast: [],
                            breakfastSnack: [],
                            lunch: [],
                            lunchSnack: [],
                        }
                        let mealDate = new Date($(`.meal-panel.row.${day}`).data('date'))
                            .toLocaleDateString()
                        let breakfast = $(this).find('#breakfast-meal-' + day +
                            ' > .ui-sortable .col-food-name')
                        let breakfastSnack = $(this).find('#breakfast-snack-meal-' + day +
                            ' > .ui-sortable .col-food-name')
                        //console.log("breakfastSnack", breakfastSnack);
                        let lunch = $(this).find('#lunch-meal-' + day +
                            ' > .ui-sortable .col-food-name')
                        let lunchSnack = $(this).find('#lunch-snack-meal-' + day +
                            ' > .ui-sortable .col-food-name')

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
                })
                //console.log("mealPlanData", mealPlanData);
                addFoodLogs(mealPlanData)
                //console.log("mealPlanData", mealPlanData);
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
                    //alert(data.success)
                    $('#savedModal').modal('show');
                    //location.reload();
                    //console.log("mealPlanData", mealPlanData);
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
            //console.log(event);
            var dayPanel = $(event.target).parents('.meal-panel');
            calculateNutrition(dayPanel);

            var foodItem = $(ui.item);
            //cloneFoodItem(foodItem);
        }

        function copyFood(event, ui) {
            console.log("coppying");
            //console.log(event);

            var activePanel = $(".tab-pane.active");
            var normalPanel = $("#type_8.tab-pane, #type_22.tab-pane");
            //console.log(activePanel);
            //console.log(normalPanel);

            $.each(activePanel.find(".menu-body").not(".ui-sortable-placeholder"), function() {
                $(this).remove();
            });

            var normalPlans = normalPanel.find(".ui-sortable-meal");
            //console.log(normalPlans);
            $.each(normalPlans, function() {
                var meal = $(this).data("meal");
                var day = $(this).data("day");
                var slector = meal + "-" + day;

                var target = activePanel.find(".ui-sortable-meal." + slector); //.find(".placeholder");
                var foods = $(this).find(".menu-body").not(".ui-sortable-placeholder");

                $.each(foods, function() {
                    var foodItem = $(this);
                    console.log(foodItem);

                    var foodId = foodItem.children(":first").attr("id");
                    var targetType = activePanel.attr('id');

                    var cloneItem = foodItem.clone(true);

                    checkMealType(foodId, targetType, cloneItem);
                    cloneItem.insertBefore(target.find(".placeholder"));

                });
            });
            var dayPanels = activePanel.find('.meal-panel');
            $.each(dayPanels, function() {
                calculateNutrition($(this));
            });
        }

        function cloneFoodItem(foodItem) {
            var foodId = foodItem.children(":first").attr("id");
            //console.log(foodId);
            var mealPanel = foodItem.parent()
            var mealData = mealPanel.data('meal');
            var day = mealPanel.data('day');
            var mealType = mealPanel.data('type');

            if (mealType == "is_for_small" || mealType == "is_for_big") {
                var slector = mealData + "-" + day;
                var targets = $(".ui-sortable-meal." + slector).not(".is_for_small", ".is_for_big");
                //console.log(targets);
                $.each(targets, function() {
                    var targetType = $(this).data("type");

                    var cloneItem = foodItem.clone(true);

                    checkMealType(foodId, "mealType", cloneItem);
                    cloneItem.prependTo(this);


                    var dayPanel = $(this).parents('.meal-panel');
                    calculateNutrition(dayPanel);
                });

            }
        }

        function checkMealType(id, type, cloneItem) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/mealplan/checkFoodType',
                data: {
                    foodId: id,
                    checkType: type,
                    age: "age6_8mo"
                },
                success: function(result) {
                    console.log(id, type, result)
                    var safe = result == 1 ? true : false;
                    if (safe) {
                        //cloneItem.addClass("ui-state-disabled"); // safe to eat

                    } else {
                        cloneItem.addClass("ui-state-warning");
                    }
                }
            });
        }


        $('[data-toggle="tooltip"]').tooltip();

        $(".col-delete").on('click', onColDeleteClick);

        function onColDeleteClick(event) {
            var dayPanel = $(this).parents('.meal-panel');
            var mealPanel = $(this).parents('.ui-sortable-meal');
            var foodId = $(this).prev().attr("id");
            console.log(foodId);

            $(this).parent().remove();
            calculateNutrition(dayPanel);

            //console.log(this);

            // delete cloned item
            // var mealData = mealPanel.data('meal');
            // var day = mealPanel.data('day');
            // var mealType = mealPanel.data('type');
            // if(mealType == "is_for_small" || mealType == "is_for_big"){
            //     console.log("normal");
            //     var slector = mealData+"-"+day;
            //     var targets = $(".ui-sortable-meal."+slector).not(".is_for_small", ".is_for_big");

            //     $.each(targets, function(){
            //         //console.log(this);
            //         var dayPanel = $(this).parents('.meal-panel');
            //         var sameItem = $(this).find("#"+foodId);
            //         sameItem.parent().remove();
            //         calculateNutrition(dayPanel); 
            //     });
            //}
        }

        //calculate nutrition 
        var targetNutrition = JSON.parse('<?php echo json_encode($targetNutrition); ?>')

        initCalculation();
        initTarget();


        function initCalculation() {
            var mealPanel = $('.meal-panel');
            if (mealPanel.children("#menu-body").length > 0){
                mealPanel.each(function() {
                    calculateNutrition($(this));
                });
            }
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

        function calculateNutrition(panel) {
            var sumEnergy = 0;
            var sumProtein = 0;
            var sumFat = 0;
            var currentEnergyDom = panel.find(".energy .current");
            var currentProteinDom = panel.find(".protein .current");
            var currentFatDom = panel.find(".fat .current");
            var allFoodLog = panel.find(".col-food-name");

            allFoodLog.each(function(index) {
                sumEnergy += parseFloat($(this).attr("data-energy"));
                sumProtein += parseFloat($(this).attr("data-protein"));
                sumFat += parseFloat($(this).attr("data-fat"));
            });

            currentEnergyDom.text(sumEnergy.toFixed(0));
            currentProteinDom.text(sumProtein.toFixed(0));
            currentFatDom.text(sumFat.toFixed(0));
            updateNutritionBar(panel, "energy", sumEnergy);
            updateNutritionBar(panel, "protein", sumProtein);
            updateNutritionBar(panel, "fat", sumFat);

        }

        function updateNutritionBar(parent, key, sum) {
            // update nutirion bar
            var scale = targetNutrition[key];
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
        let query = ""

        $('select[name="meat"]').change(function() {
            let values = $(this).val();
            fillterSelect['meat'] = values
            filterFoodList(fillterSelect, query)
        });
        $('select[name="vegetable"]').change(function() {
            let values = $(this).val();
            fillterSelect['vegetable'] = values
            filterFoodList(fillterSelect, query)
        });
        $('select[name="protein"]').change(function() {
            let values = $(this).val();
            fillterSelect['protein'] = values
            filterFoodList(fillterSelect, query)
        });
        $('select[name="fruit"]').change(function() {
            let values = $(this).val();
            fillterSelect['fruit'] = values
            filterFoodList(fillterSelect, query)
        });


        $(document).on('keyup', '#searchMenu', function() {
            delay: 100,
            query = $(this).val();
            filterFoodList(fillterSelect, query)
        });

        // function fetch_live_search(fillterSelect, query = '') {
        //     $.ajax({
        //         url: "/mealplan/filterIngredient",
        //         method: 'GET',
        //         data: {
        //             filterSelected: fillterSelect,
        //             query: query
        //         },
        //         success: function(data) {
        //             $("#filter-result").html(data);
        //         }
        //     })
        // }

        function filterFoodList(fillterSelect, query) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/mealplan/filterIngredient',
                data: {
                    query: query,
                    filterSelected: fillterSelect,
                },
                success: function(data) {
                    console.log("filterFoodList -> data", data)

                    $("#filter-result").html(data);
                }
            });
        }

        // function filterFoodList(fillterSelect) {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: 'POST',
        //         url: '/mealplan/filterIngredient',
        //         data: {
        //             filterSelected: fillterSelect
        //         },
        //         success: function(data) {
        //             $("#filter-result").html(data);
        //         }
        //     });
        // }

    </script>
    <!-- <script src="{{ asset('js/getfoodlogs.js') }}"></script> -->
@endsection
