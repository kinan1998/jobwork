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
                    <h4 class="content-title mb-0 my-auto">{{__('route.Form')}}</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.show')}} {{__('route.Job_Opportunity')}}</span>
                    {{$jobOpportunity->id}}
                </div>
            </div>
         
        </div>
        <!-- breadcrumb -->
      
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $jobOpportunity->jobTitle->{'name_' . $lang} }}
                                <small class="text-light">{{__('route.in')}} {{ $jobOpportunity->city->{'name_' . $lang}  }}</small></h2>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.name_company')}}:</strong>
                                    <p>{{ $jobOpportunity->company->name_company }}</p>
                                </div>
                                <div class="col-6">
                                    <strong>{{__('route.scope_work')}}:</strong>
                                    <p>{{ $jobOpportunity->scopeWork->{'name_' . $lang}  }}</p>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.gender')}}:</strong>
                                    <p>{{__('route.'. $jobOpportunity->gender )}}</p>
                                </div>
                                <div class="col-6">
                                    <strong>{{__('route.Age Range')}}:</strong>
                                    <p>{{ $jobOpportunity->from_age }} - {{ $jobOpportunity->to_age }} {{__('route.years')}}</p>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.educational_level')}}:</strong>
                                    <p>{{__('route.'. $jobOpportunity->educational_level) }}</p>
                                </div>
                                <div class="col-6">
                                    <strong>{{__('route.career_level')}}:</strong>
                                    <p>{{__('route.'. $jobOpportunity->career_level)}}
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.years_experience')}}:</strong>
                                    <p>{{ $jobOpportunity->years_experience }} </p>
                                </div>
                                <div class="col-6">
                                    <strong>{{__('route.type_job')}}:</strong>
                                    <p>{{__('route.'.$jobOpportunity->type_job )}}</p>
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>{{__('route.number_vacancies')}}:</strong>
                                    <p>{{ $jobOpportunity->number_vacancies }}</p>
                                </div>
                                <div class="col-6">
                                    <strong>{{__('route.rang_salary')}}:</strong>
                                    <p>{{ $jobOpportunity->rang_salary }}</p>
                                </div>
                            </div>
        
                            <div class="mb-3">
                                <strong>{{__('route.address')}}:</strong>
                                <p>{{ $jobOpportunity->address }}</p>
                            </div>
        
                            <div class="mb-3">
                                <strong>{{__('route.status')}}:</strong>
                                <p class="
                                    @if($jobOpportunity->status == 'Acceptable')
                                        text-success
                                    @elseif($jobOpportunity->status == 'Unacceptable')
                                        text-danger
                                    @elseif($jobOpportunity->status == 'In Processing')
                                        bg-warning
                                    @else
                                        text-secondary
                                    @endif
                                ">
                                              
                                    {{ $jobOpportunity->status}}

                                </p>
                            </div>

                            <div class="mb-3">
                                <strong>{{__('route.job_description')}}:</strong>
                                <p>{!! $jobOpportunity->job_description !!}</p>
                            </div>
        
                            <div class="mb-3">
                                <strong>{{__('route.requirements')}}:</strong>
                                <p>{!! $jobOpportunity->requirements !!}</p>
                            </div>
        
                            @if($jobOpportunity->requirements_for_trainees)
                                <div class="mb-3">
                                    <strong>{{__('route.requirements_for_trainees')}}:</strong>
                                    <p>{!! $jobOpportunity->requirements_for_trainees !!}</p>
                                </div>
                            @endif
        
                          
        
                            @if($jobOpportunity->question)
                                <div class="mb-3">
                                    <strong>{{__('route.question')}}:</strong>
                                    <p>{{ $jobOpportunity->question }}</p>
                                </div>
                            @endif
        
                            <p class="text-muted"><small>{{__('route.Posted on')}} {{ $jobOpportunity->created_at->format('M d, Y') }}</small></p>
                        </div>
                    </div>
                    <a href="{{route('Job.Opportunity')}}" class="btn btn-outline-primary btn-block">{{__('route.Back')}}</a>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="row">
                        @foreach ($jobOpportunity->user as $user)
                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="card card-info mb-4">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title mb-0 pb-0">{{$user->first_name}} {{$user->last_name}}</h5>
                                    </div>
                                    <div class="card-body text-info">
                                        {{$user->pivot->text}}
                                    </div>
                                    <div class="card-footer">

                                        @if(isset($user->cv))
                                            <a class="btn btn-sm btn-indigo " href="{{ route('cv.download', $user->cv->id) }}" title="Download CV">
                                            <i class="typcn typcn-folder"></i>
                                            {{__('route.donlowed_Cv')}}
                                            </a>
                                        @endif

                                        <a href="{{route('user.show',$user->id)}}" class="btn btn-info btn-sm" 
                                            title="{{ trans('route.show') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{route('download.CV.job.work',$user->id)}}" class="btn btn-warning btn-sm" 
                                            title="{{ trans('route.show') }}">
                                            <i class="fas fa-file-pdf" aria-hidden="true"></i>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection