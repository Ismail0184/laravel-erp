@extends('layouts.app')

@section('title')
    @php($title = 'Early Leave Application')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            @if(request('id')>0) @if($earlyLeaveApplication->employee_id!==Auth::user()->id)
                <p class="text-center text-danger">
                    You are trying to view unauthorized access.
                </p>
            @endif @endif
            <div class="card-body" @if(request('id')>0) @if($earlyLeaveApplication->employee_id!==Auth::user()->id) style="display: none" @endif @endif>
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('ea.attendance.earlyLeaveApplication.update', ['id'=>$earlyLeaveApplication->id])}} @else {{route('ea.attendance.earlyLeaveApplication.store')}} @endif" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">

                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Departure Date & Time <span class="required text-danger">*</span></label>
                        <div class="col-lg-4">
                            <input type="date" name="date" @if(request('id')>0) value="{{$earlyLeaveApplication->date}}" @endif id="start_date" onchange="cal1()" class="form-control" required="required">
                        </div>
                        <div class="col-lg-5">
                            <input type="time" name="departure_time" @if(request('id')>0) value="{{$earlyLeaveApplication->departure_time}}" @endif id="end_date" onchange="cal()" required="required" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Early Leave Reason <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="reason" @if(request('id')>0) value="{{$earlyLeaveApplication->reason}}" @endif required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Responsible Person (During Leave)<span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="responsible_person">
                                <option value=""> -- select a person -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$earlyLeaveApplication->responsible_person) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Recommend By <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="recommended_by">
                                <option value=""> -- select a person -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$earlyLeaveApplication->recommended_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Approve By <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="approved_by">
                                <option value=""> -- select a person -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$earlyLeaveApplication->approved_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('ea.attendance.earlyLeaveApplication')}}">Cancel</a>
                                @if(request('id')>0) @if($earlyLeaveApplication->status=='DRAFTED')
                                    <button type="submit" class="btn btn-primary w-md">Update</button>
                                @endif
                                @else
                                    <button type="submit" class="btn btn-primary w-md">Save</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
