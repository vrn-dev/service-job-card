@extends('layouts.master')

@section('title')
    Company Directory
@endsection

@section('content')
    @include('includes.message-block')
    <h3>Company Directory</h3>
    <div class="container-fluid">
        <div class="row" style="padding-top: 50px">
            <div class="row" style="padding-bottom: 20px; padding-right: 20px">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#createCompany" aria-expanded="false" aria-controls="createCompany" id="createCompanyBtn" style="margin-left: 15px">
                    Create New Company
                </button>

                <div class="collapse" id="createCompany">
                    <row>
                        <fieldset class="form-group">
                            <form action="" class="form-group" method="POST" id="createCompanyForm">
                                <legend>Create New Company</legend>
                                <row>
                                    <div class="col-md-6"> <!-- Create Company Well Column 1-->
                                        <label for="companyName">Company Name</label>
                                        <input type="text" name="companyName" class="form-control" id="companyNameField" required autofocus>
                                        <label for="contactName">Contact Name</label>
                                        <input type="text" name="contactName" class="form-control" id="contactNameField" required>
                                        <label for="contactTel">Contact Telephone</label>
                                        <input type="text" name="contactTel" class="form-control" id="contactTelField">
                                        <label for="contactMobile">Contact Mobile</label>
                                        <input type="text" name="contactTel" class="form-control" id="contactMobileField" required>


                                    </div> <!-- Create Company Well Column 1-->

                                    <div class="col-md-6"> <!-- Create Company Well Column 2-->
                                        <label for="contactEmail">Contact Email</label>
                                        <input type="email" name="contactEmail" class="form-control" id="contactEmailField" required>
                                        <label for="selectCity">Select City</label>
                                        <select class="form-control" id="selectCity" name="selectCity" required>
                                            <option value=""> === Select a City === </option>
                                            <option value="Dubai">Dubai</option>
                                            <option value="Abu Dhabi">Abu Dhabi</option>
                                            <option value="Sharjah">Sharjah</option>
                                            <option value="Ajman">Ajman</option>
                                            <option value="Umma al-Quwain">Umm al-Quwain</option>
                                            <option value="Ras al-Khaimah">Ras al-Khaimah</option>
                                            <option value="Fujairah">Fujairah</option>
                                        </select>
                                        <label for="selectCountry">Select Country</label>
                                        <select name="selectCountry" id="selectCountry" class="form-control">
                                            <option value=""> === Select Country ===</option>
                                            <option value="Oman">Oman</option>
                                            <option value="UAE">United Arab Emirates</option>
                                        </select>
                                        <label for="address">Address</label><br>
                                        <textarea name="address" id="address" style="width: 100%"
                                                  rows="5"></textarea>
                                    </div> <!-- Create Company Well Column 2-->
                                </row>
                            </form>
                        </fieldset>
                        <row>
                            <button type="submit" id="createCompanySubmitBtn" class="btn btn-info center-block">Submit</button>
                        </row>
                    </row>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="display" id="companyTable" width="100%" title="Click a row to see Company Details" data-toggle="tooltip" data-placement="top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>City</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> <!-- row div -->
    </div> <!-- container div -->

    <!-- Edit Company Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="company-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="company-modal-title"></h4>
                </div>
                    <div class="modal-body">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="companyName" class="col-sm-3 control-label">Company Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="companyName" id="company-name-modal" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="companyName" class="col-sm-3 control-label">Contact Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contactName" id="contact-name-modal" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contactTel" class="col-sm-3 control-label">Contact Tel</label>
                                <div class="col-sm-9">
                                    <input type="text" class="col-sm-9 form-control" name="contactTel" id="contact-tel-modal" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contactMobile" class="col-sm-3 control-label">Contact Mobile</label>
                                <div class="col-sm-9">
                                    <input type="text" class="col-sm-9 form-control" name="contactMobile" id="contact-mobile-modal" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contactEmail" class="col-sm-3 control-label">Company Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contactEmail" id="contact-email-modal" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-sm-3 control-label">City</label>
                                <div class="col-sm-9" style="margin-top: 10px">
                                    <select name="city" id="city-modal" class="form-control" disabled>
                                        <option value="" selected> === Select City ===</option>
                                        <option value="Dubai">Dubai</option>
                                        <option value="Abu Dhabi">Abu Dhabi</option>
                                        <option value="Sharjah">Sharjah</option>
                                        <option value="Ajman">Ajman</option>
                                        <option value="Umma al-Quwain">Umm al-Quwain</option>
                                        <option value="Ras al-Khaimah">Ras al-Khaimah</option>
                                        <option value="Fujairah">Fujairah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country" class="col-sm-3 control-label">Country</label>
                                <div class="col-sm-9" style="margin-top: 10px">
                                    <select name="country" id="country-modal" class="form-control" disabled>
                                        <option value="" selected> === Select Country ===</option>
                                        <option value="Oman">Oman</option>
                                        <option value="UAE">United Arab Emirates</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" id="address-modal" rows="5" placeholder="Enter Address" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="company-modal-footer">
                        @if(Auth::user()->username == 'admin')
                        <button type="button" class="btn btn-primary" id="company-modal-edit-btn">Edit Details</button>
                        <button type="button" class="btn btn-danger" id="company-modal-delete-btn">Delete Record</button>
                        @endif
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="company-modal-close-btn">Close</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Edit Company Modal -->

    <!-- Confirmation Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-confirm-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="delete-confirm-title"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="canelDelete">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.Confirmation modal -->


@endsection

@section('scripts')
    <script>
        let session = '{{ Session::token() }}';
        const url_popCoTable = '{{ route('company.popTable') }}';
        const url_createCo = '{{ route('company.create') }}';
        const url_editCo = '{{ route('company.edit') }}';
        const url_deleteCo = '{{ route('company.delete') }}';


        $( "#companyTable" ).tooltip({
            delay: 100
        });

        //chosen select plugin
        $('#selectCity').chosen({width: '100%'});
        $('#selectCountry').chosen({width: '100%'});
        $('#country-modal').chosen({width: '100%'});
        $('#city-modal').chosen({width: '100%'});


        $(document).ready(function () {
            const clone = $('#company-modal-footer').html();
            $('#company-modal').on('hidden.bs.modal', function () {
                $('#company-name-modal').prop('disabled', true);
                $('#contact-name-modal').prop('disabled', true);
                $('#contact-tel-modal').prop('disabled', true);
                $('#contact-mobile-modal').prop('disabled', true);
                $('#contact-email-modal').prop('disabled', true);
                $('#city-modal').prop('disabled', true).trigger('chosen:updated');
                $('#country-modal').prop('disabled', true).trigger('chosen:updated');
                $('#address-modal').prop('disabled', true);
                $('#company-modal').prop('disabled', true);
                $('#company-modal-footer').html(clone);
            });

                //create company submit
            $('#createCompanySubmitBtn').on('click', function (e) {
                e.preventDefault();
                let companyName = $('#companyNameField').val();
                let contactName = $('#contactNameField').val();
                let contactTel = $('#contactTelField').val();
                let contactMobile = $('#contactMobileField').val();
                let contactEmail = $('#contactEmailField').val();
                let city = $('#selectCity').val();
                let country = $('#selectCountry').val();
                let add = $('#address').val();

                $.ajax({
                    method: "POST",
                    url: url_createCo,
                    data: {
                        companyName     : companyName,
                        contactName     : contactName,
                        contactTel      : contactTel,
                        contactMobile   : contactMobile,
                        contactEmail    : contactEmail,
                        city            : city,
                        country         : country,
                        address         : add,
                        _token          : session
                    },
                    success: function () {
                        $('#companyTable').DataTable().ajax.reload();
                        $('#createCompany').collapse('toggle');
                        alert('Record was successfully created');
                        $('#companyNameField').val("");
                        $('#contactNameField').val("");
                        $('#contactTelField').val("");
                        $('#contactMobileField').val("");
                        $('#contactEmailField').val("");
                        $('#selectCity').val("").trigger('chosen:updated');
                        $('#selectCountry').val("").trigger('chosen:updated');
                        $('#address').val("");
                    },
                    error: function () {
                        alert('There was an error creating the record');
                    }
                });//ajax
            });//create company submit

            //dataTables
            let table = $('#companyTable').DataTable( {
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ajax: {
                    url: url_popCoTable,
                    dataSrc: ""
                },
                columns: [
                    { data: "id" },
                    { data: "companyName" },
                    { data: "contactName" },
                    { data: "contactMobile" },
                    { data: "contactEmail" },
                    { data: "city" },
                ]
            });//dataTables

            //Company Row info on Click
            $('#companyTable').off('click').on('click', 'tr', function () {
                let rowData = table.row(this).data();

                let companyId = rowData.id;
                let companyName = rowData.companyName;
                let contactName = rowData.contactName;
                let contactTel = rowData.contactTel;
                let contactMobile = rowData.contactMobile;
                let contactEmail = rowData.contactEmail;
                let city = rowData.city;
                let country = rowData.country;
                let address = rowData.address;

                $('#company-modal-title').html('Details for '+companyName);
                $('#company-name-modal').val(companyName);
                $('#contact-name-modal').val(contactName);
                $('#contact-tel-modal').val(contactTel);
                $('#contact-mobile-modal').val(contactMobile);
                $('#contact-email-modal').val(contactEmail);
                $('#city-modal').val(city).trigger('chosen:updated');
                $('#country-modal').val(country).trigger('chosen:updated');
                $('#address-modal').val(address);
                $('#company-modal').modal();

                //Edit Company
                $('#company-modal-edit-btn').off('click').on('click', function (event) {
                    event.preventDefault;
                    $('#company-name-modal').prop('disabled', false);
                    $('#contact-name-modal').prop('disabled', false);
                    $('#contact-tel-modal').prop('disabled', false);
                    $('#contact-mobile-modal').prop('disabled', false);
                    $('#contact-email-modal').prop('disabled', false);
                    $('#city-modal').prop('disabled', false).trigger('chosen:updated');
                    $('#country-modal').prop('disabled', false).trigger('chosen:updated');
                    $('#address-modal').prop('disabled', false);
                    $('#company-modal').prop('disabled', false);
                    $('#company-modal-footer').html('<button type="button" class="btn btn-warning" id="company-modal-save-btn">Save Changes</button> <button type="button" class="btn btn-default" data-dismiss="modal" id="edit-close-btn">Close</button>');

                    //Edit Company Save Changes
                    $('#company-modal-save-btn').off('click').on('click', function (event) {
                        event.preventDefault;
                        let newCompanyName = $('#company-name-modal').val()
                        let newContactName = $('#contact-name-modal').val();
                        let newContactTel = $('#contact-tel-modal').val();
                        let newContactMobile = $('#contact-mobile-modal').val();
                        let newContactEmail = $('#contact-email-modal').val();
                        let newCity = $('#city-modal').val();
                        let newCountry = $('#country-modal').val();
                        let newAddress = $('#address-modal').val();
                        $.ajax({
                            method: "POST",
                            url: url_editCo,
                            data: {
                                companyId       : companyId,
                                companyName     : newCompanyName,
                                contactName     : newContactName,
                                contactTel      : newContactTel,
                                contactMobile   : newContactMobile,
                                contactEmail    : newContactEmail,
                                city            : newCity,
                                country         : newCountry,
                                address         : newAddress,
                                _token          : session
                            },
                            success: function () {
                                $('#companyTable').DataTable().ajax.reload();
                                $('#company-modal').modal('hide');
                                $('#company-name-modal').prop('disabled', true);
                                $('#contact-name-modal').prop('disabled', true);
                                $('#contact-tel-modal').prop('disabled', true);
                                $('#contact-mobile-modal').prop('disabled', true);
                                $('#contact-email-modal').prop('disabled', true);
                                $('#city-modal').prop('disabled', true).trigger('chosen:updated');
                                $('#country-modal').prop('disabled', true).trigger('chosen:updated');
                                $('#address-modal').prop('disabled', true);
                                $('#company-modal').prop('disabled', true);
                                $('#company-footer-modal').html(clone);
                                alert('Record successfully altered');
                            },
                            error: function () {
                                //$('#company-modal').modal('hide');
                                $('#company-footer-modal').html(clone);
                                alert('An error occured while editing record, please check all fields');
                            }
                        });//ajax
                    }); //Edit Company Save Changes
                });//Edit Company

                //Delete Company
                $('#company-modal-delete-btn').off('click').on('click', function (event) {
                    event.preventDefault();
                    $('#delete-confirm-modal').modal();
                    $('#delete-confirm-title').html("Are you Sure you want to Delete  "+ companyName);
                    $('#confirmDelete').off('click').on('click', function () {
                        console.log('clicked ' + companyName)
                        $.ajax({
                            method: "GET",
                            url: url_deleteCo,
                            data: {
                                companyId: companyId
                            },
                            success: function () {
                                $('#companyTable').DataTable().ajax.reload();
                                alert(companyName + ' Successfully Deleted')
                                $('#delete-confirm-modal').modal('hide');
                                $('#company-modal').modal('hide');
                            }
                        });//ajax
                    });//#confirm delete
                });//Delete Company
            });//Company Row info on Click
        });//Doc Ready
    </script>
@endsection