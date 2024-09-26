@extends('index')
@section('content')

	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.subscriptio')}}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
              
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                    <a type="button" class="btn btn-info btn-icon mr-2" class="modal-effect  btn-block" data-effect="effect-sign" 
                    data-toggle="modal" title="{{__('route.Add')}}" href="#modaldemo8"> <i class="mdi mdi-plus"></i></a>
                  
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
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_company')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name')}}</th>

                                        <th class="wd-10p border-bottom-0"> {{__('route.Number_of_opportunities')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.payment_type')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.By')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.id_payment')}}</th>
                                        <th class="wd-10p border-bottom-0"> {{__('route.status')}}</th>
                                        <th class="wd-30p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Subscription as $item)
                                        <tr>
                                        
                                                <td>{{$item->company->name_company}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->plan->Number_of_opportunities}}</td>
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
                                                        <div class="d-flex align-items-center">
                                                            <div class="dropdown mr-2">
                                                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-sm btn-warning"
                                                                    data-toggle="dropdown" type="button">
                                                                    {{__('route.status')}}
                                                                    <i class="fas fa-caret-down ml-1"></i>
                                                                </button>
                                                                
                                                                <div class="dropdown-menu tx-13">
                                                                    <a class="dropdown-item " href="{{route('Unacceptable',$item->id)}}">{{__('route.Unacceptable')}}</a>
                                                                    <a class="dropdown-item" href="{{route('Acceptable',$item->id)}}">{{__('route.Acceptable')}}</a>
                                                                </div>
                                                            </div>

                                                            <a href="{{route('subscriptio.destroy',$item->id)}}" class="btn btn-danger btn-sm" 
                                                                title="{{ trans('route.Delete') }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>

                                        </tr>
                                   
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

    @include('back.subscrip.create')
   
@endsection