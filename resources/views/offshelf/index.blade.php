@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/b_offshelf.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_下架</title>
@endsection

@section('main')
    {{-- <a href="{{ route('putshelfs.create')}}">新增上架</a> --}}
    
    @if (session()->has('notice')) 
        <div class="m-2 bg-green-300 px-3 py-2 rounded">
            {{ session()->get('notice')}}
        </div>
    @endif

    @if (session()->has('no')) 
        <div class="m-2 p-1 bg-red-500 text-red-100 font-thin px-3 py-2 rounded">
            {{ session()->get('no')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="errors m-2 p-1 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  

    <nav>
        <div class="nav nav-tabs col-md-10" id="nav-tab" role="tablist" >
            <a class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">下架</a>
            <a class="nav-link" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">已下架</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><!--已下架-->
            <div id=h1></div>

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
                    </tr>
                    </thead>
                </div>
                <div class="tbl-content ">
                    <tbody>
                    @foreach($alreadyoffs as $alreadyoff)
                    <tr>
                        @if ($alreadyoff->date == date('Y-m-d', strtotime('+8HOUR') ))
                            @if ($alreadyoff->Ltime < date('H:i', strtotime('+8HOUR') ))
                                <td>{{ $alreadyoff->fName}}</td>
                                <td>{{ $alreadyoff->date }}</td>
                                <td>{{ $alreadyoff->Ltime }}</td>  
                                <td>{{ $alreadyoff->toplace}}</td>
                                <td>{{ $alreadyoff->foplace}}</td>
                                <td>{{ $alreadyoff->airSeat}}</td>
                                <td>{{ $alreadyoff->unboughtSeat}}</td>
                                <td>{{ $alreadyoff->fprice}}</td>
                            @endif
                        @else
                            <td>{{ $alreadyoff->fName}}</td>
                            <td>{{ $alreadyoff->date }}</td>
                            <td>{{ $alreadyoff->Ltime }}</td>  
                            <td>{{ $alreadyoff->toplace}}</td>
                            <td>{{ $alreadyoff->foplace}}</td>
                            <td>{{ $alreadyoff->airSeat}}</td>
                            <td>{{ $alreadyoff->unboughtSeat}}</td>
                            <td>{{ $alreadyoff->fprice}}</td>
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </section>
        </div>

        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><!--下架-->
            <form action="{{ route('offshelfs.store') }} " method="POST">
                {{-- @method('GET') --}}
                @csrf
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">飛機名稱：</label>
                </div>
                <div class="col-auto">
                    <select name="editname" class="form-select" aria-label="Default select example">
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
                    <input type="date" value="{{ old('editdate') }}" name="editdate" class="form-control">
                </div>
                
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">搜尋</button>
                </div>
            </form>

            <form action="{{ route('offshelfs.off')}}"  method="POST">
                @csrf
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
                        <th><h6><b> 刪除</th>
                        </tr>
                        </thead>
                    </div>
                
                    <div class="tbl-content ">
                        <tbody>
                        @foreach($offs as $off)
                        <tr>
                            @if ($off->date == date('Y-m-d', strtotime('+8HOUR') ))
                                @if ($off->Ltime > date('H:i', strtotime('+8HOUR') ))
                                    <td>{{ $off->fName}}</td>
                                    <td>{{ $off->date }}</td>
                                    <td>{{ $off->Ltime }}</td>  
                                    <td>{{ $off->toplace}}</td>
                                    <td>{{ $off->foplace}}</td>
                                    <td>{{ $off->airSeat}}</td>
                                    <td>{{ $off->unboughtSeat}}</td>
                                    <td>{{ $off->fprice}}</td>
                                    <td><input class="form-check-input" type="checkbox" name="checkbox{{$off->fId}}" value="{{$off->fId}}">刪除</td>
                                @endif
                            @else
                            <td>{{ $off->fName}}</td>
                            <td>{{ $off->date }}</td>
                            <td>{{ $off->Ltime }}</td>  
                            <td>{{ $off->toplace}}</td>
                            <td>{{ $off->foplace}}</td>
                            <td>{{ $off->airSeat}}</td>
                            <td>{{ $off->unboughtSeat}}</td>
                            <td>{{ $off->fprice}}</td>
                            <td><input class="form-check-input" type="checkbox" name="checkbox[]" value="{{$off->fId}}"></td>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                data-bs-whatever="{{$off->fName}}" data-bs-whatever2="{{$off->fId}}">刪除</button> --}}

                            @endif      
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </section>
            
                <div class="d-grid gap-2 col-2 mx-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">刪除</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                {{-- <input type="hidden" name="fId"> --}}
                                <h5 class="modal-title" id="exampleModalLabel">確認刪除</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    確定要刪除嗎?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary">確認</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                
                {{-- <script>
                    var exampleModal = document.getElementById('exampleModal')
                    exampleModal.addEventListener('show.bs.modal', function (event) {
                    // Button that triggered the modal
                    var button = event.relatedTarget
                    // Extract info from data-bs-* attributes
                    var recipient = button.getAttribute('data-bs-whatever')
                    var recipient2 = button.getAttribute('data-bs-whatever2')
                    
                    // var modalBody = exampleModal.querySelector('.modal-body')
                    var modalMadalfade = exampleModal.querySelector('.modal-header input')

                    // modalBody.textContent = '確定要刪除' + recipient + '嗎?'
                    modalMadalfade.value = recipient2
                    })
                </script> --}}
            
        </div>    
    </div>    

@endsection