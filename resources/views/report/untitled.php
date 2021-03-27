

@foreach ($settings as $key => $setting_value)

    <div class="row report-nutrition report-a4">
        <div class="row">
            <div class="col-lg-12">
                    <h1 class="page-title">รายงานเมนูรายการอาหาร <span>ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส</span></h1>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="m-b">
                    <i class="fas fa-calendar-alt color-gray"></i>
                    <span class="startDate"></span>
                    <span> - </span>
                    <span class="endDate"></span>
                </div>
                <div class="m-b">
                    <div>
                        <span><i class="fas fa-user-friends color-gray"></i></span>
                        <span> เด็กอายุ</span>
                        <span class="age-range-span"> ต่ำกว่า 1 ปี</span>
                    </div>
                </div>
                <div class="m-b">
                    <div>
                        <span><i class="fas fa-utensils color-gray"></i></span>
                        <span id="food-type-span" class="food-type {{$setting['food_type']==8 || $setting['food_type']==22? 'normal':'special'}}"> {{ $setting['setting_description_thai'] }} </span>
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
                

            </div>
        </div>
    </div>
@endforeach