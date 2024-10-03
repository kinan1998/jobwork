@extends('index')
@section('content')



    @if (auth()->guard('company')->user()->type == 'owner')

        @include('content.owner')
    @else


        @include('content.admin')

    @endif

@endsection