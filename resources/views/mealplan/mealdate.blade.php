<div class="meal-panel row {{ $day }}">
    <div class="col col-day">
        <div class="mlabel">{{ $day_th }}</div>
        <div class="mdate"><span id={{ $day }}></span></div>
    </div>
    {{--
    <div class="col col-meal" id="breakfast-meal-{{ $day }}" date-date="123">
        <div class="mlabel">เช้า</div>
        <div id="" class="ui-sortable ui-sortable-meal">
            <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
            </div>
        </div>
    </div> --}}

    <div class="col col-meal" id="breakfast-snack-meal-{{ $day }}" date-date="123">
        <div class="mlabel">ว่างเช้า</div>
        <div id="" class="ui-sortable ui-sortable-meal">
            @foreach ($food_logs as $food)
                <div class="menu-body ui-sortable-handle ui-sortable-meal">
                    <span id={{ $food->id }}>{{ $food->food_thai }}</span>
                </div>
            @endforeach
            <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
            </div>
        </div>
    </div>
    <div class="col col-meal" id="lunch-meal-{{ $day }}">
        <div class="mlabel">กลางวัน</div>
        <div id="" class="ui-sortable ui-sortable-meal">
            <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
            </div>
        </div>
    </div>
    <div class="col col-meal" id="lunch-snack-meal-{{ $day }}">
        <div class="mlabel">ว่างบ่าย</div>
        <div id="" class="ui-sortable ui-sortable-meal">
            <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
            </div>
        </div>
    </div>




    <div class="col col-nutrition">
        <div class="mlabel">สารอาหาร</div>
        <div class="energy-contanier">
            <div class="nut-labels">
                <span class="">พลังงาน</span>
                <span class="">0 / 400-550 กิโลแคล</span>
            </div>
            <div class="nut-tabs">
                <div class="nut-tab danger selected">น้อยเกิน</div>
                <div class="nut-tab warning selected">น้อย</div>
                <div class="nut-tab ok selected">พอดี</div>
                <div class="nut-tab warning selected">มาก</div>
                <div class="nut-tab danger selected">มากเกิน</div>
            </div>
            <div class="nut-labels">
                <span class="">พลังงาน</span>
                <span class="">0 / 400-550 กิโลแคล</span>
            </div>
            <div class="nut-tabs">
                <div class="nut-tab danger">น้อยเกิน</div>
                <div class="nut-tab warning">น้อย</div>
                <div class="nut-tab ok">พอดี</div>
                <div class="nut-tab warning">มาก</div>
                <div class="nut-tab danger">มากเกิน</div>
            </div>
            <div class="nut-labels">
                <span class="">พลังงาน</span>
                <span class="">0 / 400-550 กิโลแคล</span>
            </div>
            <div class="nut-tabs">
                <div class="nut-tab danger">น้อยเกิน</div>
                <div class="nut-tab warning">น้อย</div>
                <div class="nut-tab ok">พอดี</div>
                <div class="nut-tab warning">มาก</div>
                <div class="nut-tab danger">มากเกิน</div>
            </div>
        </div>
    </div>
</div>
