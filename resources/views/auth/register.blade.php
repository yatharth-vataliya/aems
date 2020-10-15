@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registration_no') ? 'hass-error' : '' }}">
                            <label for="registration-no" class="col-md-4 control-label">Registration No</label>

                            <div class="col-md-6">
                                <input id="registration_no" type="text" class="form-control" name="registration_no" required>

                                @if ($errors->has('registration_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('registration_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? 'hass-error' : '' }}">
                            <label for="registration-no" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                Male <input id="gender" type="radio" name="gender" value="male" required>
                                Female <input id="gender" type="radio" name="gender" value="female" required>

                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('college') ? 'hass-error' : '' }}">
                            <label for="college" class="col-md-4 control-label">College</label>

                            <div class="col-md-6">
                                <select name="college" id="college" class="form-control" onchange="getDepartment(this.value)" required>
                                    <option value="">--select--</option>
                                    @foreach($colleges as $college)
                                    <option value="{{$college->college_name}}">{{$college->college_name}}</option>
                                    @endforeach
                                    
                                </select>

                                @if ($errors->has('college'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('college') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? 'hass-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <select id="department" name="department" onchange="getCourse(this.value)" class="form-control" required>
                                    <option value="">--select--</option>
                                </select>

                                @if ($errors->has('department'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('course') ? 'hass-error' : '' }}">
                            <label for="registration-no" class="col-md-4 control-label">Course</label>

                            <div class="col-md-6">
                                <select name="course" id="courses" class="form-control" required>
                                    <option value="">--select--</option>
                                </select>

                                @if ($errors->has('course'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? 'hass-error' : '' }}">
                            <label for="registration-no" class="col-md-4 control-label">Mobile No</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" required>

                                @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

 function getDepartment(college){
    $.ajax({
        url: '{{ route("getDepartment") }}',
        type: 'POST',
            // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
            data: {'_token' : $('input[name=_token]').val(),'collegeName': college},
            success:function(data){
                $("#department").html(data);
            },
        });        
}

function getCourse(department){
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("getCourse") }}',
            type: 'POST',
            // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
            data: {'_token' : $('input[name=_token]').val(),'collegeName':$("#college").val(),'department':department },
            success:function(data){
                $("#courses").html(data);
            },
        });            
    });
}    

</script>
@endsection