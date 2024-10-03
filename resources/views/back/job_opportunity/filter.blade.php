@extends('index')
@section('content')

	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.Job_Opportunity')}}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
              
                

               
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
                                        <th class="wd-15p border-bottom-0"> {{__('route.scope_work')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.status')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $item)
                                        <tr>
                                                <td>{{$item->company->name_company}}</td>
                                                <td>{{$item->scopework->name_en}}</td>
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
                                                                {{__('route.Action')}}
                                                                <i class="fas fa-caret-down ml-1"></i>
                                                            </button>
                                                            
                                                            <div class="dropdown-menu tx-13">
                                                                <a class="dropdown-item " href="{{route('job_opportunity.Unacceptable',$item->id)}}">{{__('route.Unacceptable')}}</a>
                                                                <a class="dropdown-item" href="{{route('job_opportunity.Acceptable',$item->id)}}">{{__('route.Acceptable')}}</a>
                                                               
                                                                <a href="{{route('job_opportunity.show',$item->id)}}" class=" dropdown-item " title="">
                                                                    {{ trans('route.show') }}
                                                                </a>

                                                                <a href="{{route('job_opportunity.edit',$item->id)}}" class=" dropdown-item " title="">
                                                                    {{ trans('route.Edit') }}
                                                                </a>
                                                                
                                                                <a href="{{route('job_opportunity.destroy',$item->id)}}" class=" dropdown-item " title="">
                                                                    {{ trans('route.Delete') }}
                                                                </a>


                                                            </div>
                                                        </div>

                                                    

                                                    
                                                       
                                                    </div>
                                                </td>
                                        </tr>
                                        @include('back.cities.edit')
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