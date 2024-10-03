<!-- Modal effects -->
<div class="modal" id="modaldemo8_edit{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            {{__('route.Edit')}} {{__('route.job_title')}}
                                @if (app()->getLocale() == 'ar')
                                        {{$item->name_ar}}
                                @else
                                        {{$item->name_en}}
                                @endif
                          
                        </div>
                       
                        <form action="{{ route('job_title.update', $item->id) }}" method="POST" data-parsley-validate="">
                            @csrf
                        
                            <div class="row ">
                               
                        
                                <!-- Name Arabic -->
                                <div class="col-6">
                                    <div class="form-group mg-b-0">
                                        <label class="form-label">{{ __('route.name_arabic') }}: <span class="tx-danger">*</span></label>
                                        <input class="form-control" name="name_ar" type="text" placeholder="" value="{{ old('name_ar', $item->name_ar) }}">
                                    </div>
                                </div>
                        
                                <!-- Name English -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('route.name_english') }}: <span class="tx-danger">*</span></label>
                                        <input class="form-control" name="name_en" type="text" placeholder="" value="{{ old('name_en', $item->name_en) }}">
                                    </div>
                                </div>
                        
                                 <!-- Scope Work Dropdown -->
                                 <div class="parsley-select col-lg-12 col-md-12" id="slWrapper"style="width: 100%;">
                                    <div class="form-group">
                                  
                                        <label class="form-label">{{ __('route.scope_work') }}: <span class="tx-danger">*</span></label>
                                        <select name="scope_work_id" class="form-control select2" data-parsley-class-handler="#slWrapper"
                                            data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one" required>
                                            
                                            @foreach ($scopeworks as $scopework)
                                                <option value="{{ $scopework->id }}" {{ old('scope_work_id', $item->scope_work_id) == $scopework->id ? 'selected' : '' }}>
                                                    {{ $scopework->name_en }} / {{ $scopework->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                                <!-- Buttons -->
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="submit">{{ __('route.save') }}</button>
                                    <button class="btn ripple btn-secondary" type="button" data-dismiss="modal">{{ __('route.close') }}</button>
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