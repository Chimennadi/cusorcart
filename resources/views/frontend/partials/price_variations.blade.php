
@foreach(json_decode($subsubcategory->options) as $key=> $option)
    <div class="form-group clearfix row">
        <div class="col-sm-2">
            <label class="control-label">{{$option->title}}</label>
        </div>
        <div class="col-sm-10">
            <div class="customer_choice_options_types_wrap">
                <div class="customer_choice_options_types_wrap_child">
                    @if($option->type == 'radio' || $option->type == 'select')
                        @foreach($option->options as $options)
                            <div class="form-group clearfix row">
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" value="{{$options}}" disabled>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" lang="en" min="0" step="0.01" name="{{$option->name}}_{{$options}}_price" required>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control selectpicker" name="{{$option->name}}_{{$options}}_variation">
                                        <option value="increase">{{translate('Increase')}}</option>
                                        <option value="decrease">{{translate('Decrease')}}</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
