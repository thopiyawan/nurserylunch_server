<div class="row report-nutrition report-a4" style="height:1200px">
  <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">รายงานวัตถุดิบซื้อ ( <span class="shcool-name">{{$school->name}}</span> ) </h1>
            </div>
        </div>
        <div class="row m-b">
            <div class="col-lg-12 ">
                <i class="fas fa-calendar-alt color-gray"></i>
                <span>สำหรับเมนูอาหาร วันที่</span>
                <span class="report-date start-date" data-date="{{$selectedDates[0]['date']}}"> </span>
                <span> - </span>
                <span class="report-date end-date" data-date="{{end($selectedDates)['date']}}"></span>
            </div>
        </div>

        <div class="row report-material">
            <div class="col-lg-12">
                <table style="width:100%" class="table table-striped">
                  <thead>
                    <tr>
                      <th>ลำดับที่</th>  
                      <th>รายการ</th>
                      <th>จำนวน</th>
                      <th>หมายเหตุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $count = 0; @endphp
                    @php $max = count($materials); @endphp
                    @if ($max ==0)
                      <tr class="material-row">
                        <td colspan="4">ไม่พบรายการอาหาร</td>
                      </tr>
                    @endif
                    @foreach (range($count, $count+20) as $i)
                      @if ($count < $max)
                      <tr class="material-row">
                        <td class="material-count">{{$count+1}}</td>
                        <td class="material-name">{{$materials[$i]->getCompositionName()}}</td>
                        <td class="material-quantity">{{$materials[$i]->pur_quantity.' '.$materials[$i]->unit}}</td>
                        <td></td>
                      </tr>
                      @php $count +=1; @endphp
                      @endif
                    @endforeach
                  </tbody>
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
                <h1 class="page-title">รายงานวัตถุดิบซื้อ ({{$school->name}}) </span></h1>
            </div>
        </div>
        <div class="row m-b">
            <div class="col-lg-12 ">
                <i class="fas fa-calendar-alt color-gray"></i>
                <span>สำหรับเมนูอาหาร วันที่ </span>
                <span class="report-date start-date" data-date="{{$selectedDates[0]['date']}}"></span>
                <span> - </span>
                <span class="report-date end-date" data-date="{{end($selectedDates)['date']}}"></span>
            </div>
        </div>
        
        <div class="row report-material">
            <div class="col-lg-12">
                <table style="width:100%" class="table table-striped">
                  <thead>
                    <tr>
                      <th>ลำดับที่</th>
                      
                      <th>รายการ</th>
                      <th>จำนวน</th>
                      <th>หมายเหตุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (range($count, $count+20) as $i)
                      @if ($count < $max)
                      <tr class="material-row">
                        <td class="material-count">{{$count+1}}</td>
                        <td class="material-name">{{$materials[$i]->getCompositionName()}}</td>
                        <td class="material-quantity">{{$materials[$i]->pur_quantity.' '.$materials[$i]->unit}}</td>
                        <td></td>
                      </tr>
                      @php $count +=1; @endphp
                      @endif
                    @endforeach
                  </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endif
@foreach($selectedDates as $date)
  <div class="row report-nutrition report-a4 log-report" style="height:1200px">
      <div class="col-lg-12">
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-title">รายการอาหาร ({{$school->name}}) </span></h1>
              </div>
          </div>
          <div class="row m-b">
              <div class="col-lg-12 ">
                  <i class="fas fa-calendar-alt color-gray"></i>
                  <span>สำหรับเมนูอาหาร วันที่</span>
                  <span class="log-date report-date" data-date="{{$date['date']}}"></span>
                  <span class="log-date-th">({{$date['thDay']}})</span>
              </div>
          </div>
          <div class="row report-material">
              <div class="col-lg-12">
                  <table style="width:100%" class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">วันที่</th>
                        <th scope="col">มื้อ</th>
                        <th scope="col">อายุ</th>
                        <th scope="col">ประเภทอาหาร</th>
                        <th scope="col">รายการ</th>
                        <th scope="col">จำนวน</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $logs = $logsByDates[$date['date']] @endphp
                      @if(count($logs) == 0)
                          <tr class="log-row">
                            <td colspan="6">ไม่พบรายการอาหาร</td>
                          </tr>
                      @else
                        @foreach($logs as $log)
                          <tr class="log-row">
                            <td class="short-date report-date" style="width:15%" data-date="{{$log->meal_date}}"></td>
                              <td><span class="log-meal">{{$log->getMealName()}}</span></td>
                              <td class=""><span class="log-age">{{$log->getFoodTypeAgeThai()}}  </span></td>
                              <td class="{{$log->food_type == 8 || $log->food_type == 22 ? '' : 'text-highlight'}} log-food-type">
                                <span> {{$log->getFoodTypeName()}}</span>
                              </td>
                              <td class="">
                                  <div><span class="readable-font log-food-name">{{ $log->food_thai}} </span></div>
                                  @foreach($log->recipes as $material)
                                    <div class="log-recipes">
                                      <span class="log-recipes-name">*{{$material->getCompositionName()}}</span>
                                      <span class="log-recipes-quantity"> {{$material->pur_quantity*$log->serving.' '.$material->getUnit()}} </span>
                                    </div>
                                  @endforeach
                              </td>
                              <td class="log-serving"> {{ $log->serving}} ชุด</td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
              </div>
          </div>
        
      </div>

  </div>
@endforeach


