@extends('layouts.app')
@section('content')
<aside id="aside-menu" class="">
    <!-- SER|ARCH SECTION  -->
    @include('mealplan.showsidemenu')

</aside>
<div id="wrapper" class="meal-plan">
    <div class="row fixed-info-box">
        <div class="col">
            <h1 class="page-title"> รายการอาหาร </h1>
        </div>
        <div class="col heading-p-t">
            <div>
                <i class="fas fa-calendar-alt color-gray"></i>
                <span id="startDate"></span>
                <span id="startDate"></span>
                <span> - </span>
                <span id="endDate"></span>
            </div>
        </div>
        <div class="col heading-p-t">
            <div>
                <span><i class="fas fa-user-friends color-gray"></i></span>
                <span> เด็กอายุ</span>
                <span id="age-range-span"> ต่ำกว่า 1 ปี</span>
            </div>
        </div>
        <div class="col heading-p-t">
            <!-- <span><i class="fas fa-utensils color-gray"></i></span>
            <span id="food-type-span" class="food-type normal"> อาหารปกติ </span>
 -->
          
        </div>

        <div class="col-lg-3 pull-right">
             <a href="/mealplan/edit" class="btn btn-primary pull-right" type="" name="" value="">
                <i class="fas fa-edit"></i>
                แก้ไขรายการอาหาร
            </a>
        </div>
    </div>

    <div class="">
        <div id="meal-plan">
        <!-- <div class="hpanel plan-panel">
            <ul class="nav nav-tab">
                <li class="">
                    <a data-toggle="tab" href="#tab-1" aria-expanded="true" class="type-tab active">ต่ำกว่า 1 ปี (ปกติ)</a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#tab-2" aria-expanded="false" class="type-tab">ต่ำกว่า 1 ปี (มุสลิม)</a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#tab-3" aria-expanded="false" class="type-tab">ต่ำกว่า 1 ปี (แพ้กุ้ง)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="">
                        <div id="meal-plan">
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <strong>ต่ำกว่า 1 ปี (มุสลิม)</strong>
                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, the breath </p>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <strong>ต่ำกว่า 1 ปี (แพ้กุ้ง)</strong>
                        <p>Thousand plants are noticed by me: when I hear the buzz of the little world among </p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<script src="{{ asset('js/getfoodlogs.js') }}"></script>
<script type="application/javascript">

    // $('.age-tab').on('click', function(){
    //    var age = $(this).data("age");
    //    var text = age == "is_for_small" ? "ต่ำกว่า 1 ปี":"1-3 ปี";
    //    $("#age-range-span").text(text);
    
    // });


    // $('.type-tab').on('click', function(){
    //    var type = "";
    //    var target = $("#food-type-span");
    //    var detail = $(this).data("detail");
    //    var start = detail.indexOf("(");
    //    var end = detail.indexOf(")");
    //    var text = detail.substring(start+1, end);

    //    $("#food-type-span").text("อาหาร"+text);

    //    if(text == "ปกติ"){
    //         target.removeClass("special");
    //         target.addClass("normal");
    //         $("#copy-normal-btn").hide();
    //    }else{
    //         target.removeClass("normal");
    //         target.addClass("special");
    //         $("#copy-normal-btn").show();
    //    }
    // });

</script>
        
@endsection
