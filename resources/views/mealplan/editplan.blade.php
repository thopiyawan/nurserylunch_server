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
    <h1 class="page-title">แก้ไขเมนูอาหาร</h1>
    <div class="meal-panel row monday">
        <div class="col col-day">
            <div class="mlabel">จันทร์</div>
            <div class="mdate">23</div>
        </div>
        <div class="col col-meal">
            <div class="mlabel">ว่างเช้า</div>
            <div id="ui-sortable" class="ui-sortable">
                <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                    <span class=""><i class="fa fa-hand-pointer-o"></i> วางที่นี่</span>
                </div>
            </div>
        </div>
        <div class="col col-meal">
            <div class="mlabel">กลางวัน</div>
            <div id="ui-sortable" class="ui-sortable">
                <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                    <span class=""><i class="fa fa-hand-pointer-o"></i> วางที่นี่</span>
                </div>
            </div>
        </div>
        <div class="col col-meal">
            <div class="mlabel">ว่างบ่าย</div>
            <div id="ui-sortable" class="ui-sortable">
                <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                    <span class=""><i class="fa fa-hand-pointer-o"></i> วางที่นี่</span>
                </div>
            </div>
        </div>
        <div class="col col-nutrition">
            <div class="mlabel">สารอาหาร</div>
            <div class="energy-contanier">
                <div class="nut-labels">
                    <span class="">พลังงาน</span>
                    <span class="">0 / 400-550 กิโลแคล</span>
                </div>
                <div class="nut-tabs">
                    <div class="nut-tab danger selected">น้อยเกินไป</div>
                    <div class="nut-tab warning selected">น้อย</div>
                    <div class="nut-tab ok selected">พอดี</div>
                    <div class="nut-tab warning selected">มาก</div>
                    <div class="nut-tab danger selected">มากเกินไป</div>
                </div>
                <div class="nut-labels">
                    <span class="">พลังงาน</span>
                    <span class="">0 / 400-550 กิโลแคล</span>
                </div>
                <div class="nut-tabs">
                    <div class="nut-tab danger">น้อยเกินไป</div>
                    <div class="nut-tab warning">น้อย</div>
                    <div class="nut-tab ok">พอดี</div>
                    <div class="nut-tab warning">มาก</div>
                    <div class="nut-tab danger">มากเกินไป</div>
                </div>
                <div class="nut-labels">
                    <span class="">พลังงาน</span>
                    <span class="">0 / 400-550 กิโลแคล</span>
                </div>
                <div class="nut-tabs">
                    <div class="nut-tab danger">น้อยเกินไป</div>
                    <div class="nut-tab warning">น้อย</div>
                    <div class="nut-tab ok">พอดี</div>
                    <div class="nut-tab warning">มาก</div>
                    <div class="nut-tab danger">มากเกินไป</div>
                </div>
            </div>
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

    <div class="form-group">
        <div class="col-lg-8 col-sm-offset-4">
            <button class="btn btn-default" type="">ยกเลิก</button>
            <button class="btn btn-primary" type="submit" name="update" value="school">บันทึกข้อมูล</button>
        </div>
    </div>

</div>
@endsection



