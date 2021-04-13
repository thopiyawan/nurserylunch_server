@extends('layouts.app')
@section('content')
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
                        <select id="ingredients_filters" name="{{ $ig->ingredient_group_eng_name }}"
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
                                <div class="menu-body food">
                                    <div class="col col-food-name" 
                                        data-energy="{{ $food->energy }}"
                                        data-protein="{{ $food->protein }}" 
                                        data-fat="{{ $food->fat }}" 
                                        data-carbohydrate="{{ $food->carbohydrate }}"
                                        data-vitamin_a="{{ $food->vitamin_a }}"
                                        data-vitamin_b1="{{ $food->vitamin_b1 }}"
                                        data-vitamin_b2="{{ $food->vitamin_b2 }}"
                                        data-vitamin_c="{{ $food->vitamin_c }}"
                                        data-iron="{{ $food->iron }}"
                                        data-calcium="{{ $food->calcium }}"
                                        data-phosphorus="{{ $food->phosphorus }}"
                                        data-fiber="{{ $food->fiber }}"
                                        data-sodium="{{ $food->sodium }}"
                                        data-sugar="{{ $food->sugar }}"
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
            <div class="row">
                <div class="col-lg-9">
                    <ul class="nav nav-tab">
                        @php $first = true; @endphp
                        @foreach ($selectedFoodTypes as $key => $setting)
                            <li class="">
                                <a data-toggle="tab" 
                                    data-detail="{{ $setting['name_thai'] }}"
                                    data-type="{{$setting['id']}}"
                                    href="#type_{{ $setting['id'] }}" aria-expanded="true"
                                    class="type-tab {{ $first ? 'active' : '' }}">
                                    {{ $setting['age_thai'] . ' ( ' .$setting['name_thai'].')' }}
                                </a>
                            </li>
                            @php $first = false; @endphp
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                @php $first = true; @endphp
                @foreach ($selectedFoodTypes as $key => $setting)
                    <div id="{{ 'type_' . $setting['id'] }}" data-type="{{$setting['id']}}" class="tab-pane {{ $first ? 'active' : '' }} ">
                        <div class="">
                            <div id="">
                                @include('mealplan.mealdate', ['setting_id' => $setting['id']])
     
                            </div>
                        </div>
                    </div>
                    @php $first = false; @endphp
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="text-center">
                <button class="btn btn-default" type="">ยกเลิก</button>
                <button class="btn btn-primary" type="submit" name="update" value="school"
                    onclick="saveLogs()">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="savedModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog wide">
        <div class="modal-content success">
            <div class="modal-body text-center">
                <i class="far icon-success fa-check-circle fa-4x m-b"></i>
                <!-- <h3 class="text-success modal-title m-b">บันทึกสำรับอาหารสำเร็จเรียบร้อย</h3> -->
                <h1 class="text-success">บันทึกสำรับอาหารสำเร็จเรียบร้อย</h1>
                <div class="text-danger m-t m-b">* ข้าพเจ้ารับทราบว่าอาหารที่จัดจากระบบแนะนำอาหารกลางวันสำหรับเด็กเล็กนี้ เพื่อให้ได้สารอาหารตามที่จัดไว้ ต้องเป็นไปตามสูตร ส่วนประกอบและวัตถุดิบ ที่ระบุจากระบบนี้เท่านั้น </div>
                <div class="text-center">
                    <button type="button" class="btn success btn-default m-b" data-dismiss="modal"> OK </button>
                </div>
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
        $("#copy-normal-btn").hide();
        $("#copy-normal-btn").on("click", copyFood);
        $('.type-tab').on('click', function() {
            var type = $(this).data("type");
            foodType = type;

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
                let day_in_week = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];

                let mealPlanData = [];
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
                        let mealDate = new Date($(`.meal-panel.${day}`).data('date')).toLocaleDateString()
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
                    $('#savedModal').modal('show');
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
            var dayPanel = $(event.target).parents('.meal-panel');
            calculateNutrition(dayPanel);
            //cloneFoodItem(foodItem);
            
            if(foodType != 8 && foodType != 22){
                var foodItem = ui.item;
                var foodId = foodItem.children(":first").attr("id");
                checkMealType(foodId, foodType, foodItem);
            }
        }

        function copyFood(event, ui) {
            var activePanel = $(".tab-pane.active");
            var normalPanel = $("#type_8.tab-pane, #type_22.tab-pane");

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
                    var targetType = activePanel.data("type");

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

        function checkMealType(id, type, cloneItem) {
            console.log("checktype", type);
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
                    //console.log(id, type, result)
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
        }

        //calculate nutrition 
        var targetNutrition = JSON.parse('<?php echo json_encode($targetNutrition); ?>')

        initCalculation();
        initTarget();


        function initCalculation() {
            var mealPanel = $('.meal-panel');            
            mealPanel.each(function() {
                if($(this).find(".menu-body.food").length > 0){
                    calculateNutrition($(this));
                }

                var type = $(this).data("type");
                console.log("init cal" + type);
                if(type != 8 && type != 22){
                    var foods = $(this).find(".menu-body").not(".ui-sortable-placeholder");
                    $.each(foods, function() {
                        var foodItem = $(this);
                        var foodId = foodItem.children(":first").attr("id");
                        checkMealType(foodId, type, foodItem);
                    });
                }
            });
            
        }

        function initTarget() {
            var keys = Object.keys(targetNutrition);
            $.each(keys, function() {
                var key = this;
                var target = "." + key + " .target";
                var scale = targetNutrition[key];
                //$(target).text(scale[1] + "-" + scale[2]);
            });
        }

        function calculateNutrition(panel) {
            var sum = {
                'energy':0,
                'protein':0,
                'fat':0,
                "carbohydrate":0,
                "vitamin_a":0,
                "vitamin_b1":0,
                "vitamin_b2":0,
                "vitamin_c":0,
                "iron":0,
                "calcium":0,
                "phosphorus":0,
                "fiber":0,
                "sodium":0,
                "sugar":0,
            }
            
            var allFoodLog = panel.find(".col-food-name");
            allFoodLog.each(function(log) {
                for (var key in sum) {
                    sum[key] += parseFloat($(this).attr("data-"+key));
                }
            });

            for (var key in sum) {
                var dom = panel.find("."+key+" .current");
                dom.text(sum[key].toFixed(0));
                updateNutritionBar(panel, key, sum[key]);
            }
        }

        function updateNutritionBar(parent, key, sum) {
            var scale = targetNutrition[key];
            console.log("update nutirion bar : ", scale);

            if($(parent).find(".menu-body.food").length == 0){
                // console.log("zero");
                if (key == "protein" || key == "fat" || key == "energy"){
                    parent.find("." + key).find(".nut-bar").removeClass("selected");
                }else{
                    var dom = parent.find("." + key).find(".nut-bar");
                    dom.text("พอดี");
                    dom.removeClass("warning");
                    dom.removeClass("ok");
                }
            }else{


                if (key == "protein" || key == "fat" || key == "energy"){
                    var grade = "";
                    parent.find("." + key).find(".nut-bar").removeClass("selected");
                    if( sum < scale["toolow"]){
                        grade = "toolow";
                    }else if(sum < scale["low"]){
                        grade = "low";
                    }else if (sum < scale["ok"]){
                        grade = "ok";
                    }else if(sum < scale["high"]){
                        grade = "high";
                    }else{
                        grade = "toohigh";
                    }
                    if (grade != ""){
                        parent.find("." + key).find(".nut-bar." + grade).addClass("selected");
                    }
                }else{
                    var dom = parent.find("." + key).find(".nut-bar");
                    dom.text("พอดี");
                    dom.removeClass("warning");
                    dom.removeClass("ok");
                    if (sum < scale["low"]){
                        dom.text("น้อย");
                        dom.addClass("warning");
                    }else if(sum < scale["ok"]){
                        dom.text("พอดี");
                        dom.addClass("ok");
                    }else{
                        dom.text("มาก");
                        dom.addClass("warning");
                    }
                }
            }
        }
        $('.in-group-select').on('change', updateFoodResult);
        $('#searchMenu').on('keyup', updateFoodResult);

        function updateFoodResult(){
            // console.log("hello updateFoodResult");
            var filters = [];
            var query = $('#searchMenu').val();
            $.each($('.in-group-select'), function() {
                $.merge(filters, $(this).val())
            });

            console.log("hello updateFoodResult", query, filters);

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
                    filters: filters,
                },
                success: function(data) {
                    console.log("filterFoodList - success")
                    $("#filter-result").html(data);
                }
            });
        }

    </script>
@endsection
