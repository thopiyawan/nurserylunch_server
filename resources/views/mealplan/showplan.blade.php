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

    @section('script')
        <script type="application/javascript">
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

        </script>
    @endsection
