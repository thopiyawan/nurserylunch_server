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
        .fa3 {
          display: inline-block;
          font: normal normal normal 14px/1 fontawesome3;
          text-rendering: auto;

          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
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
        h2{font-size: 21px;}
        .fa{
            font-family: 'FontAwesome', sans-serif;
            color: #909090;
        }
        .fas {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }
   /*     .fa, .fas {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1;
            color: #909090;
        }*/
    /*    .fa-calendar-alt:before {
            content: "\F073";
        }
        .fa-user-friends:before {
            content: "\F500";
        }*/
        .nut-bar{
            background: #d0d0d0;
            border-radius: 10px;
            color: white !important;
            display: inline-block;
            font-size: 15px;
            height: 20px;
            line-height: 14px;
            margin-right: -0.5%;
            padding-top: -20px;
            text-align: center;
            width: 19.0%;
        }
        .nut-bars{
            margin-top: -10px;
        }
        .nut-bar.danger.selected{background: #c0392b;}
        .nut-bar.warning.selected{background: #f7931e;}
        .nut-bar.ok.selected{background: #7ac943;}
        .row {
            width: 100%;
            /*margin-right: -12px;
            margin-left: -12px;*/
        }
        .col{
            display: inline-block;
            vertical-align: top;
            padding: 0px;
            margin: 0px; 
        }
        .col-lg-1{width: 8.2%;}
        .col-lg-2{width:16.4%;}
        .col-lg-3{width: 24.6%;}
        .col-lg-4{width: 32.8%;}
        .col-lg-5{width: 41%;}
        .col-lg-6{width: 49.2%;}
        .col-lg-7{width: 57.4%;}
        .col-lg-8{width: 65.6%;}
        .col-lg-9{width: 73.8%;}
        .col-lg-10{width: 82%;}
        .col-lg-11{width: 90.2%;}
        .col-lg-12{width: 98.4%;}
        .page-break { page-break-after: always; }
        .nutrition-label{
            height:  16px;
            width: 16px;
            border-radius: 8px;
            display: inline-block;
            background-color: #ccc;
        }
        .nutrition-label.none{background: #ddd !important}
        .nutrition-label.protein{background: #f7931e}
        .nutrition-label.fat{background: #7ac943}
        .nutrition-label.carb{background: #3fa6f2}
        .meal-panel{
            background: white;
            border: 1px solid #dee2e6;  
            padding: 3px 12px 12px 12px;
            line-height: 17px;
            margin: 0px 0px 7px 40px;             
        }
        .meal-panel span{
            padding-top: 20px;
        }
        /*.meal-panel .row{margin-top: -6px;}*/
        .meal-panel.monday{border-left: 5px solid #f9dc06;}
        .meal-panel.tuesday{border-left: 5px solid #ff6663;}
        .meal-panel.wednesday{border-left: 5px solid #7ac943;}
        .meal-panel.thursday{border-left: 5px solid #f7931e;}
        .meal-panel.friday{border-left: 5px solid #3fa6f2;}
        .meal-panel.saturday{border-left: 5px solid #a880ce;}
        .meal-panel.sunday{border-left: 5px solid #e44f4f;}
        .text-highlight{color: #EE5A24;}
    </style>
</head>

<body>
    @php $count = count($reports) @endphp
    @foreach ($reports as $report)
        <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
        <div class="row">
            <div class="col col-lg-5">
                <div>
                     <div class="">
                        <span class="fa">&#xf073;</span>
                        <span class="fa fa-calendar-alt"></span>
                        <span>{{$startDate}}</span>
                        <span>-</span>
                        <span>{{$endDate}}</span>
                    </div>
                    <div class="">
                        <div>
                            <span class="fa">&#xf007;</span>
                            <span><i class="fas fa-user-friends"></i></span>
                            <span> เด็กอายุ</span>
                            <span class="age-range-span"> {{$report['age-range-span']}}</span>
                        </div>
                    </div>
                    <div class="m-b">
                        <div>
                            <!-- <span class="fa">&#xf2e7;</span> -->
                            <span>อาหาร</span>
                            <span id="food-type-span" class="food-type "> {{$report['food-type-span']}}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>สัดส่วนสารอาหารหลักที่ได้รับรายสัปดาห์</h2>
                    <div class="">
                        <div class="nutrition-legend">
                            <div>
                                <span class="nutrition-label protein"></span>
                                <span class="nutrition-span protein">{{$report['nutrition-span-protein']}}</span>
                                <span>% โปรตีน</span>
                            </div>
                            <div>
                                <span class="nutrition-label fat"></span>
                                <span class="nutrition-span fat">{{$report['nutrition-span-fat']}}</span>
                                <span>% ไขมัน</span>
                            </div>
                            <div>
                                <span class="nutrition-label carb"></span>
                                <span class="nutrition-span carbohydrate">{{$report['nutrition-span-carbohydrate']}}</span>
                                <span>% คาร์โบไฮเดรต</span>
                            </div>
                        </div>
                        <div class="">
                            <canvas class="doughnutChart"  width="210" height="210"></canvas>
                        </div>
                    </div>
                </div>
                <div class="energy">
                    <div class="">พลังงาน</div>
                    <div class="nut-bars">
                        <div class="nut-bar toolow danger {{$report['energy-selected']=='toolow'?'selected':''}}">น้อยเกิน</div>
                        <div class="nut-bar low warning {{$report['energy-selected']=='low'?'selected':''}}">น้อย</div>
                        <div class="nut-bar ok {{$report['energy-selected']=='ok'?'selected':''}}">พอดี</div>
                        <div class="nut-bar high warning {{$report['energy-selected']=='high'?'selected':''}}">มาก</div>
                        <div class="nut-bar toohigh danger {{$report['energy-selected']=='toohigh'?'selected':''}}">มากเกิน</div>
                    </div>
                </div>
                <div class="protein">
                    <div class="">โปรตีน</div>
                    <div class="nut-bars">
                        <div class="nut-bar toolow danger {{$report['protein-selected']=='toolow'?'selected':''}}">น้อยเกิน</div>
                        <div class="nut-bar low warning {{$report['protein-selected']=='low'?'selected':''}}">น้อย</div>
                        <div class="nut-bar ok {{$report['protein-selected']=='ok'?'selected':''}}">พอดี</div>
                        <div class="nut-bar high warning {{$report['protein-selected']=='high'?'selected':''}}">มาก</div>
                        <div class="nut-bar toohigh danger {{$report['protein-selected']=='toohigh'?'selected':''}}">มากเกิน</div>
                    </div>
                </div>
                <div class="fat">
                    <div class="">ไขมัน</div>
                    <div class="nut-bars">
                        <div class="nut-bar toolow danger {{$report['fat-selected']=='toolow'?'selected':''}}">น้อยเกิน</div>
                        <div class="nut-bar low warning {{$report['fat-selected']=='low'?'selected':''}}">น้อย</div>
                        <div class="nut-bar ok {{$report['fat-selected']=='ok'?'selected':''}}">พอดี</div>
                        <div class="nut-bar high warning {{$report['fat-selected']=='high'?'selected':''}}">มาก</div>
                        <div class="nut-bar toohigh danger {{$report['fat-selected']=='toohigh'?'selected':''}}">มากเกิน</div>
                    </div>
                </div>
                <div class="carbohydrate">
                    <div class="">คาร์โบไฮเดรต</div>    
                    <div class="nut-bars">
                        <div class="nut-bar toolow danger {{$report['carbohydrate-selected']=='toolow'?'selected':''}}">น้อยเกิน</div>
                        <div class="nut-bar low warning {{$report['carbohydrate-selected']=='low'?'selected':''}}">น้อย</div>
                        <div class="nut-bar ok {{$report['carbohydrate-selected']=='ok'?'selected':''}}">พอดี</div>
                        <div class="nut-bar high warning {{$report['carbohydrate-selected']=='high'?'selected':''}}">มาก</div>
                        <div class="nut-bar toohigh danger {{$report['carbohydrate-selected']=='toohigh'?'selected':''}}">มากเกิน</div>
                    </div>
                </div>
            </div>

            <div class="col col-lg-7">
                <div>
                @foreach ($selectedDates as $date)
                    <div class="meal-panel {{$date['engDay']}}">
                        <div class="row">
                            <div class="col col-lg-12">
                                <span>{{$date['thDay']}}</span>
                                <span id="{{$date['engDay']}}Date" data-date="{{$date['date']}}" class="report-date">
                                    {{$date['dateText']}}
                                </span>
                            </div>
                        </div>
                        @foreach ($school->setting->getMealsettings() as $meal)
                            @if ($meal[2] == 1)
                            <div class="row">
                                <div class="col col-lg-2"><span>{{$meal[1]}}</span></div>
                                <div class="col col-lg-9">
                                    @foreach ($logs as $log)
                                        @if ($log->meal_code == $meal[0] && $log->meal_date == $date['date'] && $log->food_type == $report['id'])
                                        <div>
                                           @if($log->food_type != 8 && $log->food_type != 22)
                                                <span class="text-highlight">({{$log->setting_description_thai}})</span>
                                            @endif 
                                                <span>{{ $log->food_thai }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        @php $count -= 1 @endphp
        @if($count > 0)
            <div class="page-break"></div>    
        @endif
    @endforeach 

</body></html>