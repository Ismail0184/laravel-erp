@extends('layouts.app')

@section('title')
    @php($title = 'Credit Limit')
    {{$title}}
@endsection

@section('body')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 CSS and JS -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Request @endif {{$title}}  <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('sales.cl.update', ['id'=>$cl->id])}} @else {{route('sales.cl.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Dealer / Customer <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="dealer_id" id="dealer_id" required="required">
                                <option value="">-- select Customer --</option>
                                @foreach($dealers as $dealer)
                                <option value="{{$dealer->dealer_id}}" @if(request('id')>0) @if($dealer->dealer_id==$cl->dealer_id) selected @endif @endif >{{$dealer->dealer_id}} : {{$dealer->dealer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Limit For <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="limit_type" required="required">
                                <option value="">-- select type --</option>
                                <option value="SINGLE" @if(request('id')>0) @if($cl->limit_type =='SINGLE') selected @endif @endif>Single Invoice</option>
                                <option value="UNLIMITED" @if(request('id')>0) @if($cl->limit_type =='UNLIMITED') selected @endif @endif>Unlimited Invoice</option>
                            </select>
                        </div>
                    </div>
                    @if(!request('id')>0)
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Current Balance</label>
                        <div class="col-sm-9">
                            <input type="number" id="current_balance" name="current_balance" @if(request('id')>0) value="{{$cl->buy_item_qty}}" @endif readonly class="form-control"  />
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Credit Limit Amount <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" name="requested_limit" @if(request('id')>0) value="{{$cl->requested_limit}}" @endif class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Remarks <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea name="remarks" required class="form-control">@if(request('id')>0) {{$cl->remarks}} @endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('sales.cl.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#dealer_id').select2();

            // Add change event listener to the select element
            $('#dealer_id').on('change', function () {
                // Get the selected value
                var selectedValue = $(this).val();

                // Send an AJAX request to the server
                $.ajax({
                    type: 'POST', // or 'GET' depending on your Laravel route
                    url: '/your-php-endpoint', // Replace with your Laravel route URL
                    data: {
                        value: selectedValue
                    },
                    success: function (response) {
                        // Update the result field with the response from the server
                        $('#current_balance').val(response);
                    }
                });
            });
        });
    </script>


@endsection
