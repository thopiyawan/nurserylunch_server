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
                    <th>ลำดับที่</th>
                    <th>ประเภท</th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>หมายเหตุ</th>
                  </tr>
                  @php $count = 0; @endphp
                  @php $max = count($materials); @endphp
                  @foreach (range($count, $count+20) as $i)
                    @if ($count < $max)
                    <tr>
                      <td>{{$count+1}}</td>
                      <td></td>
                      <td>{{$materials[$i]->getCompositionName()}}</td>
                      <td>{{$materials[$i]->pur_quantity.' '.$materials[$i]->unit}}</td>
                      <td></td>
                    </tr>
                    @php $count +=1; @endphp
                    @endif
                  @endforeach
                </table>
            </div>
            
        </div>
    </div>
</div>
@if ($count < $max)
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
                    <th>ลำดับที่</th>
                    <th>ประเภท</th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>หมายเหตุ</th>
                  </tr>
                    @foreach (range($count, $count+20) as $i)
                      @if ($count < $max)
                      <tr>
                        <td>{{$count+1}}</td>
                        <td></td>
                        <td>{{$materials[$i]->getCompositionName()}}</td>
                        <td>{{$materials[$i]->pur_quantity.' '.$materials[$i]->unit}}</td>
                        <td></td>
                      </tr>
                      @php $count +=1; @endphp
                      @endif
                    @endforeach
                </table>
            </div>

        </div>
    </div>
</div>
@endif
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



