<div class="modal" id="modaldemo8_edit{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            {{$item->plan->Number_of_opportunities}}
                            {{__('route.opportunities')}}
                        
                        </div>
                    
                        <form action="{{route('subscriptio.update.admin',$item->id)}}" data-parsley-validate="" method="POST">
                            @csrf
                            <div class="row row-sm">
                                <div class="col-6">

                                    <div class="form-group mg-b-0">
                                        <label class="form-label">{{__('route.name')}}: <span class="tx-danger">*</span></label>
                                        <input class="form-control" name="name" placeholder="Mr .{{__('route.name')}}" value="{{$item->name}}"  type="text">

                                    </div>
                                </div>
                                

                            

                                    <div class="col-lg-6 col-md-6" >
                                        <label>{{__('route.payment_type')}} </label> 
                                        <select name="payment_type" class="form-control " id="payment_type"  required="">
                                            <option label="Choose one">
                                            </option>
                                            <option value="كاش" >
                                                كاش 
                                            </option>

                                            <option value="تحويل" >
                                                تحويل
                                            </option>
                                        </select>
                                    </div>
                                
                            
                                
                            
                                    <div class="col-lg-6 col-md-6" id="transferFields"  style="display: none;">
                                        <label>{{__('route.By')}} </label> 
                                        <select name="By" class="form-control" >
                                            <option label="Choose one"></option>
                                            <option value="الهرم">الهرم /  Alharam</option>
                                            <option value="الفؤاد">الفؤاد /  Alfoued</option>
                                        </select>
                                    </div>

                                    <div class="col-6" id="transferFields_2"  style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label">{{__('route.id_payment')}} : <span class="tx-danger">*</span></label>
                                            <input class="form-control" name="id_payment" placeholder="{{__('route.id_payment')}}" value="" type="number">
                                        </div>
                                    </div>

                                    <div class="col-6" id="transferFields_3"  style="display: none;">
                                        <label></label> 
                                        <div class="card-category">{{__('route.to')}}</div>
                                    </div>
                                </div>

                            </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary " type="submit">{{__('route.save')}}</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('route.close')}}</button>
                                </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('payment_type').addEventListener('change', function() {
        var transferFields = document.getElementById('transferFields');

        var transferFields_2 = document.getElementById('transferFields_2');
        var transferFields_3 = document.getElementById('transferFields_3');
        if (this.value === 'تحويل') {
            transferFields.style.display = 'block';

            transferFields_2.style.display = 'block';
            transferFields_3.style.display = 'block';
        } else {
            transferFields.style.display = 'none';

            transferFields_2.style.display = 'none';
            transferFields_3.style.display = 'none';
        }
    });
</script>