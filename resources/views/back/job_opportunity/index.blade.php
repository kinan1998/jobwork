@extends('index')
@section('content')

<?php 
$lang = app()->getLocale();
?>
	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class=" ">
           
            <div class=" ">
              
                

                
                <form action="{{ route('Job.Opportunity.filter') }}" method="GET">
                    <div class="row">
                        <div class="col-lg-3 mg-b-20 mg-lg-b-0">
                            <label class="form-label">{{__('route.City')}}</label>
                            <select name="city_id" class="form-control select2" id="city_id">
                                <option value=""> </option>
                                @foreach ($city as $item)
                                    <option value="{{$item->id}}" {{ old('city_id') == $item->id ? 'selected' : '' }}>
                                        {{$item->name_en}} / {{$item->name_ar}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 mg-b-20 mg-lg-b-0">
                            <label class="form-label">{{__('route.scope_work')}}</label>
                            <select name="scope_work_id" class="form-control select2" id="scope_work_id">
                                <option value=""> </option>
                                @foreach ($scope_work as $scopeWork)
                                    <option value="{{$scopeWork->id}}" {{ old('scope_work_id') == $scopeWork->id ? 'selected' : '' }}>
                                        {{$scopeWork->name_en}} / {{$scopeWork->name_ar}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 mg-b-20 mg-lg-b-0">
                            <label class="form-label">{{__('route.job_title')}}</label>
                            <select name="job_title_id" class="form-control select2" id="job_title_id">
                                <option value="">اختر العنوان الوظيفي</option>
                                
                                    <option value="">
                                   
                                    </option>
                              
                            </select>
                        </div>

                        <div class="control-group form-group col-3">
                            <label class="form-label">{{ __('route.rang_salary') }}</label>
                            <select name="rang_salary" class="form-control">
                                <option value=""> </option>
                                @foreach(range(1000, 9000, 1000) as $salary)
                                    <option value="between {{ $salary }} and {{ $salary + 1000 }}">
                                        {{ __('route.between') . " $salary " . __('route.and') . " " . ($salary + 1000) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="control-group form-group col-3">
                            <label class="form-label">{{__('route.career_level')}}</label>
                            <select name="career_level" class="form-control select2">
                                <option value=""> </option>
                                <option value="student">
                                    {{ __('route.student') }}
                                </option>
                                <option value="Junior">
                                    {{ __('route.Junior') }}
                                </option>
                                <option value="senior">
                                    {{ __('route.senior') }}
                                </option>
                                <option value="Manager">
                                    {{ __('route.Manager') }}
                                </option>
                            </select>
                            
                        </div>
                        
                
                        <div class="control-group form-group col-2">
                            <label class="form-label">{{__('route.type_job')}}</label>
                            <select name="type_job" class="form-control select2">
                                <option value=""> </option>
                                <option value="remotely">
                                    {{ __('route.remotely') }}
                                </option>
                                <option value="full_time">
                                    {{ __('route.full_time') }}
                                </option>
                                <option value="hours">
                                    {{ __('route.hours') }}
                                </option>
                            </select>
                            
                        </div>
                
                        <div class="control-group form-group col-2">
                            <label class="form-label">{{__('route.years_experience')}}</label>
                            <select name="years_experience" class="form-control select2">
                                <option value=""> </option>
                                <option value="Does not matter" >
                                    {{__('route.Does not matter')}}
                                </option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }} year" >
                                        {{ $i }} year
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="control-group form-group col-2">
                            <label class="form-label">{{__('route.educational_level')}}</label>
                            <select name="educational_level" class="form-control select2">
                                <option value=""> </option>
                                <option value="diploma"  >
                                    {{__('route.diploma')}}
                                </option>
                                <option value="Doctorate" >
                                    {{__('route.Doctorate')}}
                                </option>
                                <option value="graduate" >
                                    {{__('route.graduate')}}
                                </option>
                                <option value="Master">
                                    {{__('route.Master')}}
                                </option>
                            </select>
                            
                        </div>

                         <div class="control-group form-group col-3">
                                        <label class="form-label">{{__('route.gender')}}</label>
                                        <div style="display: flex; gap: 20px; align-items: center;">
                                            <label class="rdiobox" style="margin-right: 10px;">
                                                <input name="gender" type="radio" value="male" >
                                                <span>{{__('route.male')}}</span>
                                            </label>
                                            <label class="rdiobox">
                                                <input name="gender" type="radio" value="female" >
                                                <span>{{__('route.female')}}</span>
                                            </label>
                                            <label class="rdiobox">
                                                <input name="gender" type="radio" value="Does not matter">
                                                <span>{{__('route.Does not matter')}}</span>
                                            </label>
                                        </div>
                                    </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary my-3">Filter</button>
                </form>
                
               
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
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.Job_Opportunity')}}</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_company')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.scope_work')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.job_title')}}</th>

                                        <th class="wd-15p border-bottom-0"> {{__('route.status')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_opportunitys as $item)
                                        <tr>
                                                <td>{{$item->company->name_company}}</td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select[name="scope_work_id"]').on('change', function(){
                var scopeWorkId = $(this).val();
                if(scopeWorkId) {
                    $.ajax({
                        url: '/get/jobtitle/by/' + scopeWorkId,
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}'  
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data); 
                            if (data.jobtitlebyid) {
                                var jobTitleSelect = $('select[name="job_title_id"]');
                                jobTitleSelect.empty();
                                jobTitleSelect.append('<option value="">اختر العنوان الوظيفي</option>');
                                $.each(data.jobtitlebyid, function(key, value){
                                    console.log(value); 
                                    jobTitleSelect.append('<option value="'+ value.id +'">'+ value.name_en +' / '+ value.name_ar +'</option>');
                                });
                            } else {
                                console.error("الحقل 'jobtitlebyid' غير موجود في الاستجابة");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("حدث خطأ: " + error);
                        }
                    });
                } else {
                    $('select[name="job_title_id"]').empty();
                }
            });
        });
    </script>
   
@endsection