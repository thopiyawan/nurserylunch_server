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
                      @foreach ($logs as $log)
                        @if($date['date'] == $log->meal_date)
                          <tr class="log-row">
                            <td class="short-date report-date" style="width:15%" data-date="{{$log->meal_date}}"></td>
                            <td><span class="log-meal">{{$log->getMealName()}}</span></td>
                            <td class=""><span class="log-age">{{$log->getFoodTypeAgeThai()}}  </span></td>
                            <td class="{{$log->food_type == 8 || $log->food_type == 22 ? '' : 'text-highlight'}} log-food-type">
                              <span> {{$log->getFoodTypeName()}}</span>
                            </td>
                            <td class="">
                                <div>
                                  <span class="readable-font log-food-name">{{ $log->food_thai}} </span>
                                </div>
                            </td>
                            <td class="log-serving"> {{ $log->serving}} ชุด</td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>

                  </table>
              </div>
          </div>