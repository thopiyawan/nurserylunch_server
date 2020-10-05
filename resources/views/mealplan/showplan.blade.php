@extends('layouts.app')
@section('content')
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
        <div id="meal-plan">
        </div>
    @endsection
