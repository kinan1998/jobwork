@extends('index')
@section('content')

	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.job_title')}}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
              
                {{-- <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                    <a type="button" class="btn btn-info btn-icon mr-2" class="modal-effect  btn-block" data-effect="effect-sign" 
                    data-toggle="modal" title="{{__('route.Add')}}" href="#modaldemo8"><i class="mdi mdi-filter-variant"></i></a>
                  
                </div> --}}

               
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-8">
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
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_Scope_of_work')}}</th>

                                        <th class="wd-15p border-bottom-0"> {{__('route.name_arabic')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_english')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobtitles as $item)
                                        <tr>
                                                
                                                <td>
                                                    @if (app()->getLocale() == 'en')
                                                        {{$item->scope_work->name_en}} 
                                                    @else 
                                                        {{$item->scope_work->name_ar}}
                                                
                                                    @endif
                                                </td>
 
                                                <td>{{$item->name_ar}}</td>
                                                <td>{{$item->name_en}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#modaldemo8_edit{{ $item->id }}"
                                                        title="{{ trans('route.Edit') }}"><i class="fa fa-edit"></i>
                                                    </button>
                                                
                                                    <a href="{{route('job_title.destroy',$item->id)}}" class="btn btn-danger btn-sm" 
                                                        title="{{ trans('route.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </td>
                                        </tr>
                                        @include('back.job_title.edit')
                                    @endforeach
                         
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4">
                
                    <div class="card" data-select2-id="9">
                        <div class="card-body" data-select2-id="8">
                            <div class="main-content-label mg-b-5">
                                {{__('route.Add')}} {{__('route.job_title')}}
                            </div>
                            <br>
                            <form action="{{route('job_title.store')}}" method="POST" class="parsley-style-1" id="selectForm2" name="selectForm2" novalidate="" data-select2-id="selectForm2">
                                @csrf

                                <div class="row">
                                    <div class="parsley-select col-lg-12 col-md-12" id="slWrapper">
                                        <select name="scope_work_id" class="form-control select2" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one" required="">
                                            <option label="Choose one">
                                            </option>
                                            @foreach ($scopeworks as $item)
                                                <option value="{{ $item->id }}" {{ old('scope_work_id') == $item->id ? 'selected' : '' }}>
                                                    {{$item->name_en}} / {{$item->name_ar}}
                                                </option>
                                            @endforeach
                                        
                                        </select>
                                        <div id="slErrorContainer"></div>
                                    </div>
                                   
                                </div>
                                <br>
                                <div class="">
                                    <div class="row mg-b-20">
                                        <div class="parsley-input col-md-6" id="fnWrapper">
                                            <label>{{__('route.name_arabic')}}: <span class="tx-danger">*</span></label>
                                            <input class="form-control" data-parsley-class-handler="#fnWrapper" value="{{old('name_ar')}}" name="name_ar" placeholder="{{__('route.name_arabic')}}" required="" type="text">
                                        </div>
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label>{{__('route.name_english')}}: <span class="tx-danger">*</span></label>
                                            <input class="form-control" data-parsley-class-handler="#lnWrapper" value="{{old('name_en')}}" name="name_en" placeholder="{{__('route.name_english')}}" required="" type="text">
                                        </div>
                                    </div>
                                </div>
                              
                            
                             
                               
                                <div class="mg-t-30">
                                    <button class="btn btn-main-primary pd-x-20" type="submit">{{__('route.Add')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div class="col-xl-4">
            <!--/div-->
        </div>
        <!-- /row -->
    </div>
    <!-- Container closed -->


   
@endsection