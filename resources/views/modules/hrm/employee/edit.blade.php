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
                        <a class="nav-link @if(Session::get('key')=='document') active @endif" data-toggle="tab" href="#document" role="tab">
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
                        <a class="nav-link @if(Session::get('key')=='social') active @endif" data-toggle="tab" href="#social" role="tab">
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
                                        <option @if(request('id')>0)  @if($employee->marital_status =='unmarried') selected @endif @endif value="unmarried">Unmarried</option>
                                        <option @if(request('id')>0) @if($employee->marital_status =='married') selected @endif @endif value="married">Married</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Nationality</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nationality">
                                        <option value=""> -- select a Nationality -- </option>
                                        @foreach($nationalities as $nationality)
                                        <option @if(request('id')>0)  @if($employee->nationality==$nationality->num_code) selected @endif @endif value="{{$nationality->num_code}}">{{$nationality->nationality}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control">
                                    <img src="{{asset($employee->image)}}" alt="" height="50" width="50">
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
                                    <td style="width: 50%">
                                        <div class="col-lg-12">
                                            <p><strong><u>Present Address</u></strong></p>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address" @if($contactEmployeeId>0) value="{{$contactInfo->present_address}}" @endif class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Country</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_country">
                                                        <option value=""> -- select a country -- </option>
                                                        @foreach($nationalities as $nationality)
                                                            <option @if($contactEmployeeId>0)  @if($contactInfo->present_address_country==$nationality->num_code) selected @endif @endif value="{{$nationality->num_code}}">{{$nationality->en_short_name}}</option>
                                                        @endforeach
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
                                                        @foreach($policeStations as $policeStation)
                                                            <option value="{{$policeStation->id}}" @if($contactEmployeeId>0) @if($contactInfo->present_address_police_station==$policeStation->id) selected @endif @endif>{{$policeStation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Post Office</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="present_address_post_office">
                                                        <option value=""> -- select a post office -- </option>
                                                        @foreach($postOffices as $postOffice)
                                                            <option @if($contactEmployeeId>0) @if($contactInfo->present_address_post_office==$postOffice->id) selected @endif @endif value="{{$postOffice->id}}">{{$postOffice->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Zip Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address_zip_code" @if($contactEmployeeId>0) value="{{$contactInfo->present_address}}" @endif class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%">
                                        <div class="col-lg-12">
                                            <p><strong><u>Permanent Address</u></strong></p>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Address <span class="required text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="permanent_address" @if($contactEmployeeId>0) value="{{$contactInfo->permanent_address}}" @endif class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Country</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_country">
                                                        <option value=""> -- select a country -- </option>
                                                        @foreach($nationalities as $nationality)
                                                            <option @if($contactEmployeeId>0)  @if($contactInfo->permanent_address_country==$nationality->num_code) selected @endif @endif value="{{$nationality->num_code}}">{{$nationality->en_short_name}}</option>
                                                        @endforeach
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
                                                        @foreach($policeStations as $policeStation)
                                                            <option value="{{$policeStation->id}}" @if($contactEmployeeId>0) @if($contactInfo->permanent_address_police_station==$policeStation->id) selected @endif @endif>{{$policeStation->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Post Office</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="permanent_address_post_office">
                                                        <option value=""> -- select a post office -- </option>
                                                        @foreach($postOffices as $postOffice)
                                                            <option @if($contactEmployeeId>0) @if($contactInfo->permanent_address_post_office==$postOffice->id) selected @endif @endif value="{{$postOffice->id}}">{{$postOffice->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Zip Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="permanent_address_zip_code" @if($contactEmployeeId>0) value="{{$contactInfo->permanent_address_zip_code}}" @endif class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-lg-12">
                                            <p><strong><u>Basic Contact</u></strong></p>
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
                                    </td>
                                    <td>
                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-10">
                                                <div>
                                                    <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                    <button type="submit" class="btn btn-primary w-md">@if($contactEmployeeId) Update @else Save @endif</button>
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
                    <div class="tab-pane @if(Session::get('key')=='family') active @endif" id="family" role="tabpanel">
                            <div class="card-header">Family Information
                                @if ($message = Session::get('family_destroy_message'))
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
                                        <form method="POST" action="{{route('hrm.employeeFamilyInfo.store')}}" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="employee_id" value="{{request('id')}}">

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Name <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Relation <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="relationship" required>
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
                                                <input type="text" name="nid"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mobile <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="mobile" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Profession</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="profession" class="form-control">
                                            </div>
                                        </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-8">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Mobile</th>
                                                <th>Profession</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($familyInfos as $familyInfo)
                                            <tr>
                                                <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                <td style="vertical-align: middle">{{$familyInfo->name}}</td>
                                                <td style="vertical-align: middle">{{$familyInfo->relationships->relation_name}}</td>
                                                <td style="vertical-align: middle">{{$familyInfo->mobile}}</td>
                                                <td style="vertical-align: middle">{{$familyInfo->profession}}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <form action="{{route('hrm.employeeFamilyInfo.destroy', ['id' => $familyInfo->id])}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='education') active @endif" id="education" role="tabpanel">
                            <div class="card-header">Education Information
                                @if ($message = Session::get('education_destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('education_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('education_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <form method="POST" action="{{route('hrm.employeeEducationInfo.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Course</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="education_degree">
                                                    <option value=""> -- select a course -- </option>
                                                    @foreach($hrmEduExamTitles as $hrmEduExamTitle)
                                                        <option value="{{$hrmEduExamTitle->id}}">{{$hrmEduExamTitle->exam_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Subject</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="education_subject">
                                                    <option value=""> -- select a subject -- </option>
                                                    @foreach($hrmEduSubjects as $hrmEduSubject)
                                                        <option value="{{$hrmEduSubject->id}}">{{$hrmEduSubject->subject_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Grade</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="grade"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">CGPA</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cgpa"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Passed Year</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="passing_year" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Scale</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="scale" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Institute</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="institute">
                                                    <option value=""> -- select a institute -- </option>
                                                    @foreach($hrmUniversities as $university)
                                                        <option value="{{$university->id}}">{{$university->university_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Last Education?</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="last_education">
                                                    <option value="no">No</option>
                                                    <option value="yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Institute Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="institute_type">
                                                    <option>Local</option>
                                                    <option>Foreign</option>
                                                    <option>Professional</option>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-10">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Education</th>
                                                <th>Passed Year</th>
                                                <th>Grade</th>
                                                <th>Institute</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($educations as $education)
                                                <tr>
                                                    <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                    <td style="vertical-align: middle">{{$education->Courses->exam_title}} : {{$education->subjects->subject_name}}</td>
                                                    <td style="vertical-align: middle">{{$education->passing_year}}</td>
                                                    <td style="vertical-align: middle">{{$education->grade}}</td>
                                                    <td style="vertical-align: middle">{{$education->institutes->university_name}}</td>
                                                    <td style="vertical-align: middle; text-align: center">
                                                        <form action="{{route('hrm.employeeEducationInfo.destroy', ['id' => $education->id])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='employment') active @endif" id="employment" role="tabpanel">
                            <div class="card-header">Employment Information
                                @if ($message = Session::get('employment_destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('employment_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('employment_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <form method="POST" action="{{route('hrm.employeeEmploymentInfo.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Company</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="company_name"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" name="address"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Job Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="job_title"  class="form-control">
                                            </div>
                                        </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Job Description</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="remarks"  class="form-control">
                                                </div>
                                            </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Start Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="start_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">End Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="end_date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Last Salary</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="last_salary"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Exper. Letter</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="exp_letter">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">NOC</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="noc">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-8">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Job Title</th>
                                                <th>Duration</th>
                                                <th>Last Salary</th>
                                                <th>Exper. Letter</th>
                                                <th>NOC</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($employments as $employment)
                                                <tr>
                                                    <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                    <td style="vertical-align: middle">{{$employment->company_name}}</td>
                                                    <td style="vertical-align: middle">{{$employment->start_date}} - {{$employment->end_date}}</td>
                                                    <td style="vertical-align: middle">{{$employment->last_salary}}</td>
                                                    <td style="vertical-align: middle">{{$employment->exp_letter}}</td>
                                                    <td style="vertical-align: middle">{{$employment->noc}}</td>
                                                    <td style="vertical-align: middle; text-align: center">
                                                        <form action="{{route('hrm.employeeEmploymentInfo.destroy', ['id' => $employment->id])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='supervisor') active @endif" id="supervisor" role="tabpanel">
                            <div class="card-header">Supervisor Information
                                @if ($message = Session::get('supervisor_destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('supervisor_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('supervisor_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <form method="POST" action="{{route('hrm.employeeSupervisorInfo.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="employee_id" value="{{request('id')}}">

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Supervisor</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2" style="width: 100%;" name="supervisor">
                                                        <option value=""> -- select a supervisor -- </option>
                                                            @foreach($employees as $employee)
                                                                <option value="{{$employee->id}}">{{$employee->code}} : {{$employee->full_name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Level</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="level"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Effective Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="effective_date"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-8">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Supervisor Name</th>
                                                <th>Level</th>
                                                <th>Effective Date</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supervisors as $supervisor)
                                                <tr>
                                                    <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                    <td style="vertical-align: middle">{{$supervisor->getSupervisor->full_name}}</td>
                                                    <td style="vertical-align: middle">{{$supervisor->level}}</td>
                                                    <td style="vertical-align: middle">{{$supervisor->effective_date}}</td>
                                                    <td style="vertical-align: middle; text-align: center">
                                                        <form action="{{route('hrm.employeeSupervisorInfo.destroy', ['id' => $supervisor->id])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='document') active @endif" id="document" role="tabpanel">
                            <div class="card-header">Document Information
                                @if ($message = Session::get('document_destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('document_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('document_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <form method="POST" action="{{route('hrm.employeeDocumentInfo.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="employee_id" value="{{request('id')}}">

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Category <span class="required text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="category_id" required>
                                                        <option value=""> -- select a category -- </option>
                                                        @foreach($documentCategories as $category)
                                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Doc Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="doc_title"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Doc Id</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="doc_id"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Document <span class="required text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="image"  class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Remarks</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="remarks"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-8">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Id</th>
                                                <th>Remarks</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($documents as $document)
                                                <tr>
                                                    <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                    <td style="vertical-align: middle">{{$document->categorys->category}}</td>
                                                    <td style="vertical-align: middle">{{$document->doc_title}}</td>
                                                    <td style="vertical-align: middle">{{$document->doc_id}}</td>
                                                    <td style="vertical-align: middle">{{$document->remarks}}</td>
                                                    <td style="vertical-align: middle; text-align: center">
                                                        <form action="{{route('hrm.employeeDocumentInfo.destroy', ['id' => $document->id])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='language') active @endif" id="language" role="tabpanel">
                            <div class="card-header">Language Skill Information
                                @if ($message = Session::get('language_destroy_message'))
                                    <span class="text-center text-danger">{{ $message }}</span>
                                @elseif( $message = Session::get('language_store_message'))
                                    <span class="text-center text-success">{{ $message }}</span>
                                @elseif( $message = Session::get('language_update_message'))
                                    <span class="text-center text-primary">{{ $message }}</span>
                                @endif
                            </div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <form method="POST" action="{{route('hrm.employeeLanguageInfo.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="employee_id" value="{{request('id')}}">

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Language <span class="required text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="language_id" required>
                                                        <option value=""> -- select a language -- </option>
                                                        @foreach($languages as $language)
                                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Proficiency <span class="required text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="proficiency_id" required>
                                                        <option value=""> -- select a level -- </option>
                                                        @foreach($languageProficiencies as $proficiency)
                                                            <option value="{{$proficiency->id}}">{{$proficiency->level}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row justify-content-end">
                                                <div class="col-sm-8">
                                                    <div>
                                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                        <button type="submit" class="btn btn-primary w-md">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="width: 60%;vertical-align: top">
                                        <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Language</th>
                                                <th>Proficiency Level</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($languageSkills as $skill)
                                                <tr>
                                                    <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                    <td style="vertical-align: middle">{{$skill->languageName->name}}</td>
                                                    <td style="vertical-align: middle">{{$skill->proficiencyLevel->level}}</td>
                                                    <td style="vertical-align: middle; text-align: center">
                                                        <form action="{{route('hrm.employeeLanguageInfo.destroy', ['id' => $skill->id])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='bank') active @endif" id="bank" role="tabpanel">
                        <div class="card-header">Bank A/c Information
                            @if ($message = Session::get('bank_destroy_message'))
                                <span class="text-center text-danger">{{ $message }}</span>
                            @elseif( $message = Session::get('bank_store_message'))
                                <span class="text-center text-success">{{ $message }}</span>
                            @elseif( $message = Session::get('bank_update_message'))
                                <span class="text-center text-primary">{{ $message }}</span>
                            @endif
                        </div><hr/>
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 40%">
                                    <form method="POST" action="{{route('hrm.employeeBankInfo.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="employee_id" value="{{request('id')}}">

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Bank Name <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="bank_id" required>
                                                    <option value=""> -- select a bank -- </option>
                                                    @foreach($banks as $bank)
                                                        <option value="{{$bank->id}}">{{$bank->bank_name}} : {{$bank->branch}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Account No <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bank_account_number"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">A/c Name <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bank_account_name"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Routing No <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="routing"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-8">
                                                <div>
                                                    <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                    <button type="submit" class="btn btn-primary w-md">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td style="width: 60%;vertical-align: top">
                                    <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Bank</th>
                                            <th>Account No.</th>
                                            <th>Account Name</th>
                                            <th>Routing</th>
                                            <th>Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bankAccs as $bankAcc)
                                            <tr>
                                                <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                <td style="vertical-align: middle">{{$bankAcc->bank->bank_name}}</td>
                                                <td style="vertical-align: middle">{{$bankAcc->bank_account_number}}</td>
                                                <td style="vertical-align: middle">{{$bankAcc->bank_account_name}}</td>
                                                <td style="vertical-align: middle">{{$bankAcc->routing}}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <form action="{{route('hrm.employeeBankInfo.destroy', ['id' => $bankAcc->id])}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='social') active @endif" id="social" role="tabpanel">
                        <div class="card-header">Social Media Information
                            @if ($message = Session::get('social_destroy_message'))
                                <span class="text-center text-danger">{{ $message }}</span>
                            @elseif( $message = Session::get('social_store_message'))
                                <span class="text-center text-success">{{ $message }}</span>
                            @elseif( $message = Session::get('social_update_message'))
                                <span class="text-center text-primary">{{ $message }}</span>
                            @endif
                        </div><hr/>
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 45%">
                                    <form method="POST" action="{{route('hrm.employeeBankInfo.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="employee_id" value="{{request('id')}}">

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Social Media <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="social_media_id" required>
                                                    <option value=""> -- select a social media -- </option>
                                                    @foreach($socialMedias as $socialMedia)
                                                        <option value="{{$socialMedia->id}}">{{$socialMedia->social_media_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Profile Name <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="account_name"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Profile Url <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="account_url"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-8">
                                                <div>
                                                    <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                    <button type="submit" class="btn btn-primary w-md">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td style="width: 55%;vertical-align: top">
                                    <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Social Media</th>
                                            <th>Profile Name</th>
                                            <th>Profile URL</th>
                                            <th>Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($socialMediaInfos as $socialMediaInfo)
                                            <tr>
                                                <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                <td style="vertical-align: middle">{{$socialMediaInfo->socialMedia->social_media_name}}</td>
                                                <td style="vertical-align: middle">{{$socialMediaInfo->account_name}}</td>
                                                <td style="vertical-align: middle">{{$socialMediaInfo->account_url}}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <form action="{{route('hrm.employeeBankInfo.destroy', ['id' => $socialMediaInfo->id])}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane @if(Session::get('key')=='talent') active @endif" id="talent" role="tabpanel">
                        <div class="card-header">Talent / Skill Information
                            @if ($message = Session::get('talent_destroy_message'))
                                <span class="text-center text-danger">{{ $message }}</span>
                            @elseif( $message = Session::get('talent_store_message'))
                                <span class="text-center text-success">{{ $message }}</span>
                            @elseif( $message = Session::get('talent_update_message'))
                                <span class="text-center text-primary">{{ $message }}</span>
                            @endif
                        </div><hr/>
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 45%">
                                    <form method="POST" action="{{route('hrm.employeeTalentInfo.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="employee_id" value="{{request('id')}}">

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Talent Type <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="talent_id" required>
                                                    <option value=""> -- select a talent -- </option>
                                                    @foreach($talents as $talent)
                                                        <option value="{{$talent->id}}">{{$talent->talent_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Talent Details <span class="required text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="details"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-8">
                                                <div>
                                                    <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                                    <button type="submit" class="btn btn-primary w-md">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td style="width: 55%;vertical-align: top">
                                    <table class="table mb-0" style="width: 95%; font-size: 11px" align="right">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Talent Type</th>
                                            <th>Talent Details</th>
                                            <th>Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($talentInfos as $talentInfo)
                                            <tr>
                                                <th scope="row" style="vertical-align: middle">{{$loop->iteration}}</th>
                                                <td style="vertical-align: middle">{{$talentInfo->getTalent->talent_name}}</td>
                                                <td style="vertical-align: middle">{{$talentInfo->details}}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <form action="{{route('hrm.employeeBankInfo.destroy', ['id' => $talentInfo->id])}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="employee_id" value="{{request('id')}}">
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you confirm to delete?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
