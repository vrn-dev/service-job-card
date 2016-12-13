@extends('layouts.master')

@section('title')
    Service Job Card Form
@endsection


@section('content')
    @include('includes.message-block')
    <h1>Service Job Card Creator</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Details</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-6 form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ticket ID</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $formData->ticketId }}" class="form-control" id="ticketId" style="font-weight: 300" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Customer Name</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $formData->companyName }}" class="form-control" id="companyName" style="font-weight: 300" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Contact Person</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $formData->contactPerson }}" class="form-control" id="contactName" style="font-weight: 300" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Contact Mobile</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $formData->contactMobile }}" class="form-control" id="contactMobile" style="font-weight: 300" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Contact Email</label>
                    <div class="col-sm-9">
                        <input type="email" value="{{ $formData->contactEmail }}" class="form-control" id="contactEmail" style="font-weight: 300" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ticket Issue Date</label>
                    <div class="col-sm-9">
                        <input type="date" value="{{ $formData->ticketIssueDate }}" class="form-control" id="issueDate" style="font-weight: 300" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Machine Model #</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $formData->machineModel }}" class="form-control" id="machineModel" style="font-weight: 300" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Machine Serial #</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $formData->machineSerial }}" class="form-control" id="machineSerial" style="font-weight: 300" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Location</label>
                    <div class="col-sm-9">
                        <textarea cols="5" rows="3" class="form-control" id="coAddress" style="font-weight: 300" disabled>{{ $formData->address }}</textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-heading">
            <h4 class="panel-title">Details</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-6 form-horizontal">
                <form action="" class="form-group" method="POST">
                    <label for="scheduleDate" class="col-sm-3 control-label">Scheduled Date</label>
                    <div class="col-md-9">
                        <input type="date" name="scheduleDate" class="form-control" id="scheduleDate">
                    </div>
                </form>
            </div>
            <div class="col-md-6 form-horizontal">
                <div class="form-group">
                    <label for="assignedTo" class="col-sm-3 control-label">Assigned User</label>
                    <div class="col-md-9" style="padding-top: 10px">
                        <select name="assignedTo" id="assignedTo">
                            <option value="User1">User 1</option>
                            <option value="User2">User 2</option>
                            <option value="User3">User 3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-success" type="submit" id="createSjCBtn">Create SJC</button>

            </div>
        </div>
    </div>







@endsection

@section('scripts')
    <script>

        $('#assignedTo').chosen({ width: "100%" });
//        $.datepicker.formatDate("yy-mm-dd");
//        $('#scheduleDate').datepicker();

        $(document).ready(function () {
            //URL vars
            const url_createSjc = "{{ route('sjc.createSjc') }}";
            const url_sjcIndex = "{{ route('sjc.index') }}";
            const session = "{{ Session::token() }}"
            let ticketId = $('#ticketId').val();
            let assignedTo = $('#assignedTo').find('option:selected').val();

            //create new SJC
            $('#createSjCBtn').on('click', function () {
                let scheduleDate = $('input[name=scheduleDate]').val();
                /*console.log("Schedule Date: "+scheduleDate);
                console.log("Ticket ID "+ticketId);
                console.log("Assigned To "+assignedTo);*/
                $.ajax({
                    method: "POST",
                    url: url_createSjc,
                    data: {
                        ticketId: ticketId,
                        scheduleDate: scheduleDate,
                        assignedTo: assignedTo,
                        _token: session
                    },
                    success: function () {
                        alert('Job Card Successfully Created');
                        location = url_sjcIndex;
                    },
                    error: function (jqXHR, textStatus, errorThrown) { //TODO: Do better error capture and validation
                        alert('There was an error creating the record');
                        console.log(jqXHR);
                        console.log('textStatus = '+textStatus);
                        console.log('errorThrown = '+errorThrown);
                    }
                });
            });
        });
    </script>
@endsection