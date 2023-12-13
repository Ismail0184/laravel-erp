@extends('layouts.app')

@section('title')
    @php($title = 'Leave Application')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            @if(request('id')>0) @if($leaveApplication->employee_id!==Auth::user()->id)
                <p class="text-center text-danger">
                    You are trying to view unauthorized access.
                </p>
            @endif @endif
            <div class="card-body" @if(request('id')>0) @if($leaveApplication->employee_id!==Auth::user()->id) style="display: none" @endif @endif>
                <h4 class="card-title mb-4">@if(request('id')) Update @else Create @endif {{$title}} <small class="text-danger float-right"> field marked with * are mandatory</small></h4>
                <form method="POST" action="@if(request('id')>0) {{route('ea.attendance.leaveApplication.update', ['id'=>$leaveApplication->id])}} @else {{route('ea.attendance.leaveApplication.store')}} @endif" enctype="multipart/form-data">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 70%">
                                <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Leave Type <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="type" id="categorySelect" onchange="getTypeBalance()" required="required">
                                            <option value=""> -- select a type -- </option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" @if(request('id')>0) @if($type->id==$leaveApplication->type) selected @endif @endif>{{$type->leave_type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Start Date <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="start_date" @if(request('id')>0) value="{{$leaveApplication->start_date}}" @endif id="start_date" onchange="cal1()"  class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">End Date <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="end_date" @if(request('id')>0) value="{{$leaveApplication->end_date}}" @endif id="end_date" onchange="cal()" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Total Days </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="total_days" name="total_days" @if(request('id')>0) value="{{$leaveApplication->total_days}}" @endif readonly required class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Balance</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="typeBalance" name="balance_days" @if(request('id')>0) value="{{$leaveApplication->balance_days}}" @endif readonly required  class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Leave Reason <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="reason" @if(request('id')>0) value="{{$leaveApplication->reason}}" @endif required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Leave Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="leave_address" @if(request('id')>0) value="{{$leaveApplication->leave_address}}" @endif class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mobile (during leave) <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="leave_mobile_number" @if(request('id')>0) value="{{$leaveApplication->leave_mobile_number}}" @endif class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="horizontal-email-input" class="col-sm-3 col-form-label">R.P (during leave) <span class="required text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;font-size: 11px" name="responsible_person">
                                            <option value=""> -- select a responsible person -- </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$leaveApplication->responsible_person) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
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
                                                <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$leaveApplication->recommended_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
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
                                                <option value="{{$user->id}}" @if(request('id')>0) @if($user->id==$leaveApplication->approved_by) selected @endif @endif>{{$user->code}} : {{$user->full_name}}</option>
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
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <a class="btn btn-danger" href="{{route('ea.attendance.leaveApplication')}}">Cancel</a>
                                            @if(request('id')>0) @if($leaveApplication->status=='DRAFTED' || $leaveApplication->status=='REJECTED')
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
                                        <th colspan="4" class="text-center bg-primary text-white">Company Leave Policy</th>
                                    </tr>
                                    <tr class="font-size-11">
                                        <th class="text-left" style="vertical-align: middle">Leave Type</th>
                                        <th style="text-align: center; vertical-align: middle">Policy (Yearly)</th>
                                        <th style="text-align: center; vertical-align: middle">Taken ({{date('Y')}})</th>
                                        <th style="text-align: center; vertical-align: middle">Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($total = 0)
                                    @php($total_leave_taken = 0)
                                    @foreach($leave_taken as $type)
                                    <tr class="font-size-11">
                                        <td>{{$type['leave_type_name']}}</td>
                                        <td style="text-align: center">{{$type['yearly_leave_days']}}</td>
                                        <td style="text-align: center">{{$type['total_leave_taken']}}</td>
                                        <td class="bg-pink text-white" style="text-align: center">{{$type['yearly_leave_days']-$type['total_leave_taken']}}</td>
                                    </tr>
                                        @php($total =$total+$type['yearly_leave_days'])
                                        @php($total_leave_taken = $total_leave_taken + $type['total_leave_taken'])

                                    @endforeach
                                    </tbody>
                                    <tfoot class="thead-light">
                                    <tr class="font-size-11">
                                        <th>Total</th>
                                        <th style="text-align: center">{{$total}}</th>
                                        <th style="text-align: center">{{$total_leave_taken}}</th>
                                        <th style="text-align: center">{{$total-$total_leave_taken}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <br>
                                <span style="margin-top: 20px" class="text-danger">**Note: To avoid rejection of your application, do not apply more leave days than the remaining balance of each leave type.</span>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>


        <script>
            function GetDays(){
                var dropdt = new Date(document.getElementById("start_date").value);
                var pickdt = new Date(document.getElementById("end_date").value);
                return parseInt((pickdt - dropdt) / (24 * 3600 * 1000))+1;
            }
            function cal1(){
                if(document.getElementById("end_date")){
                    document.getElementById("total_days").value=GetDays();
                    @if(request('id')>0)
                        @else
                    document.getElementById('end_date').value = '';
                    document.getElementById('total_days').value = '';
                    @endif
                }
            }
            function cal(){
                if(document.getElementById("end_date")){
                    document.getElementById("total_days").value=GetDays();
                }
                var value1 = document.getElementById('total_days').value;
                var value2 = document.getElementById('typeBalance').value;
                if (value1 > value2) {
                    alert('oops!! exceed leave balance. Please check your leave balance from right section(Selected pink color) & apply again!! Thanks');
                    @if(request('id')>0)
                    @else
                    document.getElementById('end_date').value = '';
                    document.getElementById('total_days').value = '';
                    @endif
                }
            }

            function getTypeBalance() {
                const selectedCategory = document.getElementById("categorySelect").value;
                $.ajax({
                    url: `/get-type-balance/${selectedCategory}`,
                    method: 'GET',
                    success: function(response) {
                        document.getElementById("typeBalance").value = response.balance;
                    },
                    error: function(error) {
                        console.error("Error fetching category balance:", error);
                    }
                });

                @if(request('id')>0)
                @else
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
                document.getElementById('total_days').value = '';
                @endif
            }
            getTypeBalance();
        </script>
    </div>
@endsection
