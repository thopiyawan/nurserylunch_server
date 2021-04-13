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
            <div class="col-lg-12 pull-right">
                <a href="#" id="downloadBtn" class="btn btn-primary pull-right" type="" name="" value="">
                    <i class="fas fa-file-download"></i>
                    ดาวน์โหลดรายงาน
                </a>
            </div>
        </div>
        <div id="meal-plan">
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
         }

    </script>
@endsection

