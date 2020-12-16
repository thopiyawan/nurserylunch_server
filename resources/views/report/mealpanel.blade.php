@foreach ($dateData as $date)
	<div class="meal-panel  {{$date[0]}}">
		<div class="row m-b">
			<div class="col col-lg-12">
				<span>{{$date[1]}}</span>
				<span id="{{$date[0]}}Date">{{ $date[2] }}</span>
			</div>
		</div>
		@foreach ($mealSetting as $meal)
			@if ($meal[2] == 1)
			<div class="row m-b">
				<div class="col col-lg-2">{{$meal[1]}}</div>
				<div class="col col-lg-10">
					@php $type =  empty($logs) ? 0 : $logs[0]->food_type @endphp
                    @foreach ($logs as $log)
                        @if ($log->meal_code == $meal[0] && $log->meal_date == $date[2])
                            <div class=""> 
                                @if($log->food_type != 8 && $log->food_type != 22)
                                    <span class="text-highlight">({{$log->setting_description_thai}})</span>
                                @endif
                                {{ $log->food_thai }} 
                            </div>
                        @endif
                    @endforeach
				</div>
			</div>
			@endif
		@endforeach
	</div>
@endforeach