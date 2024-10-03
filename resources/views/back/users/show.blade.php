@extends('index')
@section('content')


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

    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                @if ($user->image == null)
                                    <img alt="" src="{{asset('assets/img/faces/6.jpg')}}">
                                @else
                                    <img alt="" src="{{asset($user->image)}}">
                                @endif

                                

                            </div>
                         
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{$user->first_name}} 
                                        {{$user->last_name}}</h5>
                                    <h4 class="main-profile-name">
                                    {{ isset($user->scopework->{'name_' . app()->getLocale()}) ? $user->scopework->{'name_' . app()->getLocale()} : '' }}
                                        
                                    </h4>
                                </div>
                            </div>
                            <h3 class="text-start">
                                    {{ isset($user->jobtitle->{'name_' . app()->getLocale()}) ? $user->jobtitle->{'name_' . app()->getLocale()} : '' }}
                            </h3 >
                            <h6>{{__('route.description')}}</h6>
                            <div class="main-profile-bio">
                                @if($user && $user->userdetails)
                                    {{$user->userdetails->description}}
                                @else
                                @endif
                            </div>

                            
                                <div class="d-flex justify-content-between">
                                    @if(isset($user->cv))
                                        <a class="btn btn-sm btn-indigo " href="{{ route('cv.download', $user->cv->id) }}" title="Download CV">
                                            <i class="typcn typcn-folder"></i>
                                            {{__('route.donlowed_Cv')}}
                                        </a>
                                    @endif
                                    
                                    <a href="{{route('download.CV.job.work',$user->id)}}" class="btn btn-warning btn-sm" 
                                        title="{{ trans('route.show') }}">
                                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
        
                                    </a>
                                </div>            
                         
    

                            <hr class="mg-y-30">
                            <label class="main-content-label tx-13 mg-b-20">{{__('route.Social')}}</label>
                            <div class="main-profile-social-list">
                                @foreach ($user->businessgallery as $businessgallery)
                                    @if ($businessgallery->name == 'facebook')
                                    
                                        <div class="media">
                                            <div class="media-icon bg-info-transparent text-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="currentColor" d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131c.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/></svg>
                                            </div>
                                            <div class="media-body">
                                                <span>{{$businessgallery->name }}</span>
                                                 <a href="{{$businessgallery->link}}">facebook.com</a>
                                            </div>
                                        </div>


                                    @elseif ($businessgallery->name == 'github')

                                        <div class="media">
                                            <div class="media-icon bg-primary-transparent text-primary">
                                                <i class="icon ion-logo-github"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>{{$businessgallery->name }}</span> <a href="{{$businessgallery->link}}">github.com</a>
                                            </div>
                                        </div>

                                    @elseif ( $businessgallery->name == 'twitter')

                                        <div class="media">
                                            <div class="media-icon bg-success-transparent text-success">
                                                <i class="icon ion-logo-twitter"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>{{$businessgallery->name }}</span> <a href="{{$businessgallery->link}}">twitter.com</a>
                                            </div>
                                        </div>

                                    @elseif ( $businessgallery->name == 'linkedin')

                                        <div class="media">
                                            <div class="media-icon bg-info-transparent text-info">
                                                <i class="icon ion-logo-linkedin"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>{{$businessgallery->name }}</span> <a href="{{$businessgallery->link}}">linkedin.com</a>
                                            </div>
                                        </div>

                                    @elseif ($businessgallery->name == 'instagram')

                                        <div class="media">
                                            <div class="media-icon bg-danger-transparent text-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="currentColor" d="M349.33 69.33a93.62 93.62 0 0 1 93.34 93.34v186.66a93.62 93.62 0 0 1-93.34 93.34H162.67a93.62 93.62 0 0 1-93.34-93.34V162.67a93.62 93.62 0 0 1 93.34-93.34zm0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32"/><path fill="currentColor" d="M377.33 162.67a28 28 0 1 1 28-28a27.94 27.94 0 0 1-28 28M256 181.33A74.67 74.67 0 1 1 181.33 256A74.75 74.75 0 0 1 256 181.33m0-37.33a112 112 0 1 0 112 112a112 112 0 0 0-112-112"/></svg>
                                            </div>
                                            <div class="media-body">
                                                <span>{{$businessgallery->name }}</span> <a href="{{$businessgallery->link}}">instagram.com</a>
                                            </div>
                                        </div>

                                    @elseif ($businessgallery->name == 'My Portfolio')

                                        <div class="media">
                                            <div class="media-icon bg-danger-transparent text-danger">
                                                <i class="icon ion-md-link"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>{{$businessgallery->name}}</span> <a href="{{$businessgallery->link}}">Portfolio.com</a>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                              
                            </div>

                            <hr class="mg-y-30">
                            <h6>{{__('route.languages')}}</h6>

                            @foreach ($user->language as $language)
                                <div class="skill-bar mb-4 clearfix mt-3">
                                    <span>{{ $language->name }}</span>
                                    <div class="main-star">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if($i <= $language->rang)
                                                <i class="typcn typcn-star active"></i>
                                            @else
                                                <i class="typcn typcn-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        
                            <hr class="mg-y-30">
                            <h6>{{__('route.skill')}}</h6>

                            @foreach ($user->skill as $skill)
                            <div class="skill-bar clearfix d-flex align-items-center mb-3">
                                <h3 class="mb-0">{{ $skill->name }} :  </h3>
                                <h4 class="ms-5 p-2">{{ $skill->Level }}</h4>
                            </div>
                        @endforeach
                        
                           
                            
                        </div>
                        <!-- main-profile-overview -->
                    </div>
                    
                </div>

            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label tx-13 mg-b-25">
                        {{__('route.Conatct')}}
                    </div>
                    <div class="main-profile-contact-list">
                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>{{__('route.phone')}}</span>
                                <div>
                                    <a href="whatsapp://send?abid={{$user->phone}}&text=مرحبا%2C%!">
                                        {{$user->phone}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-success-transparent text-success">
                                <i class="icon ion-md-mail"></i>
                            </div>
                            <div class="media-body">
                                <span>{{__('route.email')}}</span>
                                <div>
                                    <a href="mailto:{{$user->email}}">
                                        {{$user->email}}
                                    </a>
                                    
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
                                        {{$user->city->name_en}}
                                    @else
                                        {{$user->city->name_ar}}
                                        
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
                                    {{$user->address}}
                                </div>
                            </div>
                        </div>
                       
                       
                    </div>
                    <!-- main-profile-contact-list -->
                </div>
            </div>

        </div>
        <div class="col-lg-8">
           
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">{{__('route.experiences')}}</span> </a>
                            </li>
                            <li class="">
                                <a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 mr-1"></i></span> <span class="hidden-xs">{{__('route.certificates')}}</span> </a>
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
                            <div class="m-t-30">
                                {{-- <h4 class="tx-15 text-uppercase mt-3 my-3">{{__('route.experiences')}}</h4> --}}
                                
                                @foreach ($user->experience as $experience)
                                    <div class=" p-t-10">
                                        <h5 class="text-primary m-b-5 tx-14">
                                            {{ $experience->jobtitle->{'name_' . app()->getLocale()} }}
                                        </h5>
                                        <p class="">{{$experience->name_company}}</p>
                                        <p><b>{{$experience->from_date}}-{{$experience->to_date}}</b></p>
                                        <p class="m-b-5">{{$experience->text}}</p>
                                    </div>

                                    <hr>
                                @endforeach
                                
                              
                            </div>
                        </div>

                        <div class="tab-pane" id="profile">
                            <div class="row">
                                @foreach ($user->certificate as $certificate)
                                <div class="col-sm-4">
                                    <div class="border p-1 card thumb">
                                        <a href="#" class="image-popup" title="Screenshot-2"> <img src="{{asset($certificate->image)}}" class="thumb-img" alt="work-thumbnail"> </a>
                                        <h4 class="text-center tx-14 mt-3 mb-0">{{$certificate->certificate_name}}</h4>
                                        <div class="ga-border"></div>
                                        <p class="text-muted text-center"><small>{{$certificate->certificate_type}}</small></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane" id="settings">
                            <form role="form" method="POST" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="FullName">{{__('route.first_name')}}</label>
                                        <input type="text" name="first_name" value="{{$user->first_name}}" id="FullName" class="form-control">
                                    </div>
    
                                    <div class="form-group col-6">
                                        <label for="FullName">{{__('route.last_name')}}</label>
                                        <input type="text" name="last_name" value="{{$user->last_name}}" id="FullName" class="form-control">
                                    </div>
                                </div>

                               <div class="row">
                                    <div class="form-group col-6">
                                        <label for="Email">{{__('route.email')}}</label>
                                        <input type="email" name="email" value="{{$user->email}}" id="Email" class="form-control">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="Username">{{__('route.phone')}}</label>
                                        <input type="text" value="{{$user->phone}}" name="phone" id="phone" class="form-control">
                                    </div>
                               </div>

                             
                               <div class="row">

                                    <div class="form-group col-6">
                                        <label for="Password">{{__('route.Password')}}</label>
                                        <input type="password" placeholder="6 - 15 Characters" id="Password" name="Password" class="form-control">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="RePassword">{{__('route.Re-Password')}}</label>
                                        <input type="password" placeholder="6 - 15 Characters" id="RePassword" name="password_confirmation" class="form-control">
                                    </div>

                               </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mg-b-10">{{__('route.gender')}}</p>
                                        <select class="form-control" name="gender">
                                            <option value="{{ __('route.male') }}" 
                                                {{ $user->gender == __('route.male') ? 'selected' : '' }}>
                                                {{ __('route.male') }}
                                            </option>
                                            <option value="{{ __('route.female') }}" 
                                                {{ $user->gender == __('route.female') ? 'selected' : '' }}>
                                                {{ __('route.female') }}
                                            </option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-lg-6">
                                        <p class="mg-b-10">{{__('route.nationality')}}</p>
                                        <select class="form-control" name="nationality">
                                            <option value="{{ __('route.Syrian') }}" 
                                                {{ $user->nationality == __('route.Syrian') ? 'selected' : '' }}>
                                                {{ __('route.Syrian') }}
                                            </option>
                                            <option value="{{ __('route.Arabic') }}" 
                                                {{ $user->nationality == __('route.Arabic') ? 'selected' : '' }}>
                                                {{ __('route.Arabic') }}
                                            </option>
                                            <option value="{{ __('route.Non-Arabic') }}" 
                                                {{ $user->nationality == __('route.Non-Arabic') ? 'selected' : '' }}>
                                                {{ __('route.Non-Arabic') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row my-2">

                                    <div class="form-group col-6">
                                        <label for="Password">{{__('route.birthday')}}</label>
                                        <input class="form-control fc-datepicker" placeholder="MM-DD-YYYY" value="{{$user->birthday}}" id="birthday" name="birthday" type="date">

                                    </div>

                                    <div class="form-group col-6">
                                        <label for="RePassword">{{__('route.one-city')}}</label>
                                        <select class="form-control" name="city_id">
                                        @foreach ($city as $item)
                                            <option value="{{ $item->id }}" 
                                                {{ $item->id == $selectedCityId ? 'selected' : '' }}>
                                                {{ $item->{'name_' . app()->getLocale()} }}
                                            </option>
                                        @endforeach
                                        
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="AboutMe">{{__('route.address')}}</label>
                                    <textarea id="AboutMe" name="address" class="form-control">{{$user->address}}</textarea>
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">{{__('route.save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mg-md-t-0">
                    <div class="card">
                        <div class="card-header tx-medium bd-0 tx-white bg-primary">
                            {{__('route.userdetails')}}
                        </div>

                        <div class="card item-card">
                            <div class="card-body pb-0 h-100">
                                
                                <div class="card-body cardbody relative">
                                    <div class="cardtitle">
                                        <div class="d-flex justify-content-between">
                                            <h6>{{__('route.rang_salary')}}</h6>
                                            <span class="text-end">{{isset($user->userdetails->rang_salary ) ?$user->userdetails->rang_salary : ''}}</span>
                                        </div>
                                
                                        <div class="d-flex justify-content-between">
                                            <h6>{{__('route.status_employee')}}</h6>
                                            <span class="text-end">{{isset($user->userdetails->status_employee ) ?$user->userdetails->status_employee : ''}}</span>
                                        </div>
                                
                                        <div class="d-flex justify-content-between">
                                            <h6>{{__('route.years_experience')}}</h6>



                                            <span class="text-end">{{isset($user->userdetails->years_experience) ? $user->userdetails->years_experience : ''}}</span>
                                        </div>
                                
                                        <div class="d-flex justify-content-between">
                                            <h6>{{__('route.educational_level')}}</h6>
                                            <span class="text-end">{{isset($user->userdetails->educational_level)? $user->userdetails->educational_level : '' }}</span>
                                        </div>
                                
                                        <div class="d-flex justify-content-between">
                                            <h6>{{__('route.career_level')}}</h6>
                                            <span class="text-end">{{isset($user->userdetails->career_level)? $user->userdetails->career_level : '' }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <h6>{{__('route.type_job')}}</h6>
                                            <span class="text-end">{{isset($user->userdetails->type_job)? $user->userdetails->type_job : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                         
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
</div>

@endsection