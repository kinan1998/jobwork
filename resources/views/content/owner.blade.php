<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
              <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{__('route.Hi, welcome back!')}}</h2>
              <p class="mg-b-0">{{auth()->user()->first_name}} {{auth()->user()->last_name}}.</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">{{__('route.Pending Opportunities')}}</label>
                
                <h5>{{$InProcessingJobOpportunity}}</h5>
            </div>
            <div>
                <label class="tx-13">{{__('route.Online Opportunities')}}</label>
                <h5>{{$onlineJobOpportunity}}</h5>
            </div>
            <div>
                <label class="tx-13">{{__('route.Offline Opportunities')}}</label>
                <h5>{{$offlineJobOpportunity}}</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- row -->
    <div class="row row-sm">

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{__('route.total_Subscriptions')}}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$sub}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">{{__('route.total_Subscriptions')}}</p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                             
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{__('route.Unacceptable subscriptions')}}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$sub_Unacceptable}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">{{__('route.Unacceptable subscriptions')}}</p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                               
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{__('route.acceptable subscriptions')}}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$sub_Acceptable}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">{{__('route.acceptable subscriptions')}}</p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{__('route.Pending subscriptions')}}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$sub_InProcessing}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">{{__('route.Pending subscriptions')}}</p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>

    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-8">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0"> {{__('route.status')}} {{__('route.Job_Opportunity')}}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                      <canvas id="myChart" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
     
        <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">{{__('route.Number of opportunities per city')}}</h6>
                <div class="list-group">
                    @foreach ($cities as $city)
                        <div class="list-group-item border-top-0">
                            <p>{{ $city->name_en }} / {{$city->name_ar}}</p><span>{{ $city->jobs_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="">
              
    
    
                @php
                    $max_total = max($company_total, $user_total);
                
                    $company_percentage = $max_total != 0 ? ($company_total / $max_total) * 100 : 0;
                    $user_percentage = $max_total != 0 ? ($user_total / $max_total) * 100 : 0;
                @endphp
    
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">{{__('route.Active Companies')}}</p>
                                </div>
                                <h4 class="font-weight-bold mb-2">{{$company_total}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient" role="progressbar" 
                                        style="width: {{ $company_percentage }}%;" 
                                        aria-valuenow="{{ $company_percentage }}" aria-valuemin="0" 
                                        aria-valuemax="100">
                                    </div>
    
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">{{__('route.Active Users')}}</p>
                                </div>
                                <h4 class="font-weight-bold mb-2">{{$user_total}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient" role="progressbar" 
                                        style="width: {{ $user_percentage }}%;" 
                                        aria-valuenow="{{ $user_percentage }}" aria-valuemin="0" 
                                        aria-valuemax="100">
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

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">{{__('route.companies')}}</h3>
                </div>

                <div class="card-body p-0 customers mt-1">
                    <div class="list-group list-lg-group list-group-flush">
                        @foreach ($companies = App\Models\Company::latest()->take(5)->get() as $company)
                            
                     
                            <div class="list-group-item list-group-item-action" href="{{route('companies.show',$company->id)}}">
                                <div class="media mt-0">
                                    @if ($company->image)
                                    <img class="avatar-lg rounded-circle mr-3 my-auto" src="{{asset($company->image)}}" alt="Image description">

                                
                                    @else
                                        <img class="avatar-lg rounded-circle mr-3 my-auto" src="{{asset('assets/img/faces/3.jpg')}}" alt="Image description">

                                    @endif

                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <div class="mt-0">
                                                <h5 class="mb-1 tx-15">{{$company->name_company}}</h5>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
      
        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">{{__('route.Users applying for vacancies')}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">{{__('route.date')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('route.full_name')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('route.type_job')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('route.scope_work')}}</th>
                                <th class="wd-lg-25p tx-right">{{__('route.job_title')}}</th>
                                {{-- <th class="wd-lg-25p tx-right">Tax Witheld</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($job_user_opportunities = App\Models\JobOpportunityUser::latest()->take(5)->get()   as $user_opportunities)

                            <tr>
                                
                                <td>
                                    @if($user_opportunities->created_at)
                                    {{ $user_opportunities->created_at->format('d M Y') }}
                                    @else
                                        N/A 
                                    @endif
                                </td>

                                <td class="tx-right tx-medium tx-inverse">
                                    <a href="{{ route('user.show', $user_opportunities->user->id) }}">
                                        {{ $user_opportunities->user->first_name }} {{ $user_opportunities->user->last_name }}
                                    </a>
                                </td>                                <td class="tx-right tx-medium tx-inverse"> {{$user_opportunities->jobopportunity->type_job}}</td>
                                <td class="tx-right tx-medium tx-inverse"> {{$user_opportunities->jobopportunity->scopework->name_en}}</td>
                                <td class="tx-right tx-medium tx-inverse"> {{$user_opportunities->jobopportunity->jobtitle->name_en}}</td>

                                {{-- <td class="tx-right tx-medium tx-danger">-$45.10</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
       
    </div>
    <!-- row close -->


</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!}, 
            datasets: [
                {
                    label: 'Online Job Opportunities',
                    data: {!! json_encode(array_column($jobStats, 'online')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Offline Job Opportunities',
                    data: {!! json_encode(array_column($jobStats, 'offline')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'In Processing Job Opportunities',
                    data: {!! json_encode(array_column($jobStats, 'in_processing')) !!}, 
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Job Opportunities Statistics by Month'
                },
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                },
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stacked: true
                },
                x: {
                    stacked: true
                }
            }
        }
    });
</script>