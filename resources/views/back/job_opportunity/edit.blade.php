@extends('index')
@section('content')




	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Form')}}</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.Edit')}} {{__('route.Job_Opportunity')}}</span>
                    {{$jobOpportunity->id}}
                </div>
            </div>
         
        </div>
        <!-- breadcrumb -->

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('job_opportunity.update',$jobOpportunity->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="row">
                        
                            <div class="col-lg-6 mg-b-20 mg-lg-b-0">
                                <label class="form-label">{{__('route.scope_work')}}</label>
                                <select name="scope_work_id" class="form-control select2" id="scope_work_id">
                                    <option value=""> </option>
                                    @foreach ($scopeWorks as $scopeWork)
                                        <option value="{{$scopeWork->id}}" {{ old('scope_work_id', $jobOpportunity->scope_work_id) == $scopeWork->id ? 'selected' : '' }}>
                                            {{$scopeWork->name_en}} / {{$scopeWork->name_ar}}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            
                            <div class="col-lg-6 mg-b-20 mg-lg-b-0">
                                <label class="form-label">{{__('route.job_title')}}</label>
                                <select name="job_title_id" class="form-control select2" id="job_title_id">
                                    <option value="">اختر العنوان الوظيفي</option>
                                    <!-- إضافة العناوين الوظيفية هنا -->
                                    <option value=""> </option>
                                </select>
                            </div>
                            
                            <div class="control-group form-group col-6">
                                <label class="form-label">{{__('route.gender')}}</label>
                                <div style="display: flex; gap: 20px; align-items: center;">
                                    <label class="rdiobox" style="margin-right: 10px;">
                                        <input name="gender" type="radio" value="male" {{ $jobOpportunity->gender == 'male' ? 'checked' : '' }}>
                                        <span>{{__('route.male')}}</span>
                                    </label>
                                    <label class="rdiobox">
                                        <input name="gender" type="radio" value="female" {{ $jobOpportunity->gender == 'female' ? 'checked' : '' }}>
                                        <span>{{__('route.female')}}</span>
                                    </label>
                                    <label class="rdiobox">
                                        <input name="gender" type="radio" value="Does not matter" {{ $jobOpportunity->gender == 'Does not matter' ? 'checked' : '' }}>
                                        <span>{{__('route.Does not matter')}}</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 mg-b-20 mg-lg-b-0">
                                <label class="form-label">{{__('route.City')}}</label>
                                <select name="city_id" class="form-control select2" id="city_id">
                                    <option value=""> </option>
                                    @foreach ($city as $item)
                                        <option value="{{ $item->id }}" {{ old('city_id', $jobOpportunity->city_id) == $item->id ? 'selected' : '' }}>
                                            {{$item->name_en}} / {{$item->name_ar}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div class="control-group form-group col-3">
                                <label class="form-label">{{__('route.from_age')}} <span class="text-success">( {{__('route.optional')}} )</span> </label>
                                <input type="number" class="form-control" name="from_age" value="{{ $jobOpportunity->from_age }}" placeholder="20" min="10" max="100">
                            </div>
                            
                            <div class="control-group form-group col-3">
                                <label class="form-label">{{__('route.to_age')}} <span class="text-success">( {{__('route.optional')}} )</span></label>
                                <input type="number" class="form-control" name="to_age" value="{{ $jobOpportunity->to_age }}" placeholder="50" min="10" max="100">
                            </div>
                            
                            <div class="control-group form-group col-6">
                                <label class="form-label">{{__('route.educational_level')}}</label>
                                <select name="educational_level" class="form-control select2">
                                    <option value=""> </option>
                                    <option value="diploma" {{ $jobOpportunity->educational_level == 'diploma' ? 'selected' : '' }}>
                                        {{__('route.diploma')}}
                                    </option>
                                    <option value="Doctorate" {{ $jobOpportunity->educational_level == 'Doctorate' ? 'selected' : '' }}>
                                        {{__('route.Doctorate')}}
                                    </option>
                                    <option value="graduate" {{ $jobOpportunity->educational_level == 'graduate' ? 'selected' : '' }}>
                                        {{__('route.graduate')}}
                                    </option>
                                    <option value="Master" {{ $jobOpportunity->educational_level == 'Master' ? 'selected' : '' }}>
                                        {{__('route.Master')}}
                                    </option>
                                </select>
                            </div>
                            
                            <div class="control-group form-group col-6">
                                <label class="form-label">{{__('route.career_level')}}</label>
                                <select name="career_level" class="form-control select2">
                                    <option value=""> </option>
                                    <option value="student" {{ $jobOpportunity->career_level == 'student' ? 'selected' : '' }}>
                                        {{ __('route.student') }}
                                    </option>
                                    <option value="Junior" {{ $jobOpportunity->career_level == 'Junior' ? 'selected' : '' }}>
                                        {{ __('route.Junior') }}
                                    </option>
                                    <option value="senior" {{ $jobOpportunity->career_level == 'senior' ? 'selected' : '' }}>
                                        {{ __('route.senior') }}
                                    </option>
                                    <option value="Manager" {{ $jobOpportunity->career_level == 'Manager' ? 'selected' : '' }}>
                                        {{ __('route.Manager') }}
                                    </option>
                                </select>
                            </div>
                    
                            <div class="control-group form-group col-6">
                                <label class="form-label">{{__('route.type_job')}}</label>
                                <select name="type_job" class="form-control select2">
                                    <option value=""> </option>
                                    <option value="remotely" {{ $jobOpportunity->type_job == 'remotely' ? 'selected' : '' }}>
                                        {{ __('route.remotely') }}
                                    </option>
                                    <option value="full_time" {{ $jobOpportunity->type_job == 'full_time' ? 'selected' : '' }}>
                                        {{ __('route.full_time') }}
                                    </option>
                                    <option value="hours" {{ $jobOpportunity->type_job == 'hours' ? 'selected' : '' }}>
                                        {{ __('route.hours') }}
                                    </option>
                                </select>
                            </div>
                            
                            <div class="control-group form-group col-6">
                                <label class="form-label">{{__('route.years_experience')}}</label>
                                <select name="years_experience" class="form-control select2">
                                    <option value=""> </option>
                                    <option value="Does not matter" {{ $jobOpportunity->years_experience == __('route.Does not matter') ? 'selected' : '' }}>
                                        {{__('route.Does not matter')}}
                                    </option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }} year" {{ $jobOpportunity->years_experience == "$i year" ? 'selected' : '' }}>
                                            {{ $i }} year
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="control-group form-group mb-0 col-6">
                                <label class="form-label">{{__('route.number_vacancies')}}</label>
                                <input type="number" name="number_vacancies" class="form-control required" min="1" max="10" value="{{ $jobOpportunity->number_vacancies }}" placeholder="Number of Vacancies">
                            </div>
                            
                            <div class="control-group form-group col-6">
                                <label class="form-label">{{__('route.rang_salary')}}</label>
                                <select name="rang_salary" class="form-control">
                                    <option value=""> </option>
                                    @foreach(range(1000, 9000, 1000) as $salary)
                                        <option value="{{ __('route.between') . " $salary " . __('route.and') . " " . ($salary + 1000) }}" {{ $jobOpportunity->rang_salary == __('route.between') . " $salary " . __('route.and') . " " . ($salary + 1000) ? 'selected' : '' }}>
                                            {{ __('route.between') . " $salary " . __('route.and') . " " . ($salary + 1000) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="control-group form-group mb-0 col-6">
                                <label class="form-label">{{__('route.address')}} <span class="text-success">( {{__('route.optional')}} )</span></label>
                                <div class="form-group">
                                    <input type="text" name="address" value="{{ $jobOpportunity->address }}" class="form-control required " placeholder="Address">
                                </div>
                            </div>
                            
                    
                            <div class="control-group form-group mb-0 col-6">
                                <label class="form-label">{{__('route.filter')}} <span class="text-success">( {{__('route.optional')}} )</span></label>
                                <div class="form-group">
                                    <input type="checkbox" name="filter" value="1" class="form-control " placeholder="Address" id="filter-checkbox" {{ $jobOpportunity->filter ? 'checked' : '' }}>
                                </div>
                            </div>
                    
                            <div class="control-group form-group mb-0 col-6">
                                <label class="form-label">{{__('route.question')}} <span class="text-success">( {{__('route.optional')}} )</span></label>
                                <div class="form-group">
                                    <input type="text" name="question" value="{{ $jobOpportunity->question }}" class="form-control required " placeholder="question">
                                </div>
                            </div>
                           
                    
                           
                            <div class="control-group form-group mb-0 col-12">
                                <h4 class="form-label">{{__('route.job_description')}} </h4> 
                                <div class="form-group">
                                    <textarea name="job_description" id="editor" cols="30" rows="10">{{ $jobOpportunity->job_description }}</textarea>
                                </div>
                            </div>
                    
                            <div class="control-group form-group mb-0 col-12">
                                <h4 class="form-label">{{__('route.requirements')}} </h4> 
                                <div class="form-group">
                                    <textarea name="requirements" id="editor" cols="30" rows="10">{{ $jobOpportunity->requirements }}</textarea>
                                </div>
                            </div>
                    
                            <div class="control-group form-group mb-0 col-12">
                                <h4 class="form-label">{{__('route.requirements_for_trainees')}} <span class="text-success">{{__('route.optional')}}</span></h4> 
                                <div class="form-group">
                                    <textarea name="requirements_for_trainees" id="editor" cols="30" rows="10">{{ $jobOpportunity->requirements_for_trainees }}</textarea>
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary " type="submit">{{__('route.save')}}</button>
                        </div>
                    </form>
                    
                          
                            
                  
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
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
    
    <script>
        const checkbox = document.getElementById('filter-checkbox');
        checkbox.addEventListener('change', function() {
            this.value = this.checked ? 1 : 0;
        });
    </script>


    
    

@endsection