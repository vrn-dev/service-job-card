@extends('layouts.master')

@section('title')
    User Account Management
@endsection

@section('content')
    <h3>Account Management</h3>
    <div class="container-fluid">
        <div class="row" style="padding-top: 50px">
            <div class="row" style="padding-bottom: 20px; padding-left: 20px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Password</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="change-pwd-form">
                            <div class="form-group">
                                <label for="currentPwdField" class="col-sm-2 control-label">Current Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="currentPwdField" placeholder="Current Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newPwdField" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="newPwdField" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repPwdField" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="repPwdField" placeholder="Repeat Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-default btn-info" id="changePwdSubmitBtn">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- Password Panel-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Email</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="change-email-form">
                            <div class="form-group">
                                <label for="currentEmail" class="col-sm-2 control-label">Current Email</label>
                                <div class="col-sm-6">
                                    <p class="form-control" style="margin-top: 10px">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="emailField" class="col-sm-2 control-label">New Email</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="emailField" placeholder="New Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-default btn-info" id="changeEmailSubmitBtn">Change Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- Password Panel-->
            </div> <!-- Container Fluid -->
        </div><!-- Row 1 -->
    </div><!-- Row 2 -->
@endsection

@section('scripts')
    <script>
        const session = '{{ Session::token() }}';
        const url_changePwd = '{{ route('admin.userChangePassword') }}';
        const url_changeEmail = '{{ route('admin.userChangeEmail') }}';
        const url_login = '{{ route('login') }}';
        const userName = '{{ Auth::user()->username }}';
        const email = '{{ Auth::user()->email }}'

        $(document).ready(function () {
            $('#changePwdSubmitBtn').off('click').on('click', function (event) {
                event.preventDefault();
                let currentPwd = $('#currentPwdField').val();
                let newPwd = $('#newPwdField').val();
                let repPwd = $('#repPwdField').val();

                if(newPwd != repPwd)
                {
                    alert('Passwords do not match please try again');
                    $('#currentPwdField').val("");
                    $('#newPwdField').val("");
                    $('#repPwdField').val("");
                }
                else if (currentPwd == "" || newPwd == "" || repPwd == ""){
                    alert('All fields are required please try again');
                    $('#currentPwdField').val("");
                    $('#newPwdField').val("");
                    $('#repPwdField').val("");
                }
                else {
                    $.ajax({
                        method: "POST",
                        url: url_changePwd,
                        data: {
                            userName : userName,
                            currentPwd : currentPwd,
                            newPwd : newPwd,
                            repPwd : repPwd,
                            _token : session
                        },
                        success: function () {
                            alert('Password was successfully Reset. Please re-login');
                            location= url_login;
                        },
                        error: function () {
                            alert('There was an error in resetting your password please contact SuperAdmin')
                            $('#currentPwdField').val("");
                            $('#newPwdField').val("");
                            $('#repPwdField').val("");
                        }
                    });//ajax
                }
            });//Change password

            //Change Email
            $('#changeEmailSubmitBtn').off('click').on('click', function (event) {
                event.preventDefault();
                let newEmail = $('#emailField').val();
                if( newEmail == email)
                {
                    alert('Emails are the same')
                }
                else {
                    $.ajax({
                        method: "POST",
                        url: url_changeEmail,
                        data: {
                            userName : userName,
                            newEmail : newEmail,
                            _token : session
                        },
                        success: function () {
                            alert('Email was successfully changed. Please re-login');
                            location= url_login;
                        },
                        error: function () {
                            alert('There was an error in resetting your password please contact SuperAdmin')
                            $('#emailField').val("");
                        }
                    });//ajax
                }
            });//Change Email
        });//Document Ready
    </script>
@endsection