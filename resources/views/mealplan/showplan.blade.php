@extends('layouts.app')
@section('content')
    <aside id="aside-menu" class="">

        <!-- SER|ARCH SECTION  -->
        @include('mealplan.showsidemenu')

    </aside>
    <div id="wrapper" class="">
        <div class="row">
            <div class="col-lg-2">
                <h1 class="page-title"> เมนูอาหาร </h1>
            </div>
            <div class="col-lg-3 heading-p-t">
                <h3>
                    <i class="fas fa-calendar-alt color-gray"></i>
                    <span id="startDate"></span>
                    <span id="startDate"></span>
                    <span> - </span>
                    <span id="endDate"></span>
                </h3>
            </div>
            <div class="col-lg-4 heading-p-t">
                <h3>
                    <span><i class="fas fa-user-friends color-gray"></i></span>
                    <span> เด็กอายุต่ำกว่า 1 ปี </span>
                </h3>
            </div>
            <div class="col-lg-3 heading-p-t pull-right">
                 <a href="/mealplan/edit" class="btn btn-primary pull-right" type="" name="" value="">
                    <i class="fas fa-edit"></i>
                    แก้ไขรายการอาหาร
                </a>
            </div>
        </div>

        <div class="">
            <div class="hpanel plan-panel">
                <ul class="nav nav-tab">
                    <li class="">
                        <a data-toggle="tab" href="#tab-1" aria-expanded="true" class="active">ต่ำกว่า 1 ปี (ปกติ)</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-2" aria-expanded="false">ต่ำกว่า 1 ปี (มุสลิม)</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-3" aria-expanded="false">ต่ำกว่า 1 ปี (แพ้กุ้ง)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="">
                            <div id="meal-plan">
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <strong>ต่ำกว่า 1 ปี (มุสลิม)</strong>

                            <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <strong>ต่ำกว่า 1 ปี (แพ้กุ้ง)</strong>

                            <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                            <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        
    @endsection
