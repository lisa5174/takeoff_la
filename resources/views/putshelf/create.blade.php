@extends('layouts.flights')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/p2.css')}}"/>
@endsection

@section('title')
  <title>Take off 空|後台_新增上架</title>
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

  {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><!--增新上架--> --}}
    <form action="{{ route('putshelfs.store')}} " method="POST">
        @csrf
          <div class="col-md-6 offset-md-3">
            <label for="inputPassword4" class="form-label ">飛機名稱：</label>
            <input type="text" name="apname" class="form-control" id="apname">
          </div>
          <div class="col-6 offset-md-3">
            <label for="inputAddress" class="form-label">起飛日期：</label>
            <input type="date" name="apdate" class="form-control" id="apdate" >
          </div>
          <div class="col-6 offset-md-3">
            <label for="inputAddress" class="form-label">起飛時間：</label>
            <input type="time" name="aptime" class="form-control" id="aptime" >
          </div>
          <div class="col-6 offset-md-3">
              <label for="inputAddress" class="form-label">起飛地點：</label>
              <select name="apto" class="form-select" aria-label="Default select example">
                <option selected></option>
                <option>松山(TSA)</option>
                <option>高雄(KHH)</option>
                <option>台中(RMQ)</option>
                <option>花蓮(HUN)</option>
                <option>台東(TTT)</option>
                <option> 澎湖(MZG)</option>
                <option> 金門(KNH)</option>
              </select>
          </div>
          <div class="col-6 offset-md-3">
            <label for="inputAddress" class="form-label">降落地點：</label>
              <select name="apfo" class="form-select" aria-label="Default select example">
                <option selected></option>
                <option>松山(TSA)</option>
                <option>高雄(KHH)</option>
                <option>台中(RMQ)</option>
                <option>花蓮(HUN)</option>
                <option>台東(TTT)</option>
                <option> 澎湖(MZG)</option>
                <option> 金門(KNH)</option>
              </select>
          </div>
          <div class="col-md-6 offset-md-3">
            <label for="inputPassword4" class="form-label ">機票價格：</label>
            <input type="text" name="apprice" class="form-control" id="apname">
          </div>
          <br>
          <div class="d-grid gap-2 col-2 mx-auto">
          <!-- Button trigger modal -->
          <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增</button>
          </div>
    </form>
  {{-- </div> --}}
@endsection