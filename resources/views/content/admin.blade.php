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
                
                <h5>{{$auth_InProcessingJobOpportunity}}</h5>
            </div>
            <div>
                <label class="tx-13">{{__('route.Online Opportunities')}}</label>
                <h5>{{$auth_onlineJobOpportunity}}</h5>
            </div>
            


            <div>
                <label class="tx-13">{{__('route.Offline Opportunities')}}</label>
                <h5>{{$auth_offlineJobOpportunity}}</h5>
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
                                



                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$auth_sub}}</h4>
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
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$auth_sub_Unacceptable}}</h4>
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
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$auth_sub_Acceptable}}</h4>
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
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$auth_sub_InProcessing}}</h4>
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
     
       
        
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
       
      
        <div class="col-md-12 col-lg-10 col-xl-10">
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
                            @foreach ($job_user_opportunities = App\Models\JobOpportunityUser::whereHas('jobOpportunity', function($query) {
                                $query->where('company_id', auth()->user()->id);
                            })->latest()->take(5)->get();
                             as $user_opportunities)

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
                                    </td>

                                    <td class="tx-right tx-medium tx-inverse">
                                        {{ $user_opportunities->jobopportunity->type_job }}
                                    </td>

                                    <td class="tx-right tx-medium tx-inverse">
                                        {{ $user_opportunities->jobopportunity->scopework->name_en }}
                                    </td>

                                    <td class="tx-right tx-medium tx-inverse">
                                        {{ $user_opportunities->jobopportunity->jobtitle->name_en }}
                                    </td>
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
            labels: {!! json_encode($auth_months) !!}, 
            datasets: [
                {
                    label: 'Online Job Opportunities',
                    data: {!! json_encode(array_column($auth_jobStats, 'online')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Offline Job Opportunities',
                    data: {!! json_encode(array_column($auth_jobStats, 'offline')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'In Processing Job Opportunities',
                    data: {!! json_encode(array_column($auth_jobStats, 'in_processing')) !!}, 
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