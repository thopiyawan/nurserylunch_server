@foreach ($selectedDates as $date)
    <div class="meal-panel {{ $date['engDay'] }}" data-date="{{$date['date']}}" data-type="{{$setting_id}}">
        <div class="row">
            <div class="col col-lg-1 col-day">
                <div class="mlabel">{{ $date['thDay']}}</div>
                <div class="mdate {{ $date['engDay'] }}">
                    <span id="{{ $date['engDay']}}"> {{ date('d', strtotime($date['date']))}}</span>
                </div>
            </div>

            @foreach ($school->setting->getMealSettings() as $meal)
                 @if ($meal[2] == 1)
                    <div class="col col-meal" id="{{$meal[3]}}-{{$date['engDay']}}">
                        <div class="mlabel">{{$meal[1]}}</div>
                        <div id="" class="ui-sortable ui-sortable-meal {{$meal[3]}}-{{$date['engDay']}} {{$setting_id}}"
                            data-day="{{ $date['engDay'] }}" data-meal="{{$meal[3]}}" data-type="{{$setting_id}}">
                            @foreach ($food_logs as $food)
                                @if ($food->meal_code == $meal[0] && $food->meal_date == $date['date'] && $food->food_type == $setting_id)
                                    <div class="ui-sortable ui-sortable-meal">
                                        <div class="menu-body food">
                                            <div class="col col-food-name" 
                                                data-energy="{{ $food->food->nutritions->energy}}"
                                                data-protein="{{ $food->food->nutritions->protein }}" 
                                                data-fat="{{ $food->food->nutritions->fat }}" 
                                                data-carbohydrate="{{ $food->food->nutritions->carbohydrate }}"
                                                data-vitamin_a="{{ $food->food->nutritions->vitamin_a }}"
                                                data-vitamin_b1="{{ $food->food->nutritions->vitamin_b1 }}"
                                                data-vitamin_b2="{{ $food->food->nutritions->vitamin_b2 }}"
                                                data-vitamin_c="{{ $food->food->nutritions->vitamin_c }}"
                                                data-iron="{{ $food->food->nutritions->iron }}"
                                                data-calcium="{{ $food->food->nutritions->calcium }}"
                                                data-phosphorus="{{ $food->food->nutritions->phosphorus }}"
                                                data-fiber="{{ $food->food->nutritions->fiber }}"
                                                data-sodium="{{ $food->food->nutritions->sodium }}"
                                                data-sugar="{{ $food->food->nutritions->sugar }}"
                                                id="{{ $food->food_id }}">
                                                {{ $food->food_thai }}
                                            </div>
                                            <div class="col col-delete">
                                                <a class="pull-right">
                                                    <span><i class="fas fa-times"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="placeholder">
                                <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                                    <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
            @endforeach
        </div> 

        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col col-lg-1 no-padding-right">
                        <div class="mlabel font-bold">สารอาหาร</div>
                    </div>
                    <div class="col col-nutrition">        
                        <div class="energy">
                            <div class="nut-labels row">
                                <div class="col col-lg-3">พลังงาน</div>
                                <!-- <div class="col text-right">
                                    <span class="current"> 0 </span>
                                    <span> / </span>
                                    <span class="target"> //// </span>
                                    <span class="unit"> กิโลแคลอรี่ </span>
                                </div> -->
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
                    <div class="col col-nutrition">  
                        <div class="protein">
                            <div class="nut-labels row">
                                <div class="col col-lg-3">โปรตีน</div>
                                <!-- <div class="col text-right">
                                    <span class="current"> 0 </span>
                                    <span> / </span>
                                    <span class="target"> 400-550 </span>
                                    <span class="unit"> กรัม </span>
                                </div> -->
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
                    <div class="col col-nutrition">  
                        <div class="fat">
                            <div class="nut-labels row">
                                <div class="col col-lg-3">ไขมัน</div>
                                <!-- <div class="col text-right">
                                    <span class="current"> 0 </span>
                                    <span> / </span>
                                    <span class="target"> 400-550 </span>
                                    <span class="unit"> กรัม </span>
                                </div> -->
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
                    <div class="col col-lg-2 text-center m-t">  
                        <!-- <button id="" class="btn btn-outline btn-primary">สารอาหารรอง</button> -->
                        <div class="btn-group open">
                            <button data-toggle="dropdown" class="btn btn-outline btn-primary" aria-expanded="true"> 
                                สารอาหารรอง
                            </button>
                            <div class="dropdown-menu">
                                <div class="row">
                                    
                                </div>
                                <div class="carbohydrate">
                                    <span>คาร์โบไฮเดรต</span>
                                    <span class="pull-right nut-bar selected ">พอดี</span>
                                </div>
                                <div class="vitamin_a">
                                    <span>วิตามินเอ </span>
                                    <span class="pull-right nut-bar selected ">พอดี</span>
                                </div>
                                <div class="vitamin_b1">
                                    <span>วิตามินบี 1 </span>
                                    <span class="pull-right nut-bar selected ">พอดี</span>
                                </div>
                                <div class="vitamin_b2">
                                    <span>วิตามินบี 2 </span>
                                    <span class="pull-right nut-bar selected">พอดี</span>
                                </div>
                                <div class="vitamin_c">
                                    <span>วิตามินซี </span>
                                    <span class="pull-right nut-bar selected">พอดี</span>
                                </div>
                                <div class="iron">
                                    <span>ธาตุเหล็ก</span>
                                    <span class="pull-right nut-bar selected">พอดี</span>
                                </div>
                                <div class="calcium">
                                    <span>แคลเซียม</span>
                                    <span class="pull-right nut-bar selected">พอดี</span>
                                </div>
                                <div class="phosphorus">
                                    <span>ฟอสฟอรัส </span>
                                    <span class="pull-right nut-bar selected">พอดี</span>
                                </div>
                                <div class="fiber">
                                    <span>ใยอาหาร</span>
                                    <span class="pull-right nut-bar selected">พอดี</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach