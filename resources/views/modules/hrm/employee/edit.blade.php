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
                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Personal</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#contact" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Contact</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#job" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Job</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#family" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Family</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#education" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Education</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#employment" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Employment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supervisor" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Supervisor</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#documents" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Documents</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#language" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Language</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bank" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Bank</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#socialmedia" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Social</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#talent" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Talent</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="personal" role="tabpanel">
                        <form method="POST" action="@if(request('id')>0) {{route('hrm.employee.update', ['id'=>$employee->id])}} @else {{route('hrm.employee.store')}} @endif" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <div class="card-header">Personal Basic Information</div><hr/>
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
                    <div class="tab-pane" id="contact" role="tabpanel">
                        <form method="POST" action="@if(request('id')>0) {{route('hrm.employee.update', ['id'=>$employee->id])}} @else {{route('hrm.employee.store')}} @endif" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="entry_by" value="{{ Auth::user()->id }}">
                            <div class="card-header">Contact Information</div><hr/>
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        <div class="col-lg-12">
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Mobile <span class="required text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="mobile" @if(request('id')>0) value="{{$employee->mobile}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Alternative Mobile</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="alternative_mobile" @if(request('id')>0) value="{{$employee->alternative_mobile}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="email" @if(request('id')>0) value="{{$employee->email}}" @endif class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-12">
                                            <p><strong><u>Present Address</u></strong></p>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Address <span class="required text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address" @if(request('id')>0) value="{{$employee->present_address}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">Country</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="marital_status">
                                                        <option value=""> -- select a country -- </option>
                                                        <option value="50"> Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-4 col-form-label">State</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="present_address_state" @if(request('id')>0) value="{{$employee->present_address_state}}" @endif class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-12">
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Mobile <span class="required text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="mobile" @if(request('id')>0) value="{{$employee->mobile}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Alternative Mobile</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="alternative_mobile" @if(request('id')>0) value="{{$employee->alternative_mobile}}" @endif class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" @if(request('id')>0) value="{{$employee->email}}" @endif class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>





                            <div class="form-group row justify-content-end">
                                <div class="col-sm-6">
                                    <div>
                                        <a class="btn btn-danger" href="{{route('hrm.employee.view')}}">Cancel</a>
                                        <button type="submit" class="btn btn-primary w-md">@if(request('id')) Update @else Save @endif</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="tab-pane" id="job" role="tabpanel">
                        <p class="mb-0">this is job section
                        </p>
                    </div>
                    <div class="tab-pane" id="family" role="tabpanel">
                        <p class="mb-0">this is family section
                        </p>
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
