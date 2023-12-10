@extends('layouts.app')

@section('title')
    @php($title = 'Late Attendance Application')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            @if(request('id')>0) @if($lateAttendanceApplication->employee_id!==Auth::user()->id)
                <p class="text-center text-danger">
                    You are trying to view unauthorized access.
                </p>
            @endif @endif
            <div class="card-body" @if(request('id')>0) @if($lateAttendanceApplication->employee_id!==Auth::user()->id) style="display: none" @endif @endif>
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('ea.attendance.lateAttendanceApplication.update', ['id'=>$lateAttendanceApplication->id])}} @else {{route('ea.attendance.lateAttendanceApplication.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 70%">
                                <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Date <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date" @if(request('id')>0) value="{{$lateAttendanceApplication->date}}" @endif id="start_date" onchange="cal1()" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Late Entry At <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="time" name="late_entry_at" @if(request('id')>0) value="{{$lateAttendanceApplication->late_entry_at}}" @endif id="end_date" onchange="cal()" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Late Reason <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="late_reason" @if(request('id')>0) value="{{$lateAttendanceApplication->late_reason}}" @endif required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Recommend By <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="recommended_by">
                                            <option value=""> -- select a person -- </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$lateAttendanceApplication->recommended_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
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
                                                <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$lateAttendanceApplication->approved_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <a class="btn btn-danger" href="{{route('ea.attendance.lateAttendanceApplication')}}">Cancel</a>
                                            @if(request('id')>0) @if($lateAttendanceApplication->status=='DRAFTED')
                                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                            @endif
                                            @else
                                                <button type="submit" class="btn btn-primary w-md">Save</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: top">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr class="font-size-13">
                                        <th colspan="4" class="text-center bg-primary text-white">Company Late Attendance Policy</th>
                                    </tr>

                                    </tfoot>
                                </table>
                                <br>
                                <span style="margin-top: 20px" class="text-danger">**Note: 1 day salary will be deducted if 3 days late in a month.</span>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
