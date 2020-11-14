<div class="m-b center">
    <h4 class="text-center">แสดงเมนูอาหารของสัปดาห์</h4>
    <!-- <button class="btn btn-block btn-default m-b" type="" name="" value="">สัปดาห์นี้</button> -->
    <div id="week-picker"></div>
        <!-- <br /><br />
        <label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span> -->
    </body>
</div>

<!-- FILTER SECTION  -->
<div class="m-b">
    <h4 class="center"> สำหรับเด็กอายุ</h4>
    <ul class="nav nav-tab main-level age-range" id="">
        @if ($userSetting->is_for_small == 1)
            <li class="">
                <a  href="#" class="age-tab active" id="" data-age="is_for_small" aria-expanded="false" >
                    <span class="">ต่ำกว่า 1 ปี</span>
                </a>
            </li>
        @endif
        @if ($userSetting->is_for_big == 1)
            <li class="">
                <a  href="#" class="age-tab" id="" data-age="is_for_big"  aria-expanded="false" >
                    <span class="">1 - 3 ปี</span>
                </a>
            </li>
        @endif
    </ul>
</div>