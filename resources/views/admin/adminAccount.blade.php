@extends('layouts.master')

@section('title')
    Admin Account Management
@endsection

@section('content')
    <h3>User Management</h3>

    <div class="container-fluid">
        <div class="row" style="padding-top: 50px">
            <div class="row" style="padding-bottom: 20px; padding-left: 20px">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#createUser" aria-expanded="false" aria-controls="createUser" id="createUserBtn">
                    Create New User
                </button>
                <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#resetPwd" aria-expanded="false" aria-controls="resetPwd" id="resetPwdBtn">
                    Change Admin Password
                </button>

                <div class="collapse" id="createUser"> <!-- Create new User-->
                    <div class="row" style="padding-left: 20px">
                        <fieldset class="form-group">
                            <form action="" class="form-group" method="POST">
                                <legend>Create New User</legend>
                                <div class="row">
                                    <div class="col-md-6"> <!-- Create New User Well Column 1-->
                                        <label for="Username">Username: </label>
                                        <input type="text" name="userName" class="form-control" id="userNameField" required autofocus>
                                        <label for="name">Name: </label>
                                        <input type="text" name="name" class="form-control" id="nameField" required>
                                        <label for="email">Email: </label>
                                        <input type="email" name="email" class="form-control" id="emailField" required>
                                    </div> <!-- Create New User Well Column 1-->

                                    <div class="col-md-6"> <!-- Create New User Well Column 2-->
                                        <label for="password">Password: </label>
                                        <input type="password" name="password" class="form-control" id="passwordField" required>
                                        <label for="repeatPassword">Repeat Password: </label>
                                        <input type="password" name="passwordRepeat" class="form-control" id="passwordRepeatField">
                                    </div> <!-- Create New User Well Column 2-->
                                </div>
                            </form>
                        </fieldset>
                        <div class="row">
                            <button type="submit" id="createUserSubmitBtn" class="btn btn-info center-block">Submit</button>
                        </div>
                    </div>
                </div><!-- Create new User-->

                <div class="collapse" id="resetPwd">
                    <div class="row" style="padding-left: 20px">
                        <fieldset class="form-group">
                            <form action="" class="form-group" method="POST">
                                <legend>Change Admin Password</legend>
                                <div class="row">
                                    <div class="col-md-6"> <!-- Reset Password User Well Column 1-->
                                        <label for="currentPwd">Current Password: </label>
                                        <input type="password" name="currentPwd" class="form-control" id="currentPwdField" required autofocus>
                                        <label for="newPwd">New Password: </label>
                                        <input type="password" name="name" class="form-control" id="newPwdField" required>
                                        <label for="repNewPwd">Repeat New Password: </label>
                                        <input type="password" name="repNewPwd" class="form-control" id="repNewPwdField" required>
                                    </div> <!-- Reset Password Well Column 1-->
                                </div>
                            </form>
                        </fieldset>
                        <div class="row">
                            <button type="submit" id="pwdResetSubmitBtn" class="btn btn-info center-block">Reset</button>
                        </div>
                    </div>
            </div> <!-- Row 2 Div -->
        </div> <!-- Row 1 Div -->


        </div>


        <div class="row"> <!-- Table Row Div -->
            <h3>Users</h3>
            <div class="row" style="padding-left: 15px">
                <div class="table-responsive">
                    <table id="userTable" class="display" width="100%" title="Click a row to see Ticket Details" data-toggle="tooltip" data-placement="top">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- Table Row Div -->
    </div> <!-- Container Fluid -->

    <div class="modal fade" tabindex="-1" role="dialog" id="user-options-modal"> <!-- Row Click Modal-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="user-options-modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <span class="btn btn-lg btn-warning center-block" id="resetPasswordBtn">Reset User Password</span>
                    </div>
                    <div style="padding: 10px 0px 10px 0px">
                        <span class="btn btn-lg btn-danger center-block" id="deleteUserBtn">Delete User</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Confirmation Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="confirm-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="confirm-modal-title"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmBtn">Go Ahead</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancelConfirmBtn">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.Confirmation modal -->



@endsection

@section('scripts')
    <script>
        let session = "{{ Session::token() }}";
        const url_popUserTable = "{{ route('admin.popUserTable') }}";
        const url_createUser = "{{ route('admin.create') }}";
        const url_passwordReset = "{{ route('admin.adminPasswordReset') }}";
        const url_deleteUser = "{{ route('admin.delete') }}";
        const url_adminResetPwd = "{{ route('admin.resetUserPassword') }}";
        const url_login = "{{ route('home') }}";

        $(document).ready(function () {

            //button collapses
            $('#createUser').on('show.bs.collapse', function () {
                $('#resetPwd').collapse('hide');
            });
            $('#resetPwd').on('show.bs.collapse', function () {
                $('#createUser').collapse('hide');
            });


            //dataTables
            let table = $('#userTable').DataTable( {
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ajax: {
                    url: url_popUserTable,
                    dataSrc: ""
                },
                columns: [
                    { data: "id" },
                    { data: "username" },
                    { data: "name" },
                    { data: "email" }
                ]
            });//dataTables

            //Create User
            $('#createUserSubmitBtn').on('click', function (e) {
                e.preventDefault();
                let userName = $('#userNameField').val();
                let name = $('#nameField').val();
                let email = $('#emailField').val();
                let pass = $('#passwordField').val();
                let passRep = $('#passwordRepeatField').val();

                if (pass == passRep)
                {
                    $.ajax({
                        method: "POST",
                        url: url_createUser,
                        data: {
                            username        : userName,
                            name            : name,
                            email           : email,
                            password        : pass,
                            passwordRepeat  : passRep,
                            _token          : session
                        },
                        success: function () {
                            $('#userTable').DataTable().ajax.reload();
                            $('#createUser').collapse('toggle');
                            alert('Record was successfully created');
                            $('#userNameField').val("");
                            $('#nameField').val("");
                            $('#emailField').val("");
                            $('#passwordField').val("");
                            $('#passwordRepeatField').val("");
                        },
                        error: function () {
                            alert('There was an error creating the record');
                        }
                    });//ajax
                }
                else
                {
                    alert('Password Mismatch');
                    $('#passwordField').val("");
                    $('#passwordRepeatField').val("");
                }
            });//create user

            //Admin Password Reset
            $('#pwdResetSubmitBtn').off('click').on('click', function () {
                let currentPwd = $('#currentPwdField').val();
                let newPwd = $('#newPwdField').val();
                let repNewPwd = $('#repNewPwdField').val();

                if(newPwd != repNewPwd)
                {
                    alert('Passwords do not match please try again');
                    $('#currentPwdField').val("");
                    $('#newPwdField').val("");
                    $('#repNewPwdField').val("");
                }
                else if (currentPwd == "" || newPwd == "" || repNewPwd == ""){
                    alert('All fields are required please try again');
                    $('#currentPwdField').val("");
                    $('#newPwdField').val("");
                    $('#repNewPwdField').val("");
                }
                else {
                    $.ajax({
                        method: "POST",
                        url: url_adminResetPwd,
                        data: {
                            currentPwd : currentPwd,
                            newPwd : newPwd,
                            repNewPwd : repNewPwd,
                            _token: session
                        },
                        success: function () {
                            alert('Password was successfully Reset. Please re-login');
                            location= url_login;
                        },
                        error: function () {
                            alert('There was an error in resetting your password please contact SuperAdmin')
                            $('#currentPwdField').val("");
                            $('#newPwdField').val("");
                            $('#repNewPwdField').val("");
                        }
                    });//ajax
                }

            });//Admin Password Reset


            //Row Click
            $('#userTable').off('click').on('click', 'tr', function () {
                let rowData = table.row(this).data();

                let userId = rowData.id;
                let userName = rowData.username;
                let name = rowData.name;
                let email = rowData.email;

                if (userName != 'admin')
                {
                    $('#user-options-modal-title').html('Options for '+userName);
                    $('#user-options-modal').modal();
                }
                else {
                    alert('You cannot change admin!!')
                }

                //Reset User Password Btn
                $('#resetPasswordBtn').off('click').on('click', function () {
                    $('#confirm-modal').modal();
                    $('#confirm-modal-title').html('Are you sure you want to reset the password of "'+userName+'"?');
                    $('#confirmBtn').off('click').on('click', function () {
                        $.ajax({
                            method: "POST",
                            url: url_passwordReset,
                            data: {
                                username : userName,
                                _token : session
                            },
                            success: function () {
                                $('#confirm-modal').modal('hide');
                                $('#user-options-modal').modal('hide');
                                alert('Password Reset to "password", please set new password')
                            },
                            error: function () {
                                $('#confirm-modal').modal('hide');
                                $('#user-options-modal').modal('hide');
                                alert('There was a problem reseting the password, please try again')
                            }
                        });//ajax
                    });//confirm Reset
                });//Reset User Password Btn

                //Delete User Button
                $('#deleteUserBtn').off('click').on('click', function () {
                    $('#confirm-modal').modal();
                    $('#confirm-modal-title').html('Are you sure you want to delete user "'+userName+'"?');
                    $('#confirmBtn').off('click').on('click', function () {
                        $.ajax({
                            method: "POST",
                            url: url_deleteUser,
                            data: {
                                username : userName,
                                _token : session
                            },
                            success: function () {
                                $('#userTable').DataTable().ajax.reload();
                                $('#confirm-modal').modal('hide');
                                $('#user-options-modal').modal('hide');
                                alert('User Deleted')
                            },
                            error: function () {
                                $('#confirm-modal').modal('hide');
                                $('#user-options-modal').modal('hide');
                                alert('There was a problem deleting the user, please try again')
                            }
                        });//ajax
                    });//confirm Delete
                });//Delete User Button


            });//Row Click
        });//Document Ready
    </script>
@endsection