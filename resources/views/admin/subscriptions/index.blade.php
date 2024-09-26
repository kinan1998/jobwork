@extends('index')
@section('content')


	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.My_subscriptions')}}</span>
                </div>
            </div>
           
        </div>
        <!-- breadcrumb -->

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.Number_of_opportunities')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.remaining_opportunities')}}</th>

                                        <th class="wd-15p border-bottom-0"> {{__('route.payment_type')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.By')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.id_payment')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.status')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $item)
                                        <tr>
                                            {{-- <td>{{$item->job_opportunities_count}}</td> <!-- Number of used opportunities -->
                                            <td>{{$item->plan->Number_of_opportunities - $item->job_opportunities_count}}</td> <!-- Remaining opportunities -->
                                             --}}
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->plan->Number_of_opportunities}}</td>
                                                <td>{{$item->remaining_opportunities}}</td>
                                                <td>{{$item->payment_type}}</td>
                                                <td>{{$item->By}}</td>
                                                <td>{{$item->id_payment}}</td>
                                                <td class="
                                                        @if($item->status == 'Acceptable')
                                                            bg-success
                                                        @elseif($item->status == 'Unacceptable')
                                                            bg-danger
                                                        @elseif($item->status == 'In Processing')
                                                            bg-warning
                                                        @else
                                                            bg-secondary
                                                        @endif
                                                    ">
                                                        {{$item->status}}
                                                    </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#modaldemo8_edit{{ $item->id }}"
                                                        title="{{ trans('route.Edit') }}"><i class="fa fa-edit"></i>
                                                    </button>
                                                
                                                    <a href="{{route('subscriptio.destroy',$item->id)}}" class="btn btn-danger btn-sm" 
                                                        title="{{ trans('route.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </td>
                                        </tr>
                                        @include('admin.subscriptions.edit')
                                    @endforeach
                         
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- /row -->
    </div>
    
    <!-- Container closed -->
@endsection