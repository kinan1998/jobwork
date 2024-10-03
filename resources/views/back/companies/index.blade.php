@extends('index')
@section('content')

	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.companies')}}</span>
                </div>
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
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-5p border-bottom-0"> #</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_company')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.full_name')}}</th>
                                        <th class="wd-13p border-bottom-0"> {{__('route.phone')}}</th>
                                        <th class="wd-13p border-bottom-0"> {{__('route.email')}}</th>
                                        <th class="wd-13p border-bottom-0"> {{__('route.scope_work')}}</th>
                                        <th class="wd-13p border-bottom-0"> {{__('route.active')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($companies as $item)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{$i}}</td>
                                            <td>{{$item->name_company}}</td>
                                            <td>{{$item->first_name}} {{$item->last_name}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>
                                                @if($item->scopeWorks->isNotEmpty())
                                                    @foreach($item->scopeWorks as $scopeWork)
                                                        {{ $scopeWork->{'name_' . app()->getLocale()} ?? '' }} -
                                                    @endforeach
                                                @else
                                                    {{ __('route.No associated works') }}
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <div class="checkbox-wrapper-8">
                                                    <input type="checkbox" id="cb3-8" class="tgl tgl-skewed" data-id="{{$item->id}}" {{ $item->active ? 'checked' : '' }}>
                                                    <label for="cb3-8" data-tg-on="ON" data-tg-off="OFF" class="tgl-btn"></label>
                                                </div>
                                            </td>

                                                <td>
                                                    <a href="{{route('companies.show',$item->id)}}" class="btn btn-info btn-sm" 
                                                        title="{{ trans('route.show') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                </td>
                                        </tr>
                                      
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

   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tgl').on('change', function() {
                var companyId = $(this).data('id');
                var active = $(this).is(':checked') ? 1 : 0;
    
                $.ajax({
                    url: '/companies/update-active/'+ companyId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        active: active
                    },
                    success: function(response) {
                      Swal.fire({
                            title: "Good job!",
                            text: "Modified successfully",
                            icon: "success"
                          });
                    },
                    error: function(response) {
                        alert('Failed to update user status!');
                    }
                });
            });
        });
    </script>

@endsection