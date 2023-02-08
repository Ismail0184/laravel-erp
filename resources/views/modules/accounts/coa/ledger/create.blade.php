@extends('layouts.app')

@section('title')
    @php($title = 'Accounts Ledger')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}}</h4>
                <form method="POST" action="@if(request('id')>0) {{route('acc.ledger.update', ['id'=>$ledgergroup->id])}} @else {{route('acc.ledger-group.store')}} @endif">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger Group <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <select class="form-control select2" name="group_id" required="required">
                                <option value=""> -- Select Class -- </option>
                                @foreach($ledgergroups as $ledgergroup)
                                    <option value="{{$ledgergroup->class_id}}" @if(request('id')>0) @if($ledgergroup->class_id==$class->class_id) selected @endif @endif>{{$ledgergroup->class_id}} : {{$ledgergroup->class_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Ledger Group Code <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="group_id" @if(request('id')>0) value="{{$ledgergroup->group_id}}" @endif class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Ledger Group Name <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="group_name" @if(request('id')>0) value="{{$ledgergroup->group_name}}" @endif class="form-control" required>
                        </div>
                    </div>
                    @if(request('id')>0)
                        <div class="form-group row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($ledgergroup->status ==1) selected @endif value="1">Active</option>
                                    <option @if($ledgergroup->status ==0) selected @endif value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('acc.ledger.view')}}">Cancel</a>
                                <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
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
