<!-- Modal effects -->
<div class="modal" id="modaldemo8_edit{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            {{__('route.edit_city')}}
                                @if (app()->getLocale() == 'ar')
                                        {{$item->name_ar}}
                                @else
                                        {{$item->name_en}}
                                @endif
                          
                        </div>
                       
                        <form action="{{route('city.update',$item->id)}}" data-parsley-validate="" method="POST">
                            @csrf
                            <div class="row row-sm">
                                <div class="col-6">
                                    <div class="form-group mg-b-0">
                                        <label class="form-label">{{__('route.name_arabic')}}: <span class="tx-danger">*</span></label>
                                        <input class="form-control" name="name_ar" placeholder="" value="{{$item->name_ar}}"  type="text">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{__('route.name_english')}}: <span class="tx-danger">*</span></label>
                                        <input class="form-control" name="name_en" placeholder="" value="{{$item->name_en}}"  type="text">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary " type="submit">{{__('route.save')}}</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('route.close')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal effects-->