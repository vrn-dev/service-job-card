@extends('layouts.master')

@section('title')
    Inventory Directory
@endsection

@section('content')
    @include('includes.message-block')
    <h1>Inventory Catalogue</h1>
    <div class="container-fluid">
    <div class="row" style="padding-top: 50px">
        <div class="row" style="padding-bottom: 20px; padding-right: 20px">

           <!-- Add Inventory Btn -->
            <div class="pull-right">
                <a href="#" class="btn btn-primary" id="add-inv-btn"><i class="fa fa-plus"></i> Add Inventory</a>
            </div>
            <!-- Add Inventory Btn -->

            <!-- Serach -->
            <div>
                <form action="{{ route('inventory.index') }}" class="navbar-form" method="get" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" style="width: 300px" name="search" placeholder="Search by Model or Company">
                        <div class="input-group-btn" style="padding-top: 10px">
                            <span class="input-group">
                                <button class="btn btn-default-sm" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                <button class="btn btn-default-sm" type="submit">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Serach -->

        </div>


        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered inventory-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Machine Series</th>
                        <th>Machine Model</th>
                        <th>Machine Serial #</th>
                        <th>Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="tbody-inventory">
                    @foreach($inventory as $item)
                    <tr class="inventory-row" data-inventory="{{ $item->id }}">
                        <td class="inventory-row-item-id">{{ $item->id }}</td>
                        <td>{{ $item->machine_series }}</td>
                        <td>{{ $item->machine_model }}</td>
                        <td>{{ $item->machine_serial }}</td>
                        <td><a href="#" class="fa fa-eye see-co-details" aria-hidden="true" id="see-co-details-btn"
                               data-companyid="{{ $item->company->id }}"
                               data-companyname="{{ $item->company->companyName }}"
                               data-contactname="{{ $item->company->contactName }}"
                               data-contacttel="{{ $item->company->contactTel }}"
                               data-contactmobile="{{ $item->company->contactMobile }}"
                               data-contactemail="{{ $item->company->contactEmail }}"
                               data-city="{{ $item->company->city }}"
                               data-country="{{ $item->company->country }}"
                               data-address="{{ $item->company->address }}"></a> {{ $item->company->companyName }}</td>
                        <td class="td-edit" align="center">
                            <a href="{{ route('inventory.delete', ['inventory_id' => $item->id]) }}" class="fa fa-trash" style="color: red" aria-hidden="true"></a> {{-- Delete Record, insert the route logic later --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       

    </div> <!-- row div -->
    </div> <!-- container div -->

    {{--<div> <!-- test div -->
        <p>No of companies: </p>
        {{ $count = \App\Company::count() }}
    </div> <!-- test div -->--}}


    <!-- Add Inventory Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Company Inventory</h4>
                </div>
                <form action="{{ route('inventory.store') }}" method="POST">
                <div class="modal-body">
                    <div class="form-group">

                        <label for="machine-series">Select Machine Series:</label>
                        <select class="form-control machine-series" name="machine-series" id="machine-series" {{ $errors->has('machine-series') ? 'has-error' : '' }} required autofocus>
                            <option value="" selected> === Select a Series === </option>
                            <option value="UX" data-series="UX"> UX </option>
                            <option value="RX2" data-series="RX2"> RX2 </option>
                            <option value="PXR-D" data-series="PXR-D"> PXR-D </option>
                            <option value="PXR-P" data-series="PXR-P"> PXR-P </option>
                            <option value="PXR-H" data-series="PXR-H"> PXR-H </option>
                        </select>

                        <label for="machine-model">Select Machine Model:</label>
                        <select class="form-control machine-model" name="machine-model" id="machine-model" {{ $errors->has('machine-model') ? 'has-error' : '' }} required autofocus>
                            <option value="" selected> === Select a Model === </option>
                        </select>

                        <label for="machine-serial">Select Machine Serial #:</label>
                        <input type="text" name="machine-serial" class="form-control" maxlength="10" placeholder="Enter Machine Serial #" {{ $errors->has('machine-serial') ? 'has-error' : '' }} required>

                        <label for="company-id">Select Assigned Company: </label>
                        <select name="company-id" id="company-id" class="form-control" {{ $errors->has('company-id') ? 'has-error' : '' }} required>
                            @foreach($companies as $co)
                                <option value="{{ $co->id }}">{{ $co->companyName }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-modal-save">Save changes</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Add Inventory Modal -->

    <!-- Company Peek Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="peek-modal">
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
                            <label class="col-sm-3 control-label">Contact Name</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-contact-name" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Tel</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-contact-tel" style="font-weight: 300"> </p>
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
                        <div class="form-group">
                            <label class="col-sm-3 control-label">City</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-city" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Country</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-country" style="font-weight: 300"> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9" style="padding-top: 10px">
                                <p class="form-control-static" id="peek-address" style="font-weight: 300"> </p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Inventory Peek Modal -->

    {{--<script>
        var edit_inv_token = '{{ Session::token() }}';
        var edit_inv_url = '{{ route('inventory.update', ['id' => ]) }}';
    </script>--}}
@endsection