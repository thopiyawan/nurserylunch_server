@extends('layouts.app')
@section('content')

<aside id="aside-menu" class="center">

    <!-- SER|ARCH SECTION  -->
    <div class="m-b">
        <h4 class="">ค้นหาเมนู</h4>       
        <!-- <div class="input-group m-b">
            <span class="input-group-addon">
                <i class="fas fa-search"></i>
            </span> 
            <input type="text" placeholder="ค้นหาเมนู" class="form-control font-light">
        </div>  -->
        <input type="text"  title="ค้นหาเมนู" placeholder="ค้นหาเมนู"  name="searchMenu" id="searchMenu" class="form-control">
    </div>

    <!-- FILTER SECTION  -->
    <div class="m-b">
        <h4 class="">ตัวกรอง</h4>
        @foreach($in_groups as $ig)
            <select id="" class="{{$ig->ingredient_group_eng_name}}-select in-group-select" multiple="multiple" data-style="btn-select-picker">
                @foreach($ig->ingredients()->get() as $in)
                    {{ $in->ingredient_name }}
                    <option value="{{ $in->ingredient_name }}" data-icon="">{{ $in->ingredient_name }}</option>
                @endforeach
            </select>
        @endforeach
    </div>
    
    <div class="m-b">
        <h4 class="">ผลลัพธ์</h4>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ข้าวต้มหมูสับทรงเครื่อง</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>บวบผัดหมูสับ</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>แครอทหอมใหญ่ผัดหมู</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>แกงจืดไก่กะหล่ําปลี</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>เต้าหู้เทริยากิ</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>แกงจืดบ็อคโคลี่หมูสับ</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ผัดผักสามสี</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>แกงจืดซาโยเต้หมูสับ</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ข้าวต้มหมูสับทรงเครื่อง</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ข้าวต้มหมูสับทรงเครื่อง</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ข้าวต้มหมูสับทรงเครื่อง</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ข้าวต้มหมูสับทรงเครื่อง</span>
            </div>
        </div>
        <div class="ui-sortable">
            <div class="menu-body">
                <span>ข้าวต้มหมูสับทรงเครื่อง</span>
            </div>
        </div>
    </div>
</aside>
<div id="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>Mealplan</h1>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    You are logged in!

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



