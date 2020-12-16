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
                จัดการรายการอาหาร
            </a>
        </div>
    </div>

    <div class="">
        <div id="meal-plan">
        </div>
    </div>
</div>
<script src="{{ asset('js/getfoodlogs.js') }}"></script>
<script type="application/javascript">

</script>
        
@endsection
