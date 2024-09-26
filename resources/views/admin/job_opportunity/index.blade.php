@extends('index')
@section('content')
<?php
$lang = app()->getLocale();
?>
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
              
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                    <a type="button" class="btn btn-info btn-icon mr-2" class="modal-effect  btn-block" 
                         title="{{__('route.Add')}}" href="{{route('create.Job.Opportunity.admin')}}">
                        <i class="mdi mdi-plus"></i>
                       
                    </a>
                  
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
                                        <th class="wd-15p border-bottom-0"> {{__('route.scope_work')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.job_title')}}</th>

                                        <th class="wd-15p border-bottom-0"> {{__('route.status')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_opportunitys as $item)
                                        <tr>
                                        
                                                <td>{{$item->scopework->{'name_'.$lang} }}</td>
                                                <td>{{$item->jobtitle->{'name_'.$lang} }}</td>
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
                                                    {{ __('route.'.$item->status) }}
                                                </td>
                                                <td>
                                                    

                                                    <a href="{{route('job_opportunity.show',$item->id)}}" class="btn btn-info btn-sm" 
                                                        title="{{ trans('route.Delete') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="{{route('job_opportunity.edit',$item->id)}}" class="btn btn-warning btn-sm" 
                                                        title="{{ trans('route.Edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                   
                                                
                                                    <a href="{{route('job_opportunity.destroy',$item->id)}}" class="btn btn-danger btn-sm" 
                                                        title="{{ trans('route.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

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

   
   
@endsection