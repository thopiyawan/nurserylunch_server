<div class="row report-nutrition report-a4" style="height:1200px">
  <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">รายงานวัตถุดิบซื้อ (ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส) </span></h1>
            </div>
        </div>
        <div class="row m-b">
            <div class="col-lg-12 ">
                <i class="fas fa-calendar-alt color-gray"></i>
                <span>สำหรับเมนูอาหาร วันที่</span>
                <span class="startDate"></span>
                <span> - </span>
                <span class="endDate"></span>
            </div>
        </div>
        
        <div class="row report-material">
            <div class="col-lg-6">
                <table style="width:100%">
                  <tr>
                    <th>ประเภท</th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>หมายเหตุ</th>
                  </tr>
                  <tr>
                    <td>เครื่องปรุง</td>
                    <td>เกลือ</td>
                    <td>1 กก.</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>เครื่องปรุง</td>
                    <td>น้ำตาล</td>
                    <td>10 กก.</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>เครื่องปรุง</td>
                    <td>น้ำตาล</td>
                    <td>10 กก.</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>เครื่องปรุง</td>
                    <td>น้ำตาล</td>
                    <td>10 กก.</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>เครื่องปรุง</td>
                    <td>น้ำตาล</td>
                    <td>10 กก.</td>
                    <td></td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row report-nutrition report-a4" style="height:1200px">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">รายงานวัตถุดิบซื้อ (ศูนย์อนามัยที่ 5 / วัดเทพประสิทธิ์คณาวาส) </span></h1>
            </div>
        </div>
        <div class="row m-b">
            <div class="col-lg-12 ">
                <i class="fas fa-calendar-alt color-gray"></i>
                <span>สำหรับเมนูอาหาร วันที่</span>
                <span class="startDate"></span>
                <span> - </span>
                <span class="endDate"></span>
            </div>
        </div>
        
        <div class="row report-material">
            <div class="col-lg-12">
                <table style="width:100%">
                  <tr>
                    <th scope="col">วันที่</th>
                    <th scope="col">มื้อ</th>
                    <th scope="col">ประเภท</th>
                    <th scope="col">รายการ</th>
                    <th scope="col">จำนวน</th>
                  </tr>
                  @foreach ($logs as $log)
                    <tr scope="">
                      <td class="short-date" style="width:15%" data-date="{{$log->meal_date}}"></td>
                      <td><span class="">{{$log->getMealName()}}</span></td>
                      <td class="{{$log->food_type == 8 || $log->food_type == 22 ? '' : 'text-highlight'}}">
                        <span class="">{{$log->getFoodTypeAgeThai()}}  </span>
                        <span> ({{$log->getFoodTypeName()}})</span>
                      </td>
                      <td class="">
                          <div>
                            <span class="readable-font">{{ $log->food_thai}} </span>
                          </div>
                      </td>
                      <td class=""> {{ $log->serving}} ชุด</td>
                    </tr>
                  @endforeach

                </table>
            </div>
        </div>
    </div>

</div>



