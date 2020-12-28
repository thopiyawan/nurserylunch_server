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
             <a href="#" id="downloadBtn" class="btn btn-primary pull-right" type="" name="" value="">
                <i class="fas fa-file-download"></i>
                ดาวน์โหลดรายงาน
            </a>
        </div>
    </div>

    <div class="row nutrition-report">
        <div class="col-lg-5">
            <div class="m-b">
                <i class="fas fa-calendar-alt color-gray"></i>
                <span id="startDate"></span>
                <span id="startDate"></span>
                <span> - </span>
                <span id="endDate"></span>
            </div>
            <div class="m-b">
                <div>
                    <span><i class="fas fa-user-friends color-gray"></i></span>
                    <span> เด็กอายุ</span>
                    <span id="age-range-span"> ต่ำกว่า 1 ปี</span>
                </div>
            </div>
            <div class="section">
                <h2>สัดส่วนสารอาหารหลักที่ได้รับรายสัปดาห์</h2>
            </div>
            <div class="section m-b">
                <div class="row">
                    <div class="col-lg-7 pull-left">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                    <div class="col-lg-5 nutrition-legend">
                        <div>
                            <span class="nutrition-label protein"></span>
                            <span id="protein-label">50</span>
                            <span>% โปรตีน</span>
                        </div>
                        <div>
                            <span class="nutrition-label fat"></span>
                            <span id="fat-label">50</span>
                            <span>% ไขมัน</span>
                        </div>
                        <div>
                            <span class="nutrition-label carb"></span>
                            <span id="carb-label">50</span>
                            <span>% คาร์โบไฮเดรต</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="nutrition-report"></div>
            <div class="">
                <div class="col col-nutrition">  
                    <div class="energy">
                        <div class="nut-labels row">
                            <div class="col col-lg-3">พลังงาน</div>
                        </div>
                        <div class="nut-bars">
                            <div class="nut-bar toolow danger">น้อยเกิน</div>
                            <div class="nut-bar low warning">น้อย</div>
                            <div class="nut-bar ok">พอดี</div>
                            <div class="nut-bar high warning">มาก</div>
                            <div class="nut-bar toohigh danger">มากเกิน</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col col-nutrition">  
                    <div class="protein">
                        <div class="nut-labels row">
                            <div class="col col-lg-3">โปรตีน</div>
                        </div>
                        <div class="nut-bars">
                            <div class="nut-bar toolow danger">น้อยเกิน</div>
                            <div class="nut-bar low warning">น้อย</div>
                            <div class="nut-bar ok">พอดี</div>
                            <div class="nut-bar high warning">มาก</div>
                            <div class="nut-bar toohigh danger">มากเกิน</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col col-nutrition">  
                    <div class="fat">
                        <div class="nut-labels row">
                            <div class="col col-lg-3">ไขมัน</div>
                        </div>
                        <div class="nut-bars">
                            <div class="nut-bar toolow danger">น้อยเกิน</div>
                            <div class="nut-bar low warning">น้อย</div>
                            <div class="nut-bar ok">พอดี</div>
                            <div class="nut-bar high warning">มาก</div>
                            <div class="nut-bar toohigh danger">มากเกิน</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col col-nutrition">  
                    <div class="carbohydrate">
                        <div class="nut-labels row">
                            <div class="col col-lg-3">คาร์โบไฮเดรต</div>
                        </div>
                        <div class="nut-bars">
                            <div class="nut-bar toolow danger">น้อยเกิน</div>
                            <div class="nut-bar low warning">น้อย</div>
                            <div class="nut-bar ok">พอดี</div>
                            <div class="nut-bar high warning">มาก</div>
                            <div class="nut-bar toohigh danger">มากเกิน</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div id="meal-plan">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/getfoodlogs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="application/javascript">       
        console.log("before js");
        var pdf = new jsPDF();
        $('#downloadBtn').click(downloadReport);
        // $('.age-tab').click(updateNutritionReport);

        function downloadReport(){
            pdf.addHTML($('#wrapper')[0], function () {
                pdf.save('Test.pdf');
            });
        }

        // var doughnutData = {
        //     labels: ["คาร์โบไฮเดรต","โปรตีน","ไขมัน"],
        //     datasets: [{
        //         data: [20, 120, 100],
        //         backgroundColor: ["#f7931e","#7ac943","#3fa6f2"],
        //         hoverBackgroundColor: ["#de7c0a","#5fb922","#1c89da"]
        //     }]
        // }
        // var doughnutOptions = {responsive: true};
        // var ctx = document.getElementById("doughnutChart").getContext("2d");
        // new Chart(ctx, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

    </script>
@endsection

