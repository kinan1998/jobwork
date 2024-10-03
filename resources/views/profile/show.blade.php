@extends('index')
@section('content')

<?php 
$lang = app()->getLocale();


$countsubscriptio =  DB::table('subscriptions')->where('company_id', $company_auth->id)->where('status','Acceptable')->count();
$countopportunities = DB::table('job_opportunities')->where('company_id', $company_auth->id)->where('status','Acceptable')->count();

?>

<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('route.Pages')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.Profile')}}</span>
            </div>
        </div>
        
    </div>
    <!-- breadcrumb -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                @if ($company_auth->image)
                                    <img alt="" id="image-preview" src="{{asset($company_auth->image)}}">
                                @else
                                    <img alt="" id="image-preview" src="{{asset('assets/img/faces/6.jpg')}}">

                                @endif
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{$company_auth->first_name}} {{$company_auth->last_name}}</h5>
                                    <p class="main-profile-name-text">{{$company_auth->name_company}} 
                                    </p>
                                </div>
                            </div>
                            <h6>{{$company_auth->job_title}}</h6>
                            <p class="main-profile-name-text">
                                @foreach($company_auth->scopeWorks as $scopeWork)
                                {{ $scopeWork->{'name_' . $lang} }} /
                            @endforeach
                            </p>
                            <!-- main-profile-bio -->
                            
                            <hr class="">
                           
								<div class="card-body p-0">
									<div class="main-content-label tx-13 mg-b-25">
										{{__('route.Conatct')}}
									</div>
									<div class="main-profile-contact-list">
										<div class="media">
											<div class=" media-icon bg-primary-transparent text-primary">
												<i class="icon ion-md-phone-portrait"></i>
											</div>
											<div class="media-body">
												<span>{{__('route.phone')}}</span>
												<div>
													{{$company_auth->phone}}
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-icon bg-secondary-transparent text-secondary">
												<i class="icon ion-md-mail"></i>
											</div>
											<div class="media-body">
												<span>{{__('route.email')}}</span>
												<div>
													{{$company_auth->email}}
												</div>
											</div>
										</div>
										
                                        <div class="media">
											<div class="media-icon bg-warning-transparent text-warning">
												<i class="icon ion-md-compass"></i>
											</div>
											<div class="media-body">
												<span>{{__('route.city')}}</span>
												<div>
                                                    @if (app()->getLocale() == 'en')
                                                        {{$company_auth->city->name_en}}
                                                    @else
                                                        {{$company_auth->city->name_ar}}
                                                        
                                                    @endif
											
												</div>
											</div>
										</div>

										<div class="media">
											<div class="media-icon bg-info-transparent text-info">
												<i class="icon ion-md-locate"></i>
											</div>
											<div class="media-body">
												<span>{{__('route.address')}}</span>
												<div>
													{{$company_auth->address}}
												</div>
											</div>
										</div>
										
									</div>
                                    <!-- main-profile-contact-list -->
								</div>
							
                        </div>
                        <!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row row-sm">
                <div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-primary-transparent">
                                    <i class="icon-layers text-primary"></i>
                                </div>
                                <div class="ml-auto">
                                    <h5 class="tx-13">{{__('route.opportunities')}}</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">{{$countopportunities}}</h2>
                                    <p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>{{__('route.increase')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-danger-transparent">
                                    <i class="icon-paypal text-danger"></i>
                                </div>
                                <div class="ml-auto">
                                    <h5 class="tx-13">{{__('route.subscriptio')}}</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">{{$countsubscriptio}}</h2>
                                    <p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>{{__('route.increase')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-success-transparent">
                                    <i class="icon-rocket text-success"></i>
                                </div>
                                <div class="ml-auto">
                                    <h5 class="tx-13">Product sold</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">1,890</h2>
                                    <p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true"> 
                                    <span class="visible-xs">
                                    <i class="las la-user-circle tx-16 mr-1"></i></span> 
                                    <span class="hidden-xs">{{__('route.My_opportunities')}}</span> 
                                </a>
                            </li>
                            <li class="">
                                <a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 mr-1"></i></span> <span class="hidden-xs">{{__('route.My_subscriptions')}}</span> </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">{{__('route.settings')}}</span> </a>
                            </li>
                        </ul>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            @foreach ($company_auth->JobOpportunity()->orderBy('created_at', 'desc')->get() as $JobOpportunity)
                                <div class="m-t-30">
                                    <h4 class="tx-15 text-uppercase mt-3">{{ $JobOpportunity->scopework->{'name_' . $lang} }}</h4>
                                    <div class=" p-t-10">
                                        <h5 class="text-primary m-b-5 tx-14">{{ $JobOpportunity->jobtitle->{'name_' . $lang} }}</h5>
                                        <p class="">{{ __('route.' . $JobOpportunity->gender) }}  /  {{__('route.age')}} : {{$JobOpportunity->from_age}} {{__('route.between')}} {{$JobOpportunity->to_age}}</p>
                                        <p><b>{{$JobOpportunity->created_at->diffForHumans()}}</b></p>
                                        @if ($JobOpportunity->status == 'In Processing')
                                            <p><b class="text-warning">{{ __('route.' . $JobOpportunity->status) }} </b></p>
                                        
                                        @elseif($JobOpportunity->status == 'Unacceptable')

                                            <p><b class="text-danger">{{ __('route.' . $JobOpportunity->status) }} </b></p>
                                        @else
                                            <p><b class="text-success">{{ __('route.' . $JobOpportunity->status) }} </b></p>

                                        @endif
                                        <div class="card-body cardbody relative">
                                            <div class="cardtitle">
                                               
                                        
                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.years_experience')}}</h6>
                                                    <span class="text-end">{{$JobOpportunity->years_experience}}</span>
                                                </div>
                                        
                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.educational_level')}}</h6>
                                                    <span class="text-end">{{ __('route.' . $JobOpportunity->educational_level) }}</span>
                                                </div>
                                        
                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.career_level')}}</h6>


                                                    <span class="text-end"> {{ __('route.' . $JobOpportunity->career_level) }}</span>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.number_vacancies')}}</h6>
                                                    <span class="text-end"> {{ $JobOpportunity->number_vacancies }}</span>
                                                </div>
        
                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.type_job')}}</h6>
                                                    <span class="text-end">{{ __('route.' .$JobOpportunity->type_job) }}</span>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.job_description')}}</h6>
                                                    <span class="text-end">{!!$JobOpportunity->job_description!!}</span>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.requirements')}}</h6>
                                                    <span class="text-end">{!!$JobOpportunity->requirements!!}</span>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <h6>{{__('route.requirements_for_trainees')}}</h6>
                                                    <span class="text-end">{!!$JobOpportunity->requirements_for_trainees!!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                
                                </div>
                            @endforeach
                            
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="row">
                                @foreach ($company_auth->subscriptions as $subscriptions)
                                <div class="col-sm-4">
                                    <div class="border p-1 card thumb">
                                        <a href="#" class="image-popup" title="Screenshot-2">
                                        </a>
                                        <h4 class="text-center tx-14 mt-3 mb-0">{{__('route.plan')}} : {{$subscriptions->plan->Number_of_opportunities}} {{__('route.opportunities')}}</h4>
                                        <h4 class="text-center tx-14 mt-3 mb-0">{{__('route.remaining_opportunities')}} : {{$subscriptions->remaining_opportunities}}</h4>

                                        <div class="ga-border"></div>
                                        <p class="text-muted text-center">
                                            <small>{{__('route.name')}} : {{$subscriptions->name}}</small>
                                        </p>
                                        <p class="text-muted text-center">
                                            <small>{{__('route.payment_type')}} : {{$subscriptions->payment_type}}</small>
                                        </p>

                                        <p class="text-muted text-center">
                                        @if ($subscriptions->status == 'In Processing')
                                            <small class="text-warning">{{__('route.status')}} : {{__('route.'.$subscriptions->status) }}</small>

                                        @elseif($subscriptions->status == 'Unacceptable')
                                            <small class="text-danger">{{__('route.status')}} : {{__('route.'.$subscriptions->status) }}</small>

                                        @else
                                            <small class="text-success">{{__('route.status')}} : {{__('route.'.$subscriptions->status) }}</small>

                                        @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                             
                               
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <form action="{{route('update.company_auth')}}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="row" >
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="FullName">{{__('route.first_name')}}</label>
                                            <input type="text" value="{{$company_auth->first_name}}" name="first_name" id="first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="FullName">{{__('route.last_name')}}</label>
                                            <input type="text" value="{{$company_auth->last_name}}" name="last_name" id="last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name_company">{{__('route.name_company')}}</label>
                                            <input type="text" name="name_company" value="{{$company_auth->name_company}}" id="Username" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">{{__('route.image')}}: <span class="text-success"> ({{__('route.optional')}})</span> </label>
                                            <input class="form-control" name="image" type="file" accept="image/*" onchange="previewImage(event)">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Email">{{__('route.email')}}</label>
                                            <input type="email" name="email" value="{{$company_auth->email}}" id="Email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone">{{__('route.phone')}}</label>
                                            <input type="number" name="phone" value="{{$company_auth->phone}}" id="Username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Password">{{__('route.Password')}}</label>
                                            <input type="password" name="Password" placeholder="6 - 15 Characters" id="Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="RePassword">{{__('route.Re-Password')}}</label>
                                            <input type="password" name="password_confirmation" placeholder="6 - 15 Characters" id="RePassword" class="form-control">
                                        </div>
                                    </div>
                                   

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="job_title">{{__('route.job_title')}}</label>
                                            <input type="text" name="job_title" value="{{$company_auth->job_title}}" id="Username" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="address">{{__('route.address')}}</label>
                                            <input type="text" name="address" value="{{$company_auth->address}}" id="Username" class="form-control">
                                        </div>
                                    </div>

                                   
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="scope_work">{{__('route.city')}}</label>
                                            <select name="city_id" class="form-control select_2" >
                                                @foreach ($city as $item)
                                                    <option value="{{$item->id}}" 
                                                        {{ (old('city_id') == $item->id || (isset($company_auth) && $company_auth->city_id == $item->id)) ? 'selected' : '' }}>
                                                        {{$item->name_en}} / {{$item->name_ar}}
                                                    </option>
                                                @endforeach

                                            </select> 
                                        </div>
                                    </div>

                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label for="scope_work">{{__('route.scope_work')}}</label>
                                            <select name="scopeWorks_id[]" class="form-control select_2" multiple="multiple">
                                                @foreach ($scopeWorks as $scopeWork)
                                                    <option value="{{$scopeWork->id}}" 
                                                        {{ in_array($scopeWork->id, old('scopeWorks_id', isset($company_auth) ? $company_auth->scopeWorks->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                                        {{$scopeWork->name_en}} / {{$scopeWork->name_ar}}
                                                    </option>
                                                @endforeach

                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
</div>
<!-- Container closed -->
</div>


<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            imagePreview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "";
        }
    }
</script>
@endsection
