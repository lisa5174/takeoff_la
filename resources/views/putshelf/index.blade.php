@extends('layouts.flights')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/p2.css')}}"/>
@endsection

@section('title')
    <title>Take off 空|後台_已上架</title>
@endsection

@section('main')
    @if (session()->has('notice')) 
        <div class="m-2 bg-green-300 px-3 py-2 rounded">
            {{ session()->get('notice')}}
        </div>
    @endif
    已上架
    <a href="{{ route('putshelfs.create')}}">新增上架</a>
@endsection