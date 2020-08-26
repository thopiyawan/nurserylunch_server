@extends('layouts.app')
@section('content')

<aside id="aside-menu" class="">

    <!-- SER|ARCH SECTION  -->
    <div class="m-b center">
        <h4 class="">แสดงเมนูอาหารของสัปดาห์</h4>
        <!-- <button class="btn btn-block btn-default m-b" type="" name="" value="">สัปดาห์นี้</button> -->
        <div class="week-picker"></div>
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
    
    <h1 class="page-title"> เมนูอาหาร <span>19 - 24 มิ.ย. 63</span> </h1>
    
    <span>เด็กอายุ 1 ปี - 3 ปี</span>

    <div class="card">
        <div class="card-header">D</div>

        <div class="card-body">
            You are logged in!

        </div>
    </div>
</div>
@endsection



