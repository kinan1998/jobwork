@extends('index')
@section('content')

	<!-- container -->
    <div class="container-fluid">

       
        <div class="breadcrumb-header justify-content-between">
        </div>
        <!-- breadcrumb -->
      
            <div class="row">
                <div class="col-md-6">
                    <div class="card  shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $Subscription->company->name_company }}
                                
                            <small class="text-light"> {{ $Subscription->name }}</small></h2>

                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.payment_type')}}:</strong>
                                    <p>{{ $Subscription->payment_type }}</p>
                                </div>
                                <div class="col-6">
                                    <strong>{{__('route.By')}}:</strong>
                                    <p>{{ $Subscription->By}}</p>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.id_payment')}}:</strong>
                                    <p>{{$Subscription->id_payment }}</p>
                                </div>

                                <div class="col-6">
                                    <strong>{{__('route.status')}}:</strong>
                                    <p
                                    class="
                                    @if($Subscription->status == 'Acceptable')
                                        bg-success
                                    @elseif($Subscription->status == 'Unacceptable')
                                        bg-danger
                                    @elseif($Subscription->status == 'In Processing')
                                        bg-warning
                                    @else
                                        bg-secondary
                                    @endif
                                    ">
                                    {{$Subscription->status }}</p>
                                </div>
                            </div>

                            
                            
                                
                           
        
                            

                            
        
                          
        
        
                            <p class="text-muted"><small>{{__('route.Posted on')}} {{ $Subscription->created_at->format('M d, Y') }}</small></p>
                        </div>
                    </div>
                    <a href="{{route('Unacceptable',$Subscription->id)}}" class="btn btn-outline-danger btn-block">{{__('route.Unacceptable')}} </a>
                    <a href="{{route('Acceptable',$Subscription->id)}}" class="btn btn-outline-success btn-block">{{__('route.Acceptable')}}</a>

                </div>
            </div>
    </div>


@endsection
