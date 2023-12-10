@extends('layouts.app')

@section('title')
    @php($title = 'Outdoor Duty Application')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            @if(request('id')>0) @if($outdoorDutyApplication->employee_id!==Auth::user()->id)
                <p class="text-center text-danger">
                    You are trying to view unauthorized access.
                </p>
            @endif @endif
            <div class="card-body" @if(request('id')>0) @if($outdoorDutyApplication->employee_id!==Auth::user()->id) style="display: none" @endif @endif>
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('ea.attendance.outdoorDuty.update', ['id'=>$outdoorDutyApplication->id])}} @else {{route('ea.attendance.outdoorDuty.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">OD Date <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" max="{{ now()->format('Y-m-d') }}" name="date" @if(request('id')>0) value="{{$outdoorDutyApplication->date}}" @endif id="start_date" onchange="cal1()" class="form-control" required="required">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">OD Place <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="od_place" @if(request('id')>0) value="{{$outdoorDutyApplication->od_place}}" @endif required class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">OD Purpose <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="reason" @if(request('id')>0) value="{{$outdoorDutyApplication->reason}}" @endif required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Responsible Person <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="responsible_person">
                                <option value=""> -- select a person -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$outdoorDutyApplication->responsible_person) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
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
                                    <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$outdoorDutyApplication->recommended_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Approve By <span class="required text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="approved_by">
                                <option value=""> -- select a person -- </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$outdoorDutyApplication->approved_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <a class="btn btn-danger" href="{{route('ea.attendance.outdoorDuty')}}">Cancel</a>
                                @if(request('id')>0) @if($outdoorDutyApplication->status=='DRAFTED')
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
