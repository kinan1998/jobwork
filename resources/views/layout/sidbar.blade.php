<?php
use App\Models\City;
$city =City::count();

$user =App\Models\User::count();
$company =App\Models\Company::count();
?>


<aside class="app-sidebar sidebar-scroll" >
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{url('dashboard')}}"><img src="{{asset('assets/images/logo_2.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{url('dashboard')}}"><img src="{{asset('assets/images/logo_2.png')}}" class="main-logo dark-theme"  style="width: 300%;height: 300%;margin-top: -33%;" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{url('dashboard')}}"><img src="{{asset('assets/images/logo_2.png')}}" class="logo-icon" alt="logo"></a>
    </div>
    
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">

                
        <div class="app-sidebar__user clearfix active">
            <div class="dropdown user-pro-body">
                @if(auth()->guard('company')->user()->image == null)
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="{{asset('assets/img/faces/6.jpg')}}">
                        <span class="avatar-status profile-status bg-green"></span>
                    </div>
                @else
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="{{asset(auth()->guard('company')->user()->image)}}">
                        <span class="avatar-status profile-status bg-green"></span>
                    </div>
                @endif
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->guard('company')->user()->first_name}} {{auth()->guard('company')->user()->last_name}}</h4>
                    <span class="mb-0 text-muted">{{auth()->guard('company')->user()->name_company}} </span>
                </div>
            </div>
        </div>
        @if (auth()->guard('company')->user()->type == 'owner')

            @include('layout.sidebar_owner')
        @else


            @include('layout.sidebar_admin')
        @endif
    </div>
</div>
   
</aside>

</aside>