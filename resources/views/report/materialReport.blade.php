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
            <div id="day-count" data-daycount="{{$daysCount}}"></div>
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
    <script type="application/javascript">
        $('#downloadBtn').click(generateDomPdf);
        function generateDomPdf(){
            var data = gatherData();
            console.log(data);
            $.ajax({
                type: "POST",
                url: "/report/materialpdf",
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    console.log("success");
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Sample.pdf";
                    link.click();
                }
            });
        }
        function gatherData(){
            var materials = [];
            var logsReports = [];
            $.each($(".material-row"), function(){
                var row = $(this);
                var material = {
                    'count': row.find(".material-count").first().text(),
                    'name': row.find(".material-name").first().text(),
                    'quantity': row.find(".material-quantity").first().text(),
                };
                materials.push(material);
            });
            $.each($(".log-report"), function(){
                var report = $(this);
                var reportData = [];
                $.each(report.find(".log-row"), function(){
                    var row = $(this);
                    var log = {
                        'date' : row.find(".report-date").first().text(),
                        'meal' : row.find(".log-meal").first().text(),
                        'age' : row.find(".log-age").first().text(),
                        'food-type' : row.find(".log-food-type").first().text(),
                        'food-name' : row.find(".log-food-name").first().text(),
                        'serving' : row.find(".log-serving").first().text(),
                    };
                    reportData.push(log);
                });
                var returnData = {
                    date : report.find('.log-date').first().text(),
                    dateth : report.find('.log-date-th').first().text(),
                    data : reportData,
                }
                logsReports.push(returnData);
            });

            var data = {
                kelly: "kelly",
                startDate: startLogDate.toLocaleDateString(),
                endDate: endLogDate.toLocaleDateString(), 
                materials: materials,
                logsReports: logsReports,
            }
            return data;
        }

    </script>
@endsection