@extends('layouts.app')
@section('content')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<div class="sidebar-scroll">
    <aside id="aside-menu">
        @include('mealplan.showsidemenu')
    </aside>
</div>
<div id="wrapper">
    <div id="pdfwrapper">
        <div class="row m-b">
            <!-- <div class="col-lg-8">
                <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
            </div> -->
            <div class="col-lg-12 pull-right">
                <a href="#" id="downloadBtn" class="btn btn-primary pull-right" type="" name="" value="">
                    <i class="fas fa-file-download"></i>
                    ดาวน์โหลดรายงาน
                </a>
            </div>
        </div>
       <div id="meal-plan"></div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ asset('js/getfoodlogs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection