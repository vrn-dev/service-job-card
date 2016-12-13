@extends('layouts.master')

@section('title')
    Ticket Generator
@endsection
@section('styles')
    <style>
        td.highlight {
            font-weight: bold;
            color: blue;
        }
    </style>
@endsection

@section('content')
    @include('includes.message-block')
    <h1>Ticket Generator</h1>
    <div class="container-fluid">
        <div class="row" style="padding-top: 50px">
            <div class="row" style="padding-bottom: 20px; padding-left: 20px">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#createTicket" aria-expanded="false" aria-controls="createTicket" id="createTicketBtn">
                    Create Ticket
                </button>

                <div class="collapse" id="createTicket">
                    <row>
                        <fieldset class="form-group">
                            <form action="" class="form-group" method="POST" id="createTicketForm">
                                <legend>Generate Ticket</legend>
                                <row>
                                    <div class="col-md-6"> <!-- Generate Ticket Well Column 1-->
                                        <label for="ticketNumber">Ticket #</label>
                                        <input type="text" name="ticketNumber" class="form-control" id="ticketNumberField" readonly>
                                        <label for="selectCo">Select Company</label>
                                        <select id="selectCo" name="selectCo">
                                            <option value=""> === Select a Company === </option>
                                            @foreach($companySelect as $item)
                                                <option value="{{ $item->id }}"> {{ $item->companyName }} </option>
                                            @endforeach
                                        </select>
                                        <label for="assetCo">Company Assets</label>
                                        <div id="assetCo" style="border: 1px solid darkgrey; box-shadow: 3px 3px darkgrey; padding: 5px 10px 5px 15px">
                                            <p style="color: lightgrey">Please chose a company</p>
                                        </div>
                                    </div> <!-- Generate Ticket Well Column 1-->

                                    <div class="col-md-6"> <!-- Generate Ticket Well Column 2-->
                                        <label for="issueDate">Enter Date of Issue</label>
                                        <input type="date" name="issueDate" class="form-control" id="issueDate">
                                        <label for="issueCategory">Issue Category</label>
                                        <select name="issueCategory" id="issueCategorySelect">
                                            <option value="Critical System Down">Critical System Down</option>
                                            <option value="Critical">Critical</option>
                                            <option value="Major">Major</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Minor">Minor</option>
                                        </select>
                                        <label for="issueDescription">Issue Description</label><br>
                                        <textarea name="issueDescription" id="issueDescription" style="width: 100%"
                                                  rows="5"></textarea>

                                        <!-- TODO: Add AssignToUser and schedule Date-->


                                    </div> <!-- Generate Ticket Well Column 2-->
                                </row>
                            </form>
                        </fieldset>
                            <row>
                                <button type="submit" id="createTicketSubmitBtn" class="btn btn-info center-block">Submit</button>
                            </row>
                    </row>

                </div>

            </div> <!-- Row 2 Div -->
        </div> <!-- Row 1 Div -->
        <div class="row"> <!-- Table Row Div -->
            <h3>Ticket History</h3>
            <div class="row" style="padding-left: 15px">
                <table id="ticketTable" class="display" width="100%" title="Click a row to see Ticket Details" data-toggle="tooltip" data-placement="top">
                    <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Company</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div> <!-- Table Row Div -->
    </div> <!-- Container: Fluid -->


    <!-- Ticket Peek Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="peek-modal"> <!-- TODO : Add assignedTo and scheduled date into modal-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Company Details</h4>
                </div>
                <div class="modal-body peek-modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">

                            <label class="col-sm-3 control-label">Company Name</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-co-name" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Inventory Model</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-inventory-model" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Inventory Serial</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-inventory-serial" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Issue Description</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-issue-description" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Name</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-contact-name" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Mobile</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-contact-mobile" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Email</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-contact-email" style="font-weight: 300"> </p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-warning" id="createJobCardBtn">Create a Job Card</a>
                    <a href="#" class="btn btn-danger" id="deleteTicketBtn">Delete this Ticket</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Ticket Peek Modal -->

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

        //json vars
        var table;
        var url_popAsset = "{{ route('ticket.sendJson') }}";
        var session = '{{ Session::token() }}';
        var url_popTicketId = "{{ route('ticket.getTicketId') }}";
        var url_popTable = "{{ route('ticket.popTable') }}";
        var url_createTicket = "{{ route('ticket.create') }}";
        // var url_popPostPeekModal = " route('ticket.postPeekModal') }}";
        var url_popGetPeekModal = "{{ route('ticket.getPeekModal') }}";
        var url_deleteTicket = "{{ route('ticket.getDeleteTicket') }}";
        var url_sjcCreateForm = "{{ route('sjc.createForm') }}"; //TODO: Change route to jobCard


        $( "#ticketTable" ).tooltip({
            delay: 100
        });

        // Set animation for blinker
        function blinker() {
            $('.blink').fadeOut(500).fadeIn(500);
        }
        setInterval(blinker, 1000);

        //chosen select plugin
        $('#selectCo').chosen({width: '100%'});
        $('#issueCategorySelect').chosen({width: '100%'});


        //doc ready
        $(document).ready(function () {
            //populate ticket number
            $('#createTicketBtn').on('click', function () {
                $.ajax({
                    method: "GET",
                    url: url_popTicketId,
                    success: function (data){
                        $('#ticketNumberField').val(data);
                    }
                });
            });

            //submit Create Ticket
            $('#createTicketSubmitBtn').on('click', function (e) {
                e.preventDefault();
                var companyId= $('#selectCo').find('option:selected').val();
                //var companyName= $('#selectCo option:selected').text();
                var assetId = $('input[name=assetCoRadio]:checked').val();
                var issueDate = $('input[name=issueDate]').val();
                var issueCatagory = $('#issueCategorySelect').find('option:selected').val();
                var issueDescription = $('#issueDescription').val();

                /*console.log("Submit Co Id: "+companyId);
                //console.log("Submit Co Name: "+companyName);
                console.log("Submit Co Asset Id: "+assetId);
                console.log("Submit Co Issue Date: "+issueDate);
                console.log("Submit Co Issue Category: "+issueCatagory);
                console.log("Submit Co Issue Description: "+issueDescription);*/
                $.ajax({
                    method: "POST",
                    url: url_createTicket,
                    data:{
                        companyId:        companyId,
                        assetId:          assetId,
                        issueDate:        issueDate,
                        issueCategory:    issueCatagory,
                        issueDescription: issueDescription,
                        _token:           session
                    },
                    success: function () {
                        $('#ticketTable').DataTable().ajax.reload();
                        /*$('#selectCo').val("");
                        $('#assetCo').val("");
                        $('#issueDate').val("");
                        $('#issueCategorySelect').val("");
                        $('#issueDescription').val("");*/
                        $('#createTicket').collapse('toggle');
                        alert('Ticket was successfully generated');
                        $('#assetCo').empty().html('<p style="color: lightgrey">No Inventories Listed - Please chose another company</p>');
                        $('#selectCo').val('').trigger('chosen:updated');
                        $('#ticketNumberField').val('');
                        $('#issueDate').val("");
                        $('#issueCategorySelect').val("").trigger('chosen:updated');
                        $('#issueDescription').val("");
                    }
                });

            });

            //populate company inventory info
            $('#selectCo').on('change', function () {
                var coSelectId = $(this).val();
                //console.log("selected Company id :"+coSelectId);
                $.ajax({
                    method: "POST",
                    url: url_popAsset,
                    data: {
                        idVal: coSelectId,
                        _token: session
                    },
                    success: function (data) {
                        /*console.log("array count: "+data.length);
                        console.log(data[0].machine_model);
                        console.log(data[0].machine_serial);
                        console.log(data[0].id);
                        console.log(data);*/
                        if(data.length > 0) {
                            $('#assetCo').empty();
                            for (var i = 0; i < (data.length); i++) {
                                //console.log('data.id: '+data[i].id);
                                $('#assetCo').append("<input type='radio' name='assetCoRadio' id='assetCoRadio' value='" + data[i].id + "'> " + data[i].machine_model + " || " + data[i].machine_serial + "<br>");
                            }
                        }
                        else {
                            $('#assetCo').html('<p style="color: lightgrey">No Inventories Listed - Please chose another company</p>');
                        }
                    }
                });
            });

            //dataTables
            var table = $('#ticketTable').DataTable( {
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                ajax: {
                    url: url_popTable,
                    dataSrc: ""
                },
                columns: [
                    { data: "id" },
                    { data: "company_name" },
                    { data: "issue_date" },
                ],
                columnDefs: [{
                    targets: 4,
                    data: "status",
                    render: function (data, type, full, meta) {
                        if (data == "Active")
                        {
                            return '<span style="color: red">Active</span>'
                        }
                        else if (data == "Not Active")
                        {
                            return '<span style="color: green">Not Active</span>'
                        }
                        else
                        {
                            return '<span style="color: blue">No Data</span>'
                        }
                    }
                },
                    {
                        targets: 3,
                        data: "issue_category",
                        render: function (data, type, full, meta) {
                            if (data == 'Critical System Down')
                            {
                                return '<span class="blink" style="color: red">Critical System Down</span>'
                            }
                            else if (data == 'Critical')
                            {
                                return '<span style="color: red">Critical</span>'
                            }
                            else if (data == 'Major')
                            {
                                return '<span style="color: darkorange">Major</span>'
                            }
                            else if (data == 'Medium')
                            {
                                return '<span style="color: #D6C10D">Medium</span>'
                            }
                            else if (data == 'Minor')
                            {
                                return '<span style="color: darkviolet">Minor</span>'
                            }
                            else return '<span style="color: blue">No Data</span>'
                        }
                    }]
            });





            //Ticket Row info on Click
            $('#ticketTable').off('click').on('click', 'tr', function () {
                let rowData = table.row(this).data();
                /*console.log(rowData);
                console.log(rowData.company_name);
                console.log(rowData.company_id);*/
                let coId = rowData.company_id;
                let ticketId = rowData.id;
                let peekTicketId = null;
                let peekTicketIssueDate = null;
                let peekAddress = null;
                let peekCoName = null; //
                let peekInventoryModel = null; //
                let peekInventorySerial = null; //
                let peekIssueDescription = null;
                let peekContactName = null; //
                let peekContactMobile = null; //
                let peekContactEmail = null;//
                $.ajax({
                    method: "GET",
                    url: url_popGetPeekModal,
                    data: {
                        companyId: coId,
                        ticketId: ticketId
                    },
                    success: function (data) {
                        //console.log(data);
                        /*console.log('Data.company.contactName = '+data.company.contactName);
                        console.log('Data.ticket.asset_model = '+data.ticket.asset_model);*/
                        peekTicketId = data.ticket.id;
                        peekTicketIssueDate = data.ticket.issue_date;
                        peekAddress = data.company.address;
                        peekCoName = data.company.companyName;
                        peekInventoryModel = data.ticket.asset_model;
                        peekInventorySerial = data.ticket.asset_serial;
                        peekIssueDescription = data.ticket.issue_details;
                        peekContactName = data.company.contactName;
                        peekContactMobile = data.company.contactMobile;
                        peekContactEmail = data.company.contactEmail;

                        $('#peek-co-name').html(peekCoName);
                        $('#peek-inventory-model').html(peekInventoryModel);
                        $('#peek-inventory-serial').html(peekInventorySerial);
                        $('#peek-issue-description').html(peekIssueDescription);
                        $('#peek-contact-name').html(peekContactName);
                        $('#peek-contact-mobile').html(peekContactMobile);
                        $('#peek-contact-email').html(peekContactEmail);
                    }
                });
                // Create Job Card sjc_form
                $('#peek-modal').modal();
                $('#createJobCardBtn').on('click', function () {
                    let tickedId = '?ticketId='+ peekTicketId;
                    location = url_sjcCreateForm + tickedId;
                });

                //Delete Ticket
                $('#deleteTicketBtn').off('click').on('click', function (event) {
                    event.preventDefault();
                    let deleteTicketId = ticketId;
                    $('#delete-confirm-modal').modal();
                    $('#delete-confirm-title').html("Are you Sure you want to Delete Ticket # "+ deleteTicketId);
                    $('#confirmDelete').off('click').on('click', function () {
                        console.log('clicked ' + peekTicketId)
                        $.ajax({
                            method: "GET",
                            url: url_deleteTicket,
                            data: {
                                ticketId: deleteTicketId
                            },
                            success: function () {
                                $('#ticketTable').DataTable().ajax.reload();
                                alert('Ticket # ' + deleteTicketId + ' Successfully Deleted')
                                $('#delete-confirm-modal').modal('hide');
                                $('#peek-modal').modal('hide');
                            }
                        });//ajax
                    });//#confirm delete
                });//Delete Ticket


                    //console.log(deleteTicketId)
                    /*if(confirm('Are your Sure you want to Delete Ticket #'+ deleteTicketId)) {

                    }else {return false;}*/
                });//Ticket Row info on Click
            });//Document Ready

            $('#make-sjc').tooltip();




    </script>
@endsection