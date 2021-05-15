@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_offshelf.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_修改</title>
@endsection

@section('main')

    @if ($errors->any())
    <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  

<span class="col-10" id="g1"> <br>
    <nav>
        <div class="nav nav-tabs col-md-10" id="nav-tab" role="tablist" >
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">航班</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">旅客</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--航班-->
            <div class="row g-3 align-items-center float-right">
                <form action="{{ url('/updateflights') }} " method="POST">
                  {{-- @method('GET') --}}
                    @csrf
                    <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">飛機名稱：</label>
                    </div>
                    <div class="col-auto">
                        <select name="updatename" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            @foreach($airplanes as $airplane)
                                <option>{{ $airplane->airName}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" value="{{ old('updatename') }}" name="updatename" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline"> --}}
                    </div>

                    <div class="col-auto">
                        <label for="inputAddress" class="form-label">起飛日期：</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" value="{{ old('updatedate') }}" name="updatedate" class="form-control" id="apdate" >
                    </div>
                    
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">搜尋</button>
                    </div>
                </form>
            </div><br>

            @if(!isset($flights))
                請搜尋欲修改的航班
            @elseif(empty($flights))
                <h4>查無航班!</h4>
            @else
                <section class="table table-hover">
                    <div > <!--時間表-->
                    <table cellpadding="0" cellspacing="0" >
                        <thead>
                        <tr class="tbl-header">
                            <th><h6><b> 飛機名稱</th>
                            <th><h6><b> 起飛日期</th>    
                            <th><h6><b> 起飛時間</th>
                            <th><h6><b> 起飛地點</th>
                            <th><h6><b> 降落地點</th>
                            <th><h6><b> 座位數量</th>
                            <th><h6><b> 已售座位</th>
                            <th><h6><b> 機票價格</th>
                            <th><h6><b> 修改</th>
                        </tr>
                        </thead>
                    </div>
                    <div class="tbl-content ">
                        <tbody>
                            @foreach($flights as $flight)
                            <tr>
                                @if ($flight->date == date('Y-m-d', strtotime('+8HOUR') ))
                                    @if ($flight->Ltime > date('H:i', strtotime('+8HOUR') ))
                                        <td>{{ $flight->fName}}</td>
                                        <td>{{ $flight->date }}</td>
                                        <td>{{ $flight->Ltime }}</td>  
                                        <td>{{ $flight->toplace}}</td>
                                        <td>{{ $flight->foplace}}</td>
                                        <td>{{ $flight->airSeat}}</td>
                                        <td>{{ $flight->unboughtSeat}}</td>
                                        <td>{{ $flight->fprice}}</td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('updateflight.edit',$flight->fId)}}'">修改</button>
                                                {{-- <a href=" ">修改</a> --}}
                                            </div>
                                        </td>
                                    @endif
                                @else
                                    <td>{{ $flight->fName}}</td>
                                    <td>{{ $flight->date }}</td>
                                    <td>{{ $flight->Ltime }}</td>  
                                    <td>{{ $flight->toplace}}</td>
                                    <td>{{ $flight->foplace}}</td>
                                    <td>{{ $flight->airSeat}}</td>
                                    <td>{{ $flight->unboughtSeat}}</td>
                                    <td>{{ $flight->fprice}}</td>
                                    <td>
                                        <div>
                                            <button type="submit" class="btn btn-primary" 
                                            onclick="location.href='{{ route('updateflight.edit',$flight->fId)}}'">修改</button>
                                            {{-- {{ route('updateflight.edit',['updateflight' => $flight->fId])}} 這也可以 --}}
                                            {{-- {{ url('/updateflights',[$flight->fId],'/edit' )}} --}}
                                            {{-- {{ url('/updateflights/{updateflight}/edit',[$flight->fId] )}} --}}
                                        </div>
                                    </td>
                                @endif
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </section>
            @endif
        </div>
        
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><!--旅客-->
          <div class="row g-3 align-items-center float-right">
            <div class="col-auto">
              <label for="inputPassword6" class="col-form-label">訂單編號：</label>
            </div>
            <div class="col-auto">
              <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary">搜尋</button>
            </div>
          </div><br>
          <div class="container">
            <div class="row"><h4>訂單資訊</h4></div><br>
            <div class="row offset-md-1">
              <div class="col-4">姓名：</div>
              <div class="col-6">身分證字號：</div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-4">性別：</div>
              <div class="col-6">生日：</div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-4">票種：<a href="#" class="text-reset">修改</a></div>
            </div><br>
            <div class="row offset-md-1">
              <div class="col-4">航班資訊：</div>
            </div>
          </div><br>
          
          <div class="d-grid gap-2 col-2 mx-auto">
            <!-- Button trigger modal -->
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">取消訂單</button>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">取消訂單</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    確定要取消訂單嗎?
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">確認</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



@endsection