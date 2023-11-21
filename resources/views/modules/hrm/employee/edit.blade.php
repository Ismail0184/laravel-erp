@extends('layouts.app')

@section('title')
    @php($title = 'Employee')
    {{$title}}
@endsection

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Employee Information</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" style="background-color: lightgrey" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(session()->has('key')) @else active @endif" data-toggle="tab" href="#personal" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Personal</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='contact') active @endif" data-toggle="tab" href="#contact" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Contact</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='job') active @endif" data-toggle="tab" href="#job" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Job</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='family') active @endif" data-toggle="tab" href="#family" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Family</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='education') active @endif" data-toggle="tab" href="#education" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Education</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='employment') active @endif" data-toggle="tab" href="#employment" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Employment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='supervisor') active @endif" data-toggle="tab" href="#supervisor" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Supervisor</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='documents') active @endif" data-toggle="tab" href="#documents" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Documents</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='language') active @endif" data-toggle="tab" href="#language" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Language</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='bank') active @endif" data-toggle="tab" href="#bank" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Bank</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='social') active @endif" data-toggle="tab" href="#socialmedia" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Social</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Session::get('key')=='talent') active @endif" data-toggle="tab" href="#talent" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Talent</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane @if(session()->has('key')) @else active @endif" id="personal" role="tabpanel">
                        <form method="POST" action="@if(request('id')>0) {{route('hrm.employee.update', ['id'=>$employee->id])}} @else {{route('hrm.employee.store')}} @endif" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <div class="card-header">Personal Basic Information
                                @if( $message = Session::get('personal_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Employee Code <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" @if(request('id')>0) value="{{$employee->code}}" @endif class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Full Name (as per NID) <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" @if(request('id')>0) value="{{$employee->full_name}}" @endif class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Father's Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="father_name" @if(request('id')>0) value="{{$employee->father_name}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mother's Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="mother_name" @if(request('id')>0) value="{{$employee->mother_name}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Spouse's Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="spouse_name" @if(request('id')>0) value="{{$employee->spouse_name}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Date of Birth <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="date" name="date_of_birth" @if(request('id')>0) value="{{$employee->date_of_birth}}" @endif class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">National ID <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="national_id" @if(request('id')>0) value="{{$employee->national_id}}" @endif required class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Birth Certificate ID <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="birth_certificate_id" @if(request('id')>0) value="{{$employee->birth_certificate_id}}" @endif required class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Passport No</label>
                                <div class="col-sm-9">
                                    <input type="text" name="passport_id" @if(request('id')>0) value="{{$employee->passport_id}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Driving License</label>
                                <div class="col-sm-9">
                                    <input type="text" name="driving_license" @if(request('id')>0) value="{{$employee->driving_license}}" @endif class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Blood Group</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="blood_group">
                                        <option value=""> -- select a blood group -- </option>
                                        @foreach($bloods as $blood)
                                            <option value="{{$blood->id}}" @if(request('id')>0) @if($blood->id==$employee->blood_group) selected @endif @endif>{{$blood->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Religion <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="religion" required>
                                        <option value=""> -- select a religion -- </option>
                                        @foreach($religions as $religion)
                                            <option value="{{$religion->id}}" @if(request('id')>0) @if($religion->id==$employee->religion) selected @endif @endif>{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Gender <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="gender">
                                        <option value=""> -- select a gender -- </option>
                                        <option @if(request('id')>0)  @if($employee->gender =='1') selected @endif @endif value="1">Male</option>
                                        <option @if(request('id')>0) @if($employee->gender =='0') selected @endif @endif value="0">Female</option>
                                        <option @if(request('id')>0) @if($employee->gender =='2') selected @endif @endif value="2">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Marital Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="marital_status">
                                        <option value=""> -- select a status -- </option>
                                        <option @if(request('id')>0)  @if($employee->marital_status =='0') selected @endif @endif value="0">Unmarried</option>
                                        <option @if(request('id')>0) @if($employee->marital_status =='1') selected @endif @endif value="1">Married</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Nationality</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nationality">
                                        <option value=""> -- select a Nationality -- </option>
                                        <option @if(request('id')>0)  @if($employee->nationality =='50') selected @endif @endif value="50">Bangladeshi</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
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
                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                        <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='contact') active @endif" id="contact" role="tabpanel">
                        <form method="POST" action="@if($contactEmployeeId>0) {{route('hrm.employeeContactInfo.update', ['id'=>$employee->id])}} @else {{route('hrm.employeeContactInfo.store')}} @endif" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                            <div class="card-header">Contact Information
                                @if( $message = Session::get('contact_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div>
                            <hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 30%">
                                        <div class="col-lg-12">
                                            <p><strong><u>Basic Contact</u></strong></p>
                                        <div class="col-lg-12">
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Mobile</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="mobile" @if($contactEmployeeId>0) value="{{$contactInfo->mobile}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Alternative Mobile</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="alternative_mobile" @if($contactEmployeeId>0) value="{{$contactInfo->alternative_mobile}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-10">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="email" @if($contactEmployeeId>0) value="{{$contactInfo->email}}" @endif class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-10">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">@if($contactEmployeeId) Update @else Save @endif</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 40%">
                                        <div class="col-lg-12">
                                            <p><strong><u>Present Address</u></strong></p>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address" @if($contactEmployeeId>0) value="{{$contactInfo->present_address}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Country</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_country">
                                                        <option value=""> -- select a country -- </option>
                                                        <option value="50"> Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">State</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_state">
                                                        <option value=""> -- select a state -- </option>
                                                        @foreach($states as $state)
                                                        <option value="{{$state->id}}" @if($contactEmployeeId>0) @if($contactInfo->present_address_state==$state->id) selected @endif @endif>{{$state->state_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">City</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_city">
                                                        <option value=""> -- select a city -- </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}" @if($contactEmployeeId>0) @if($contactInfo->present_address_city==$city->id) selected @endif @endif>{{$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">P.Station</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_police_station">
                                                        <option value=""> -- select a police station -- </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}" @if($contactEmployeeId>0) @if($contactInfo->present_address_city==$city->id) selected @endif @endif>{{$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Post Office</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_post_office">
                                                        <option value=""> -- select a post office -- </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Zip Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address_zip_code" @if($contactEmployeeId>0) value="{{$contactInfo->present_address}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 40%">
                                        <div class="col-lg-12">
                                            <p><strong><u>Permanent Address</u></strong></p>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Address <span class="required text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="permanent_address" @if($contactEmployeeId>0) value="{{$contactInfo->permanent_address}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Country</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_country">
                                                        <option value=""> -- select a country -- </option>
                                                        <option value="50"> Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">State</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_state">
                                                        <option value=""> -- select a state -- </option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}">{{$state->state_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">City</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_city">
                                                        <option value=""> -- select a city -- </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">P.Station</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_police_station">
                                                        <option value=""> -- select a police station -- </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Post Office</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_post_office">
                                                        <option value=""> -- select a post office -- </option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Zip Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address" @if($contactEmployeeId>0) value="{{$contactInfo->present_address}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                    <div class="tab-pane @if(Session::get('key')=='job') active @endif" id="job" role="tabpanel">
                        <form method="POST" action="@if($jobEmployeeId>0) {{route('hrm.employeeJobInfo.update', ['id'=>$employee->id])}} @else {{route('hrm.employeeJobInfo.store')}} @endif" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                            <div class="card-header">Job Information
                                @if ($message = Session::get('destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('job_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('job_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Appointment Ref. No</label>
                                <div class="col-sm-9">
                                    <input type="text" name="appointment_ref_no" @if($jobEmployeeId>0) value="{{$jobInfo->appointment_ref_no}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Appointment Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="appointment_date" @if($jobEmployeeId>0) value="{{$jobInfo->appointment_date}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Confirmation Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="confirmation_date" @if($jobEmployeeId>0) value="{{$jobInfo->confirmation_date}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Joining Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="joining_date" @if($jobEmployeeId>0) value="{{$jobInfo->joining_date}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Corporate Mobile No.</label>
                                <div class="col-sm-9">
                                    <input type="text" name="corporate_mobile" @if($jobEmployeeId>0) value="{{$jobInfo->corporate_mobile}}" @endif class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Corporate Email ID</label>
                                <div class="col-sm-9">
                                    <input type="email" name="corporate_email" @if($jobEmployeeId>0) value="{{$jobInfo->corporate_email}}" @endif class="form-control">
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Employment Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="employment_type">
                                        <option value=""> -- select a type -- </option>
                                        @foreach($employmentTypes as $etype)
                                            <option value="{{$etype->id}}" @if($jobEmployeeId>0) @if($etype->id==$jobInfo->employment_type) selected @endif @endif>{{$etype->employment_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Job Location <span class="required text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="job_location">
                                        <option value=""> -- select a location -- </option>
                                        @foreach($jobLocations as $jobLocation)
                                            <option value="{{$jobLocation->id}}" @if($jobEmployeeId>0) @if($jobLocation->id==$jobInfo->job_location) selected @endif @endif>{{$jobLocation->job_location_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Department</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="department">
                                        <option value=""> -- select a department -- </option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" @if($jobEmployeeId>0) @if($department->id==$jobInfo->department) selected @endif @endif>{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Designation</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" name="designation">
                                        <option value=""> -- select a designation -- </option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}" @if($jobEmployeeId>0) @if($designation->id==$jobInfo->designation) selected @endif @endif>{{$designation->designation_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Grade</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="grade">
                                        <option value=""> -- select a grade -- </option>
                                        @foreach($grades as $grade)
                                            <option value="{{$grade->id}}" @if($jobEmployeeId>0) @if($grade->id==$jobInfo->grade) selected @endif @endif>{{$grade->grade}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Shift</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="shift">
                                        <option value=""> -- select a shift -- </option>
                                        @foreach($shifts as $shift)
                                            <option value="{{$shift->id}}" @if($jobEmployeeId>0) @if($shift->id==$jobInfo->shift) selected @endif @endif>{{$shift->shift_name}} - {{$shift->start_time}} : {{$shift->end_time}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                        <button type="submit" class="btn btn-primary w-md">@if($jobEmployeeId) Update @else Save @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="family" role="tabpanel">
                        <form method="POST" action="@if($jobEmployeeId>0) {{route('hrm.employeeJobInfo.update', ['id'=>$employee->id])}} @else {{route('hrm.employeeJobInfo.store')}} @endif" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                            <div class="card-header">Family Information
                                @if ($message = Session::get('destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('family_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('family_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" @if($familyEmployeeId>0)  @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Relationship</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="employment_type">
                                                    <option value=""> -- select a relationship -- </option>
                                                    @foreach($relations as $relation)
                                                        <option value="{{$relation->id}}">{{$relation->relation_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">NID</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" @if($familyEmployeeId>0)  @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mobile</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" @if($familyEmployeeId>0)  @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" @if($familyEmployeeId>0)  @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Profession</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" @if($familyEmployeeId>0)  @endif class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 12px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Profession</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>



                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <div>
                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane" id="education" role="tabpanel">
                        <p class="mb-0">this is education section
                        </p>
                    </div>
                    <div class="tab-pane" id="employment" role="tabpanel">
                        <p class="mb-0">this is employment section
                        </p>
                    </div>
                    <div class="tab-pane" id="supervisor" role="tabpanel">
                        <p class="mb-0">this is supervisor section
                        </p>
                    </div>
                    <div class="tab-pane" id="documents" role="tabpanel">
                        <p class="mb-0">this is documents section
                        </p>
                    </div>
                    <div class="tab-pane" id="language" role="tabpanel">
                        <p class="mb-0">this is language section
                        </p>
                    </div>
                    <div class="tab-pane" id="bank" role="tabpanel">
                        <p class="mb-0">this is bank section
                        </p>
                    </div>
                    <div class="tab-pane" id="social" role="tabpanel">
                        <p class="mb-0">this is social media section
                        </p>
                    </div>
                    <div class="tab-pane" id="talent" role="tabpanel">
                        <p class="mb-0">this is talent section
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
