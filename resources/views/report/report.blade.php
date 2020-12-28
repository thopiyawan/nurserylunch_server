
@extends('layouts.app')
@section('content')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<aside id="aside-menu">
    @include('mealplan.showsidemenu')
</aside>
<div id="wrapper">
    <div id="pdfwrapper">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
            </div>
            <div class="col-lg-4 pull-right">
              <!--   <form method="POST" action="/downloadreport" class="">   
                    @csrf 
                    <div class="form-group">
                        <input type="hidden" id="startDateInput" name="startDate" value="">
                        <input type="hidden" id="endDateInput" name="endDate" value="">
                        <input type="hidden" id="foodTypeInput" name="foodType" value="">
                    </div>                
                    <button id="downloadBtn" class="btn btn-primary pull-right" type="submit" name="" value="">
                        <i class="fas fa-file-download"></i>
                        ดาวน์โหลดรายงาน
                    </button>
                </form> -->
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
</div>
@endsection
@section('script')
    <script src="{{ asset('js/getfoodlogs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="application/javascript">
        // console.log("before js");
        $('#downloadBtn').click(downloadReport_jspdf);
        
        function downloadReport(){
            $.ajax({
                type: "POST",
                url: "/downloadreport",
                data: {
                    date: {
                        startDate: startDate.toLocaleDateString(),
                        endDate: endDate.toLocaleDateString(), 
                    }, 
                    foodType: foodType,
                },
                xhrFields: {
                    responseType: 'blob' // to avoid binary data being mangled on charset conversion
                },
                success: function(data) {
                    console.log("success");
                }
            });

        }

        function downloadReport_jspdf(){
            $('#downloadBtn').hide();
        
            domtoimage.toPng(document.getElementById('pdfwrapper'), {
                 width: $('#pdfwrapper').width(), 
                 height: $('#pdfwrapper').height(),
                 style:{background: 'white'},
            }).then(function (blob) {
                //window.saveAs(blob, 'my-node.png');
                var pdf = new jsPDF('p', 'mm', "a4");
                // var width = pdf.internal.pageSize.getWidth();
                // var height = pdf.internal.pageSize.getHeight();

                pdf.addImage(blob, 'PNG', 10, 10, 190, 287);
                pdf.save("test.pdf");

                // that.options.api.optionsChanged();
                $('#downloadBtn').show();
            });


            // var pdf = new jsPDF();
            // pdf.addHTML($('#wrapper')[0], function () {
            //     pdf.save('รายงานเมนูรายการอาหาร.pdf');
            // });

            // html2canvas($("#wrapper"), {
            //     onrendered: function (canvas) {
            //         theCanvas = canvas;
                    
            //         document.body.appendChild(canvas);

            //         canvas.toBlob(function (blob) {
            //             saveAs(blob, "Dashboard.png");
            //         });
            //     }
            // });     
            


            // html2canvas($("#wrapper"), {
            //     onrendered: function(canvas) {         
            //         var imgData = canvas.toDataURL('image/png');              
            //         var doc = new jsPDF('p', 'pt', 'letter');
            //         doc.addImage(imgData, 'PNG', 10, 10);
            //         doc.save('sample-file.pdf');
            //     }
            // });

            // var doc = document.getElementById("wrapper");
            // doc.print();
         }

    </script>
@endsection

