@extends('layouts.master')

@section('title')
    Inventory Directory
@endsection

@section('content')
    @include('includes.message-block')
    <h3>Inventory Catalogue</h3>
    <div class="container-fluid">
        <div class="row" style="padding-top: 50px">
            <div class="row" style="padding-bottom: 20px; padding-right: 20px">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#createInventory" aria-expanded="false" aria-controls="createInventory" id="createInventoryBtn" style="margin-left: 15px">
                    Create New Inventory
                </button>

                <div class="collapse" id="createInventory">
                    <row>
                        <fieldset class="form-group">
                            <form action="" class="form-group" method="POST" id="createInventoryForm">
                                <legend>Create New Inventory</legend>
                                <row>
                                    <div class="col-md-6"> <!-- Create Inventory Well Column 1-->
                                        <br>
                                        <label for="machineSeries">Select Machine Series</label>
                                        <select class="form-control" name="machineSeries" id="machine-series-select" required autofocus>
                                            <option value="" selected> === Select a Series === </option>
                                            <option value="UX" data-series="UX"> UX </option>
                                            <option value="RX2" data-series="RX2"> RX2 </option>
                                            <option value="PXR-D" data-series="PXR-D"> PXR-D </option>
                                            <option value="PXR-P" data-series="PXR-P"> PXR-P </option>
                                            <option value="PXR-H" data-series="PXR-H"> PXR-H </option>
                                        </select>
                                        <label for="machineModel">Select Machine Model</label>
                                        <select class="form-control" name="machineModel" id="machine-model-select" required autofocus>
                                            <option value="" selected> === Select a Model === </option></select>
                                    </div> <!-- Create Inventory Well Column 1-->

                                    <div class="col-md-6"> <!-- Create Inventory Well Column 2-->
                                        <label for="machineSerial">Enter Machine Serial#</label>
                                        <input type="text" name="machineSerial" class="form-control" id="machine-serial-field" maxlength="8" required>
                                        <label for="assignedCo">Select Assigned Company</label>
                                        <select class="form-control" id="assigned-co-select" name="assignedCo" required>
                                            <option value=""> === Select a Company === </option>
                                        </select>
                                    </div> <!-- Create Inventory Well Column 2-->
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
                <table class="display" id="inventoryTable" width="100%" title="Click a row to see Inventory Details" data-toggle="tooltip" data-placement="top">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Machine Series</th>
                        <th>Machine Model</th>
                        <th>Machine Serial #</th>
                        <th>Company</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div> <!-- row div -->
    </div> <!-- container div -->

    <!-- Edit Company Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="inventory-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Inventory Details</h4>
                </div>

                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="machineSeriesPeek" class="col-sm-3 control-label">Machine Series</label>
                                <div class="col-sm-9" style="padding-top: 10px">
                                    <p class="form-control-static" name="machineSeriesPeek" id="machine-series-peek" style="font-weight: 300"> </p>
                                </div>
                                <label for="machineModelPeek" class="col-sm-3 control-label">Machine Model</label>
                                <div class="col-sm-9" style="padding-top: 10px">
                                    <p class="form-control-static" name="machineModelPeek" id="machine-model-peek" style="font-weight: 300"> </p>
                                </div>
                                <label for="machineSerialPeek" class="col-sm-3 control-label">Machine Serial</label>
                                <div class="col-sm-9" style="padding-top: 10px">
                                    <p class="form-control-static" name="machineSerialPeek" id="machine-serial-peek" style="font-weight: 300"> </p>
                                </div>
                                <label for="machineCoPeek" class="col-sm-3 control-label">Company</label>
                                <div class="col-sm-9" style="padding-top: 10px">
                                    <p class="form-control-static" name="machineCoPeek" id="machine-co-peek" style="font-weight: 300"> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="inventory-modal-footer">
                        @if(Auth::user()->username == 'admin')
                        <button type="button" class="btn btn-danger" id="inventory-modal-delete-btn">Delete Record</button>
                        @endif
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="inventory-modal-close-btn">Close</button>
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
        var session = '{{ Session::token() }}';
        const url_popInvTable = '{{ route('inventory.popTable') }}';
        const url_createInventory = '{{ route('inventory.create') }}';
        const url_deleteInv = '{{ route('inventory.delete') }}';
        const url_popCompanySelect = '{{ route('inventory.popCompanySelect') }}';

        $( "#companyTable" ).tooltip({
            delay: 100
        });

        //chosen select plugin
        $('#machine-series-select').chosen({width: '100%'});
        $('#machine-model-select').chosen({width: '100%'});
        $('#assigned-co-select').chosen({width: '100%'});

        $(document).ready(function () {

            //Populate machine model select
            $("#machine-series-select").off('change').on('change', function () {
                let machine_series = $(this).val();
                if (machine_series == 'UX')
                {
                    $('#machine-model-select').html("" +
                        "<option value=\"UX-B160W\"> UX-B160W </option>" +
                        "<option value=\"UX-D160W\"> UX-D160W </option>").trigger('chosen:updated');
                }
                if (machine_series == 'RX2')
                {
                    $('#machine-model-select').html("" +
                        "<option value=\"RX2-SD160W\"> RX2-SD160W </option>" +
                        "<option value=\"RX2-BD160W\"> RX2-BD160W </option>").trigger('chosen:updated');
                }
                if (machine_series == 'PXR-D')
                {
                    $('#machine-model-select').html("" +
                        "<option value=\"PXR-D460W\"> PXR-D460W </option>" +
                        "<option value=\"PXR-D440W\"> PXR-D440W </option>" +
                        "<option value=\"PXR-D450W\"> PXR-D450W </option>" +
                        "<option value=\"PXR-D410W\"> PXR-D410W </option>" +
                        "<option value=\"PXR-D261W\"> PXR-D261W </option>" +
                        "<option value=\"PXR-D242W\"> PXR-D242W </option>" +
                        "<option value=\"PXR-D253W\"> PXR-D253W </option>" +
                        "<option value=\"PXR-D214W\"> PXR-D214W </option>").trigger('chosen:updated');
                }
                if (machine_series == 'PXR-P')
                {
                    $('#machine-model-select').html("" +
                        "<option value=\"PXR-P460W\"> PXR-P460W </option>" +
                        "<option value=\"PXR-P440W\"> PXR-P440W </option>" +
                        "<option value=\"PXR-P450W\"> PXR-P450W </option>" +
                        "<option value=\"PXR-P410W\"> PXR-P410W </option>" +
                        "<option value=\"PXR-P261W\"> PXR-P261W </option>" +
                        "<option value=\"PXR-P242W\"> PXR-P242W </option>" +
                        "<option value=\"PXR-P253W\"> PXR-P253W </option>" +
                        "<option value=\"PXR-P214W\"> PXR-P214W </option>").trigger('chosen:updated');
                }
                if (machine_series == 'PXR-H')
                {
                    $('#machine-model-select').html("" +
                        "<option value=\"PXR-H460W\"> PXR-H460W </option>" +
                        "<option value=\"PXR-H440W\"> PXR-H440W </option>" +
                        "<option value=\"PXR-H450W\"> PXR-H450W </option>" +
                        "<option value=\"PXR-H410W\"> PXR-H410W </option>" +
                        "<option value=\"PXR-H261W\"> PXR-H261W </option>" +
                        "<option value=\"PXR-H242W\"> PXR-H242W </option>" +
                        "<option value=\"PXR-H253W\"> PXR-H253W </option>" +
                        "<option value=\"PXR-H214W\"> PXR-H214W </option>").trigger('chosen:updated');
                }
            }); //Populate machine model select

            //Populate Assigned to company select
            $.ajax({
                method: 'GET',
                url: url_popCompanySelect,
                success: function (company) {
                    $.each(company, function (key, value) {
                        $('#assigned-co-select').append($('<option></option>')
                            .attr('value',key)
                            .text(value)).trigger('chosen:updated');
                    });
                }
            });//ajax

            //create inventory submit
            $('#createCompanySubmitBtn').on('click', function (e) {
                e.preventDefault();
                let machineSeries = $('#machine-series-select').val();
                let machineModel = $('#machine-model-select').val();
                let machineSerial = $('#machine-serial-field').val();
                let assignedCo = $('#assigned-co-select').val();
               console.log(machineSeries,machineModel,machineSerial,assignedCo)

                $.ajax({
                    method: "POST",
                    url: url_createInventory,
                    data: {
                        machineSeries   : machineSeries,
                        machineModel    : machineModel,
                        machineSerial   : machineSerial,
                        companyId      : assignedCo,
                        _token          : session
                    },
                    success: function () {
                        $('#inventoryTable').DataTable().ajax.reload();
                        $('#createInventory').collapse('toggle');
                        alert('Record was successfully created');
                        $('#machine-series-select').val("").trigger('chosen:updated');
                        $('#machine-model-select').val("").trigger('chosen:updated');
                        $('#machine-serial-field').val("");
                        $('#assigned-co-select').val("").trigger('chosen:updated');
                    },
                    error: function () {
                        alert('There was an error creating the record');
                    }
                });//ajax
            });//create inventory submit

            //dataTables
            let table = $('#inventoryTable').DataTable( {
             pageLength: 10,
             lengthMenu: [5, 10, 25, 50],
             ajax: {
             url: url_popInvTable,
             dataSrc: ""
             },
             columns: [
             { data: "id" },
             { data: "machine_series" },
             { data: "machine_model" },
             { data: "machine_serial" },
             { data: "company_name" },
             ]
             });//dataTables

            //Company Row info on Click
            $('#inventoryTable').off('click').on('click', 'tr', function () {
                let rowData = table.row(this).data();

                let companyName = rowData.company_name;
                let machineSeries = rowData.machine_series;
                let machineModel = rowData.machine_model;
                let machineSerial = rowData.machine_serial;


                $('#machine-series-peek').html(machineSeries);
                $('#machine-model-peek').html(machineModel);
                $('#machine-serial-peek').html(machineSerial);
                $('#machine-co-peek').html(companyName);
                $('#inventory-modal').modal();

                //Delete Company
                $('#inventory-modal-delete-btn').off('click').on('click', function (event) {
                    event.preventDefault();
                    $('#delete-confirm-modal').modal();
                    $('#delete-confirm-title').html("Are you Sure you want to Delete Inventory #"+ machineSerial +" of "+ companyName);
                    $('#confirmDelete').off('click').on('click', function () {
                        $.ajax({
                            method: "GET",
                            url: url_deleteInv,
                            data: {
                                machineSerial: machineSerial
                            },
                            success: function () {
                                $('#inventoryTable').DataTable().ajax.reload();
                                alert('Serial # '+ machineSerial +' for '+companyName+' Successfully Deleted')
                                $('#delete-confirm-modal').modal('hide');
                                $('#inventory-modal').modal('hide');
                            },
                            error: function () {
                                alert('There was an error deleting the record')
                                $('#delete-confirm-modal').modal('hide');
                                $('#inventory-modal').modal('hide');
                            }
                        });//ajax
                    });//#confirm delete
                });//Delete Inventory
            });//Inventory Row info on Click
        });//Doc Ready
    </script>
@endsection