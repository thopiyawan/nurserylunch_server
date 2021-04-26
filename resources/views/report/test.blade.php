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
        * {
          box-sizing: border-box;
        }

        body{
            color: #343a40;
            font-family: "THSarabunNew";
            font-size: 22px;
            font-weight: normal;
            text-align: left;
            margin-top: -20px;
            line-height: 22px;
        }
        span{
            font-family: "THSarabunNew";
        }
        h1.page-title{font-size: 26px;}
        h2{font-size: 24px;}
        div{display: block;}

        .nut-bar{
            background: #d0d0d0;
            border-radius: 10px;
            color: white !important;
            display: inline-block;
            font-size: 18px;
            height: 20px;
            line-height: 14px;
            margin-right: -0.5%;
            padding-top: -20px;
            text-align: center;
            width: 19.0%;
        }
        .nut-bar.danger.selected{background: #c0392b;}
        .nut-bar.warning.selected{background: #f7931e;}
        .nut-bar.ok.selected{background: #7ac943;}
        .row {
            
            margin-right: -15px;
            margin-left: -15px;
        }
        .col{
            
            padding-right: 15px;
            padding-left: 15px;
        }
        .col-lg-1{flex: 8%; width: 8%;}
        .col-lg-2 {flex: 16%; width:16%;}
        .col-lg-3{flex: 24%; width: 24%;}
        .col-lg-4{flex: 32%; width: 32%;}
        .col-lg-5{flex: 40%; width: 40%;}
        .col-lg-6{flex: 48%; width: 48%;}
        .col-lg-7{flex: 56%; width: 56%;}
        .col-lg-8{flex: 64%; width: 64%;}
        .col-lg-9{flex: 72%; width: 72%;}
        .col-lg-10{flex: 80%; width: 80%;}
        .col-lg-11{flex: 88%; width: 88%;}
        .col-lg-12{flex: 96%; width: 96%;}
        .page_break { page-break-after: always; }
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
    </style>
</head>

<body>
    @foreach ($reports as $report)
        <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
        <div class="row">
            <div class="col col-lg-5">
                <div class="row">
                    <div class="">
                        <i class="fas fa-calendar-alt color-gray"></i>
                        <span>{{$startDate}}</span>
                        <span>-</span>
                        <span>{{$endDate}}</span>
                    </div>
                    
                    <div class="">
                        <div>
                            <span><i class="fas fa-user-friends color-gray"></i></span>
                            <span> เด็กอายุ</span>
                            <span class="age-range-span"> {{$report['age-range-span']}}</span>
                        </div>
                    </div>
                    <div class="m-b">
                        <div>
                            <span><i class="fas fa-utensils color-gray"></i></span>
                            <span id="food-type-span" class="food-type "> {{$report['food-type-span']}}</span>
                        </div>
                    </div>
                </div>
                <h2>สัดส่วนสารอาหารหลักที่ได้รับรายสัปดาห์</h2>
                <div class="section">
                    <div class="row">
                        <div class="col col-lg-7 pull-left">
                            <canvas class="doughnutChart"  width="210" height="210"></canvas>
                        </div>
                        <div class="col col-lg-5 nutrition-legend">
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
                    </div>
                </div>
                <div id="nutrition-report"></div>
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
                @foreach ($selectedDates as $date)
                    <div class="meal-panel  {{$date['engDay']}}">
                        <div class="row m-b">
                            <div class="col col-lg-12">
                                <span>{{$date['thDay']}}</span>
                                <span id="{{$date['engDay']}}Date" data-date="{{$date['date']}}" class="report-date"></span>
                            </div>
                        </div>
                    </div>
                    @foreach ($school->setting->getMealsettings() as $meal)
                        @if ($meal[2] == 1)
                        <div class="row m-b">
                            <div class="col col-lg-2">{{$meal[1]}}</div>
                            <div class="col col-lg-10">
                                @foreach ($logs as $log)
                                    @if ($log->meal_code == $meal[0] && $log->meal_date == $date['date'] && $log->food_type == $report['id'])
                                        <div class=""> 
                                            @if($log->food_type != 8 && $log->food_type != 22)
                                                <span class="text-highlight">({{$log->setting_description_thai}})</span>
                                            @endif
                                            <span class="readable-font">{{ $log->food_thai }} </span>
                                            <span class="readable-font"> </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="page_break"></div>
    @endforeach 
</body>

</html>