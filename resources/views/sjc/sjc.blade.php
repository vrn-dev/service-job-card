@extends('layouts.master')

@section('title')
    Service Job Card Interface
@endsection

@section('content')
    @include('includes.message-block')
    <h1>Service Job Card Interface</h1>
    <div class="container-fluid">
        <div class="row" style="padding-top: 50px">
            <div class="row" style="padding-bottom: 20px; padding-right: 20px">

            </div> <!-- Row 2 Div -->
        </div> <!-- Row 1 Div -->
        <div class="row"> <!-- Table Row Div -->
            <h3>Ticket History</h3>
            <div class="row" style="padding-left: 15px">
                <div class="table-responsive">
                    <table id="sjcTable" class="display" width="100%" title="Click a row to see SJC Details" data-toggle="tooltip" data-placement="top">
                        <thead>
                        <tr>
                            <th>Ticket #</th>
                            <th>Company</th>
                            <th>Assigned To</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- Table Row Div -->
    </div> <!-- Container: Fluid -->



    <div class="modal fade" tabindex="-1" role="dialog" id="sjc-peek-modal"> <!-- SJC Peek Modal-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sjc-modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <span class="btn btn-lg btn-primary center-block" id="fillJcBtn">Fill Job Card</span>
                    </div>
                    @if(Auth::user()->username == 'admin')
                    <div style="padding-top: 10px">
                        <span class="btn btn-lg btn-info center-block" id="updateSjcBtn">Reschedule Job Card</span>
                    </div>
                    <div style="padding-top: 10px">
                        <span class="btn btn-lg btn-danger center-block" id="deleteSjcBtn">Delete Job Card</span>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /SJC Peek Modal-->

    <!-- Update SJC Modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="update-sjc-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="update-sjc-modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Reschedule Date</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <input type="date" class="form-control" id="rescheduleDate" name="rescheduleDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Assigned to User</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <select name="rescheduleAssignedTo" id="rescheduleAssignedTo">
                                    @foreach($username as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="subSjcUpdateModalBtn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /Update SJC Modal-->

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

    <div class="modal fade" tabindex="-1" role="dialog" id="sjc-completed-peek-modal"> <!-- SJC Completed Peek Modal-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sjc-completed-modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <span class="btn btn-lg btn-primary center-block" id="downloadJcBtn">Download Job Card</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /SJC Completed Peek Modal-->


@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            //vars
            const session = "{{ Session::token() }}";
            const url_popTable = "{{ route('sjc.popTable') }}";
            const url_updateSjc = "{{ route('sjc.update') }}";
            const url_deleteSjc = "{{ route('sjc.delete') }}";
            const url_fillSjc = "{{ route('sjc.fill') }}";
            const url_downloadSjc = "{{ route('pdf.download') }}";



            //other jQs
            $('#rescheduleAssignedTo').chosen({width: "100%"});

            //pop dataTables
            table = $('#sjcTable').DataTable( {
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [3, 'desc'],
                ajax: {
                    url: url_popTable,
                    dataSrc: ""
                },
                columns: [
                    { data: "ticket_id" },
                    { data: "company_name" },
                    { data: "assigned_to" },
                    { data: "scheduled_date" },
                ],
                columnDefs: [{
                    targets: 4,
                    data: "status",
                    render: function (data, type, full, meta) {
                        if (data == "Active")
                        {
                            return '<span style="color: red">Active</span>'
                        }
                        else if (data == "Completed")
                        {
                            return '<span style="color: green">Completed</span>'
                        }
                        else
                        {
                            return '<span style="color: blue">No Data</span>'
                        }
                    }
                }]
            }); // $DataTable

            //SJC Row info on Click
            $('#sjcTable').off('click').on('click', 'tr', function () {

                let rowData = table.row(this).data();
                let coId = rowData.company_id;
                let coName = rowData.company_name;
                let ticketId = rowData.ticket_id;
                let status = rowData.status;

                if (status != "Completed")
                {
                    $('#sjc-modal-title').html('Ticket #: '+ ticketId + ' for ' +coName);
                    $('#sjc-peek-modal').modal();
                }else if (status == "Completed")
                {
                    $('#sjc-completed-modal-title').html('Completed Ticket #: '+ ticketId + ' for ' +coName)
                    $('#sjc-completed-peek-modal').modal();
                }


                //Update SJC
                $('#updateSjcBtn').off('click').on('click', function () {
                    $('#update-sjc-modal-title').html('Update Ticket #: '+ ticketId + ' for ' +coName);
                    $('#update-sjc-modal').modal();
                });
                //Sub Modal Update Ajax
                $('#subSjcUpdateModalBtn').off('click').on('click', function () {
                    let reDate = $('#rescheduleDate').val();
                    let reAssign = $('#rescheduleAssignedTo').val();
                    $.ajax({
                        method: "POST",
                        url: url_updateSjc,
                        data: {
                            ticketId: ticketId,
                            reDate: reDate,
                            reAssign: reAssign,
                            _token: session
                        },
                        success: function () {
                            $('#sjcTable').DataTable().ajax.reload();
                            alert('Job Card for Ticket # ' + ticketId + ' Successfully Updated')
                            $('#update-sjc-modal').modal('hide');
                            $('#sjc-peek-modal').modal('hide');
                        },
                        error: function () {
                            alert('An error occured while updating. Please try again or contact SuperAdmin')
                        }
                    }); //ajax
                });//Sub Modal Update Ajax

                //Delete Ticket
                $('#deleteSjcBtn').off('click').on('click', function (event) {
                    event.preventDefault();
                    let deleteTicketId = ticketId;
                    $('#delete-confirm-modal').modal();
                    $('#delete-confirm-title').html("Are you Sure you want to Delete Job Card for Ticket # "+ deleteTicketId);
                    $('#confirmDelete').off('click').on('click', function () {
                        $.ajax({
                            method: "GET",
                            url: url_deleteSjc,
                            data: {
                                ticketId: deleteTicketId
                            },
                            success: function () {
                                $('#sjcTable').DataTable().ajax.reload();
                                alert('Job Card for Ticket # ' + deleteTicketId + ' Successfully Deleted')
                                $('#delete-confirm-modal').modal('hide');
                                $('#sjc-peek-modal').modal('hide');
                            }
                        });//ajax
                    });//#confirm delete
                });//Delete Ticket


                //Fill Job Card
                $('#fillJcBtn').off('click').on('click', function () {
                    let fillTickedId = '?ticketId='+ ticketId;
                    location = url_fillSjc + fillTickedId;
                });

                //Download SJC
                $('#downloadJcBtn').off('click').on('click', function () {
                    let dlTicketId = '?ticketId='+ ticketId;
                    location = url_downloadSjc + dlTicketId;
                    $('#sjc-completed-peek-modal').modal('hide');
                });
            });//SJC Row info on Click
        }); // document.ready
    </script>
@endsection

