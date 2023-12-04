@extends('layouts.app')

@section('title')
    @php($title = 'Leave Application')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('ea.attendance.leaveApplication.update', ['id'=>$employee->id])}} @else {{route('ea.attendance.leaveApplication.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 70%">
                                <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Leave Type <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="type" required>
                                            <option value=""> -- select a type -- </option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" @if(request('code')>0) @if($type->id==$employee->blood_group) selected @endif @endif>{{$type->leave_type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Start Date <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="start_date" @if(request('code')>0) value="{{$employee->start_date}}" @endif id="start_date" onchange="cal()" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">End Date <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="end_date" @if(request('code')>0) value="{{$employee->end_date}}" @endif id="end_date" onchange="cal()" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Total Days </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="applied" name="total_days" @if(request('code')>0) value="{{$employee->total_days}}" @endif readonly required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Leave Reason <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="reason" @if(request('code')>0) value="{{$employee->reason}}" @endif required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Leave Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="leave_address" @if(request('code')>0) value="{{$employee->leave_address}}" @endif class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mobile (during leave) <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="leave_mobile_number" @if(request('code')>0) value="{{$employee->leave_mobile_number}}" @endif class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">R.P (during leave) <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;font-size: 11px" name="responsible_person">
                                            <option value=""> -- select a responsible person -- </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} : {{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Recommend By <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="recommended_by">
                                            <option value=""> -- select a person -- </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->code}} : {{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Approve By <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="approved_by">
                                            <option value=""> -- select a person -- </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->code}} : {{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Attachment</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                                @if(request('id')>0)
                                    <div class="form-group row mb-4">
                                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Status <span class="required text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                                <option @if($employee->status =='active') selected @endif value="active">Active</option>
                                                <option @if($employee->status =='inactive') selected @endif value="inactive">Inactive</option>
                                                <option @if($employee->status =='suspended') selected @endif value="suspended">Suspended</option>
                                                <option @if($employee->status =='deleted') selected @endif value="deleted">Deleted</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <a class="btn btn-danger" href="{{route('ea.attendance.leaveApplication')}}">Cancel</a>
                                            <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: top">
                                <table class="table mb-0 font-size-12">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-left" style="vertical-align: middle">Leave Type</th>
                                        <th style="text-align: center; vertical-align: middle">Policy (Yearly)</th>
                                        <th style="text-align: center; vertical-align: middle">Taken ({{date('Y')}})</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($total = 0)
                                    @foreach($types as $type)
                                    <tr>
                                        <td>{{$type->leave_type_name}}</td>
                                        <td style="text-align: center">{{$type->yearly_leave_days}}</td>
                                        <td style="text-align: center">0</td>
                                    </tr>
                                        @php($total = $total +$type->yearly_leave_days)
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th style="text-align: center">{{$total}}</th>
                                        <th style="text-align: center">0</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <script language="javascript">
            function GetDays(){
                var dropdt = new Date(document.getElementById("start_date").value);
                var pickdt = new Date(document.getElementById("end_date").value);
                return parseInt((pickdt - dropdt) / (24 * 3600 * 1000))+1;
            }
            function cal(){
                if(document.getElementById("end_date")){
                    document.getElementById("applied").value=GetDays();
                }
            }
        </script>
    </div>
@endsection


