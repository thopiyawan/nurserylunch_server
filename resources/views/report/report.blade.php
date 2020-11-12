@extends('layouts.app')
@section('content')
<aside id="aside-menu">
    @include('mealplan.showsidemenu')
</aside>
<div id="wrapper">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
        </div>
        <div class="col-lg-4 pull-right">
             <a href="#" class="btn btn-primary pull-right" type="" name="" value="">
                <i class="fas fa-file-download"></i>
                ดาวน์โหลดรายงาน
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="m-b">
                <i class="fas fa-calendar-alt color-gray"></i>
                <span id="startDate"></span>
                <span id="startDate"></span>
                <span> - </span>
                <span id="endDate"></span>
            </div>
            <div class="m-b">
                <span><i class="fas fa-user-friends color-gray"></i></span>
                <span> เด็กอายุต่ำกว่า 1 ปี </span>
            </div>
            
        </div>
        <div class="col-lg-7">
            @include('report.mealdate')
            
        </div>
    </div>
</div>
@endsection

