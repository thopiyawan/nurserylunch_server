@extends('layouts.app')
@section('content')
<div class="sidebar-scroll">
    <aside id="aside-menu" class="">
        <!-- SER|ARCH SECTION  -->
        @include('mealplan.showsidemenu')

    </aside>
</div>
@php $hasAge = $school->isForSmall() || $school->isForBig() @endphp
<div id="wrapper" class="meal-plan">
    <div class="row fixed-info-box">
        <div class="col">
            <h1 class="page-title"> รายการอาหาร</h1>
        </div>
        <div class="col heading-p-t">
            <div id="day-count" data-daycount="{{$daysCount}}"></div>
            <div>
                <i class="fas fa-calendar-alt color-gray"></i>
                <span id="startDate"></span>
                <span> - </span>
                <span id="endDate"></span>
            </div>
        </div>
        <div class="col heading-p-t">
            <div>
                <span><i class="fas fa-user-friends color-gray"></i></span>
                <span> เด็กอายุ</span>
                <span id="age-range-span"></span>
            </div>
        </div>
        <div class="col heading-p-t">
  
        </div>

        <div class="col-lg-3 pull-right">
            @if ($hasAge == 1)
                 <a href="/mealplan/edit" class="btn btn-primary pull-right" type="" name="" value="">
                    <i class="fas fa-edit"></i>
                    จัดการรายการอาหาร 
                </a>
            @else
                
            @endif
        </div>
    </div>

    <div class="">
        @if ($hasAge == 1)
            <div id="meal-plan"></div>
        @else
            <div class="text-center">กรุณาเลือกช่วงอายุเด็กสำหรับจัอาหาร</div>
        @endif
    </div>
</div>
<script src="{{ asset('js/getfoodlogs.js') }}"></script>
<script type="application/javascript">

</script>
        
@endsection
