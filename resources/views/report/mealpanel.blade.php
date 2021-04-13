@foreach ($selectedDates as $date)
	<div class="meal-panel  {{$date['engDay']}}">
		<div class="row m-b">
			<div class="col col-lg-12">
				<span>{{$date['thDay']}}</span>
				<span id="{{$date['engDay']}}Date" data-date="{{$date['date']}}" class="report-date"></span>
			</div>
		</div>
		@foreach ($school->setting->getMealsettings() as $meal)
			@if ($meal[2] == 1)
			<div class="row m-b">
				<div class="col col-lg-2">{{$meal[1]}}</div>
				<div class="col col-lg-10">
                    @foreach ($logs as $log)
                        @if ($log->meal_code == $meal[0] && $log->meal_date == $date['date'] && $log->food_type == $setting['id'])
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
	</div>
@endforeach
