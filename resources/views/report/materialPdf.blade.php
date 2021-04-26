<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    
    <style type="text/css">
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
          font-family: 'fontawesome3';
          src: url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/fonts/fontawesome-webfont.ttf?v=4.6.1') format('truetype');
          font-weight: normal;
          font-style: normal;
        }
        @page { margin: 20px 40px 20px 40px; }
      
        body{
            color: #343a40;
            font-family: "THSarabunNew";
            font-size: 20px;
            font-weight: normal;
            text-align: left;
            line-height: 22px;
        }
        span{
            font-family: "THSarabunNew";
        }
        h1.page-title{
            font-size: 26px; 
            margin: 0px; 
            margin-bottom: 20px; 
            padding: 0px;
        }
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th{
            text-align: left;
        }
        .table th, .table td {
            padding: 2px 6px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            border-bottom: 0;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .fa{
            font-family: 'FontAwesome', sans-serif;
            color: #909090;
        }
        .page-break { page-break-after: always; }

    </style>
</head>

<body>
    <div id="material-section">
        <h1 class="page-title">รายงานวัตถุดิบซื้อ (ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส) </span></h1>
        <div class="">
            <span class="fa">&#xf073;</span>
             <span>สำหรับเมนูอาหาร วันที่</span>
            <span>{{$startDate}}</span>
            <span>-</span>
            <span>{{$endDate}}</span>
        </div>
        <div>
            <table style="width:100%" class="table table-striped">
              <thead>
                <tr>
                  <th>ลำดับที่</th>
                  <th>รายการ</th>
                  <th>จำนวน</th>
                  <th>หมายเหตุ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($materials as $material)
                  <tr>
                    <td>{{$material['count']}}</td>
                    <td>{{$material['name']}}</td>
                    <td>{{$material['quantity']}}</td>
                    <td></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
    <div class="page-break"></div> 
    @php $count = count($logsReports) @endphp  
    @foreach($logsReports as $report)
        <div id="log-section">
            <h1 class="page-title">รายการอาหาร (ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส) </span></h1>
        </div>
        <div class="">
            <span class="fa">&#xf073;</span>
             <span>สำหรับเมนูอาหาร วันที่</span>
            <span>{{$report['date']}}</span>
            <span>{{$report['dateth']}}</span>
        </div>
        <div>
            <table style="width:100%" class="table table-striped">
                <thead>
                  <tr>
                    <th>วันที่</th>
                    <th>มื้อ</th>
                    <th>อายุ</th>
                    <th>ประเภทอาหาร</th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($report['data'] as $log)
                      <tr>
                        <td>{{$log['date']}}</td>
                        <td>{{$log['meal']}}</td>
                        <td>{{$log['age']}}</td>
                        <td>{{$log['food-type']}}</td>
                        <td>{{$log['food-name']}}</td>
                        <td>{{$log['serving']}}</td>
                      </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        @php $count -= 1 @endphp
        @if($count > 0)
            <div class="page-break"></div>    
        @endif
    @endforeach

</body></html>