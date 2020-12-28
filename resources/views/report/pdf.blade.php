<html>
<header>
<title>pdf</title>
<meta http-equiv="Content-Language" content="th" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
<!-- <link href="http://localhost:8000/css/custom.css" rel="stylesheet"> -->



<!-- @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap'); -->
<style>
:root{
    /*COLOR*/
    --darkgray: #61696f;
    --primary : #EE5A24;
    /*--primary-fade : #f76d3a;*/
    --primary-bg : #fbebe5;
    --primary-fade : #f97b4d;
    --gray : #909090;
    --lightgray : #dee2e6;
    --lightgray-fade : #eaeaea;

    /*FONT SIZE*/
    --font-size-m2: 0.8rem;
    --font-size-m1: 0.9rem;
    --font-size-p1: 1.1rem;
    --font-size-p2: 1.2rem;
    --font-size-p3: 1.3rem;
    --font-size-p4: 1.4rem;
}
body{
    color: #61696f;
    font-family: 'sarabun', sans-serif;
    font-size: var(--font-size-base);
    font-weight: 200;
    text-align: justify;
}
h1{ font-size: 1.5rem}
h2{ font-size: 1.4rem}
h1.page-title{
    /*color: var(--darkgray);*/
    font-weight: 400;
    margin-bottom: 40px;
}
.meal-panel .nut-bars, .nutrition-report .nut-bars{
    margin-bottom: 10px;
}
.meal-panel .nut-bar, .nutrition-report .nut-bar{
    background: #d0d0d0;
    border-radius: 8px;
    color: white !important;
    display: inline-block;
    font-size: 12px;
    text-align: center;
    width: 19.0%;
    margin-right: -0.5%;
}
.nutrition-report .nutrition-label{
    height:  16px;
    width: 16px;
    border-radius: 50%;
    display: inline-block;
    background-color: #ccc;
}
.m-b {
    margin-bottom: 15px;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}
.meal-panel{
    background: white;
    border: 1px solid #ccc;  
    padding: 12px;
    margin: 10px 0px; 
}
.meal-panel.monday{border-left: 5px solid #f9dc06;}
.meal-panel.tuesday{border-left: 5px solid #ff6663;}
.meal-panel.wednesday{border-left: 5px solid #7ac943;}
.meal-panel.thursday{border-left: 5px solid #f7931e;}
.meal-panel.friday{border-left: 5px solid #3fa6f2;}
.meal-panel>.col{
    /*float: left !important;
    flex-basis: unset;
    flex-grow: unset;*/
    padding-left: 8px;
    padding-right: 8px; 
}
.meal-panel .col-day{
    /*width: 6%;
    padding-left: 0px;*/
    margin-right: -12px;
}
.meal-panel .col-meal{
    width: 31%;
    /*padding-right: 12px;*/
}
.meal-panel .col-nutrition{width: 23%;}
.meal-panel .mlabel{
    color: var(--darkgray);
    font-size: 16px;
    margin-bottom: 8px;
}
.meal-panel .mdate{
    color: var(--darkgray);;
    font-size: 32px;
    font-weight: 300; 
    margin-top: -10px;
}
</style>
</header>
<body>
	<div id="wrapper">
	    <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
	    <div>
	        <div class="">
	        	@foreach ($logs as $log)
	        		{{ $log->food_thai }}
	        	@endforeach
	            @foreach ($dateData as $date)
					<div class="meal-panel  {{$date[0]}}">
						<div class="m-b">
							<div class="">
								<span>{{$date[1]}}</span>
								<span id="{{$date[0]}}Date" data-date={{$date[2]}} class="report-date">{{$date[2]}}</span>
							</div>
						</div>
						@foreach ($mealSetting as $meal)
							@if ($meal[2] == 1)
							<div class="m-b">
								<div class="">{{$meal[1]}}</div>
								<div class="col-lg-10">
									@php $type =  empty($logs) ? 0 : $logs[0]->food_type @endphp
				                    @foreach ($logs as $log)
				                        @if ($log->meal_code == $meal[0] && $log->meal_date == $date[2])
				                            <div class=""> 
				                                @if($log->food_type != 8 && $log->food_type != 22)
				                                    <span class="text-highlight">({{$log->setting_description_thai}})</span>
				                                @endif
				                                <span class="readable-font">{{ $log->food_thai }} </span>
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
</body>

</html>