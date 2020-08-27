@extends('layouts.app')
@section('content')

<aside id="aside-menu" class="">

    <!-- SER|ARCH SECTION  -->
    <div class="m-b center">
        <h4 class="">แสดงเมนูอาหารของสัปดาห์</h4>
        <!-- <button class="btn btn-block btn-default m-b" type="" name="" value="">สัปดาห์นี้</button> -->
        <div id="week-picker"></div>
            <!-- <br /><br />
            <label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span> -->
        </body>
    </div>

    <!-- FILTER SECTION  -->
    <div class="m-b">
        <h4 class="center"> สำหรับเด็กอายุ</h4>
        <ul class="nav nav-tab main-level" id="">
            <li class="">
                <a  href="#" class="" id="" aria-expanded="false" >
                    <span class="">ต่ำกว่า 1 ปี (ปกติ)</span>
                </a>
            </li>
            <li class="">
                <a  href="#" class="" id="" aria-expanded="false" >
                    <span class="">ต่ำกว่า 1 ปี (มุสลิม)</span>
                </a>
            </li>
            <li class="">
                <a  href="#" class="" id="" aria-expanded="false" >
                    <span class="">ต่ำกว่า 1 ปี (แพ้กุ้ง) </span>
                </a>
            </li>
            <li class="">
                <a  href="#" class="" id="" aria-expanded="false" >
                    <span class="">1 - 3 ปี (ปกติ)</span>
                </a>
            </li>
            <li class="">
                <a  href="#" class="" id="" aria-expanded="false" >
                    <span class="">1 - 3 ปี (มุสลิม)</span>
                </a>
            </li>
            <li class="">
                <a  href="#" class="" id="" aria-expanded="false" >
                    <span class="">1 - 3 ปี (แพ้กุ้ง) </span>
                </a>
            </li>
        </ul>
    </div>
    
</aside>
<div id="wrapper">
    
    <h1 class="page-title">
        <span>เมนูอาหาร</span>
        <span id="startDate"></span>
        <span> - </span>
        <span id="endDate"></span>
    </h1>

    <div class="row">
        <div class="col-lg-2">
            <span>สำหรับเด็กอายุ - 3 ปี</span> 
        </div>
        <div class="col-lg-2">
            <span> อาหารปกติ</span> 
        </div>
        <div class="col-lg-8">
            <a href="/mealplan/edit" class="btn btn-primary pull-right" type="" name="" value="">แก้ไขรายการอาหาร</a>
        </div>
    </div>
    <div class="meal-panel row monday">
        <div class="col col-day">
            <div class="mlabel">จันทร์</div>
            <div class="mdate">23</div>
        </div>
        <div class="col col-meal">
            <div class="mlabel">ว่างเช้า</div>
        </div>
        <div class="col col-meal">
            <div class="mlabel">กลางวัน</div>
        </div>
        <div class="col col-meal">
            <div class="mlabel">ว่างบ่าย</div>
        </div>
    </div>
    <div class="meal-panel row tuesday">
        <div class="col col-day">
            <div class="mlabel">อังคาร</div>
            <div class="mdate">24</div>
        </div>
    </div>
    <div class="meal-panel row wednesday">
        <div class="col col-day">
            <div class="mlabel">พุธ</div>
            <div class="mdate">25</div>
        </div>
    </div>
    <div class="meal-panel row thursday">
        <div class="col col-day">
            <div class="mlabel">พฤหัส</div>
            <div class="mdate">26</div>
        </div>
    </div>
    <div class="meal-panel row friday">
        <div class="col col-day">
            <div class="mlabel">ศุกร์</div>
            <div class="mdate">27</div>
        </div>
    </div>
</div>
@endsection



