<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>

		<!-- Title -->
		<title> Register  </title>

		<!--- Favicon --->
		@include('layout.css')






	</head>
	<body class="main-body dark-theme">

		<!-- Loader -->
		
		<!-- /Loader -->

		<!-- Page -->
		<div class="page">

			<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-5 col-lg-5 col-xl-5 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="{{asset('assets/images/logo_2.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
							</div>
						</div>
					</div>
					<!-- The content half -->
					<div class="col-md-7 col-lg-7 col-xl-7">
						<div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
							<div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex"> 
                                                <a href="javascript:void(0);">
                                                	<img src="{{asset('assets/images/logo_2.png')}}" class="sign-favicon ht-70" alt="logo">
                                                </a>
												<h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Job<span>Wor</span>k</h1>

                                            </div>
											<div class="main-signup-header" style="margin-top: -9%;">
												<h2 class="text-primary">{{__('route.Get Started')}}</h2>
												<h5 class="font-weight-normal mb-4">{{__('route.only takes a minute')}}.</h5>
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
													<div class="app-sidebar__user clearfix active" style="margin-top: -9%;">
														<div class="dropdown user-pro-body">
															<div class="">
																<img id="image-preview" alt="" class="avatar avatar-xl brround mCS_img_loaded" src="">
															</div>
														</div>
													</div>
                                                <form style="margin-top: -9%;" action="{{route('Register.form')}}" method="POST" enctype="multipart/form-data" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
													@csrf

                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label>{{__('route.name_company')}}</label> 
                                                            <input  class="form-control" name="name_company" value="{{old('name_company')}}" placeholder="{{__('route.Enter your')}} {{__('route.name_company')}}" type="text">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>{{__('route.first_name')}}</label> 
                                                            <input class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="{{__('route.Enter your')}} {{__('route.first_name')}}" type="text">
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label>{{__('route.last_name')}}</label> 
                                                            <input class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="{{__('route.Enter your')}} {{__('route.last_name')}}" type="text">
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label>{{__('route.email')}} </label> 
                                                            <input class="form-control" name="email" value="{{old('email')}}" placeholder="{{__('route.Enter your')}} {{__('route.email')}} @ ." type="email">
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label>{{__('route.phone')}}</label> 
                                                            <input class="form-control" name="phone" value="{{old('phone')}}" placeholder="{{__('route.Enter your')}} {{__('route.phone')}} 0900000000" type="text">
                                                        </div>


                                                        

                                                        <div class="form-group col-6">
                                                            <label>{{__('route.Password')}} </label> 
                                                            <input class="form-control" name="password" value="{{old('password')}}" placeholder="{{__('route.Enter your')}} {{__('route.Password')}}" type="password">
                                                        </div>


                                                        <div class="form-group col-6">
                                                            <label>{{__('route.Re-Password')}} </label> 
                                                            <input class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}"  placeholder="{{__('route.Enter your')}} {{__('route.Re-Password')}}" type="password">
                                                        </div>


                                                        <div class="form-group col-6">
                                                            <label>{{__('route.job_title')}} </label> 
                                                            <input class="form-control" name="job_title" value="{{old('job_title')}}"  placeholder="{{__('route.Enter your')}} {{__('route.job_title_HR_OWNER')}}" type="text">
                                                        </div>

														<div class="col-6">
															<div class="form-group">
																<label class="form-label">{{__('route.image')}}: <span class="text-success"> ({{__('route.optional')}})</span> </label>
																<input class="form-control" name="image" type="file" accept="image/*" onchange="previewImage(event)">
															</div>
														</div>

                                                        <div class="col-lg-6 col-md-6" >
                                                            <label>{{__('route.City')}} </label> 
                                                            <select name="city_id" class="form-control "  required="">
                                                                <option label="Choose one">
                                                                </option>
                                                                @foreach ($city as $item)
                                                                    <option value="{{ $item->id }}" {{ old('city_id') == $item->id ? 'selected' : '' }}>
                                                                        {{$item->name_en}} / {{$item->name_ar}}
                                                                    </option>
                                                                @endforeach
                                                            
                                                            </select>
                                                       
                                                        </div>

														<div class="form-group col-6">
                                                            <label>{{__('route.address')}}  </label><span class="text-success"> ({{__('route.optional')}})</span> 
                                                            <input class="form-control" name="address" value="address" placeholder="{{__('route.Enter your')}} {{__('route.address')}}" type="text">
                                                        </div>

														<div class="col-lg-12 mg-b-20 mg-lg-b-0">
															<p class="mg-b-10">{{__('route.scope_work')}}</p>

															<select name="scopeWorks_id[]" class="form-control select2" multiple="multiple">
																
																@foreach ($scopeWorks as $scopeWork)
																	
																
																	<option  value="{{$scopeWork->id}}">
																		{{$scopeWork ->name_en}} / {{$scopeWork ->name_ar}}
																	</option>
																@endforeach
															</select>
														</div>
                                                    </div>
													


                                                    <button class="btn btn-main-primary btn-block my-4" type="submit">{{__('route.Create Account')}}</button>
												
												</form>
												<div class="main-signup-footer mt-5">
													<p>{{__('route.Already have an account')}}? <a href="{{route('login')}}">{{__('route.Sign In')}}</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>

		</div>
		<!-- End Page -->

		{{-- <!--- JQuery min js --->
		<script src="../../assets/plugins/jquery/jquery.min.js"></script>

		<!--- Bootstrap Bundle js --->
		<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!--- Ionicons js --->
		<script src="../../assets/plugins/ionicons/ionicons.js"></script>

		<!--- JQuery sparkline js --->
		<script src="../../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>


		<!--- Moment js --->
		<script src="../../assets/plugins/moment/moment.js"></script>

		<!--- Eva-icons js --->
		<script src="../../assets/js/eva-icons.min.js"></script>

		<!--- Rating js --->
		<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="../../assets/plugins/rating/jquery.barrating.js"></script>

		<!--- Custom js --->
		<script src="../../assets/js/custom.js"></script> --}}
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

		@include('layout.js')

	</body>
</html>