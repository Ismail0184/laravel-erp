@extends('layouts.app')

@section('title')
    @php($title = 'Accounts Ledger')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('ledger_id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('ledger_id')>0) {{route('acc.ledger.update', ['ledger_id'=>$ledger->ledger_id])}} @else {{route('acc.ledger.store')}} @endif">
                    @csrf
                    <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                    @if(!(request('ledger_id')))
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger Group <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="group_id" required="required">
                                <option value=""> -- Select Group -- </option>
                                @foreach($ledgergroups as $ledgergroup)
                                    <option value="{{$ledgergroup->group_id}}" @if(request('ledger_id')>0) @if($ledgergroup->group_id==$ledger->group_id) selected @endif @endif>{{$ledgergroup->group_id}} : {{$ledgergroup->group_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="ledger_name" @if(request('ledger_id')>0) value="{{$ledger->ledger_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('ledger_id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($ledger->status =='active') selected @endif value="active">Active</option>
                                    <option @if($ledger->status =='inactive') selected @endif value="inactive">Inactive</option>
                                    <option @if($ledger->status =='suspended') selected @endif value="suspended">Suspended</option>
                                    <option @if($ledger->status =='deleted') selected @endif value="deleted">Deleted</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Show in Transaction <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="show_in_transaction">
                                    <option @if($ledger->show_in_transaction ==1) selected @endif value="1">Show</option>
                                    <option @if($ledger->show_in_transaction ==0) selected @endif value="0">Hide</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.ledger.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('ledger_id')) Update @else Save @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getSubClass(ClassId)
        {
            $.ajax({
                type: "GET",
                url: "{{route('acc.get-all-sub-class')}}",
                data: {id: ClassId},
                dataType: "JSON",
                success: function (response) {
                    var option = '';
                    option += '<option> -- Select Sub Class -- </option>';
                    $.each(response,  function (key, value)
                    {
                        option += '<option value="'+value.sub_class_id+'">'+ value.sub_class_id +' : '+ value.sub_class_name +'</optoin>';
                    })
                    var subClassId = $('#subClassId');
                    subClassId.empty();
                    subClassId.append(option);
                }
            });
        }
    </script>
@endsection
