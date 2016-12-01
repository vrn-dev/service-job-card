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

           <!-- Add Catalogue Btn -->
            <div class="pull-right">
                <a href="#" class="btn btn-primary" id="add-inv-btn"><i class="fa fa-plus"></i> Add Inventory Catalogue</a>
            </div>
            <!-- Add Catalogue Btn -->


        </div>


        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered catalogueTable">
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
                    <tr class="inventory-row" data-inventoryid="{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->machine_series }}</td>
                        <td>{{ $item->machine_model }}</td>
                        <td>{{ $item->machine_serial }}</td>
                        <td><a href="#" class="fa fa-eye see-co-details" aria-hidden="true" id="see-co-details-btn" data-companyid=""></a> {{ $item->company->companyName }}</td>
                        <td class="td-edit" align="center">
                            <a href="#" class="fa fa-pencil inventory-details-from-db" aria-hidden="true"
                               id="edit-catalogue-btn" data-companyid=""></a>
                            <a href="#" class="fa fa-trash" style="color: red" aria-hidden="true"></a> {{-- Delete Record, insert the route logic later --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Serach -->

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
    <!-- Add Company Modal -->

    <!-- Edit Company Modal -->
   {{-- <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Company</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="companyName" id="company-name-edit-modal" {{ $errors->has('companyName') ? 'has-error' : '' }}>
                            <input type="text" class="form-control" name="contactName" id="contact-name-edit-modal">
                            <input type="text" class="form-control" name="contactTel" id="contact-tel-edit-modal">
                            <input type="text" class="form-control" name="contactMobile" id="contact-mobile-edit-modal">
                            <input type="text" class="form-control" name="contactEmail" id="contact-email-edit-modal">
                            <label for="city">Select City:</label>
                            <select name="city" id="city-edit-modal" class="form-control">
                                <option value="" selected> === Select City ===</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Abu Dhabi">Abu Dhabi</option>
                                <option value="Sharjah">Sharjah</option>
                                <option value="Ajman">Ajman</option>
                                <option value="Umma al-Quwain">Umm al-Quwain</option>
                                <option value="Ras al-Khaimah">Ras al-Khaimah</option>
                                <option value="Fujairah">Fujairah</option>
                            </select><label for="country">Select Country:</label>
                            <select name="country" id="country-edit-modal" class="form-control">
                                <option value="" selected> === Select Country ===</option>
                                <option value="Oman">Oman</option>
                                <option value="UAE">United Arab Emirates</option>
                            </select>
                            <textarea name="address" id="address-edit-modal" rows="5" placeholder="Enter Address"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="edit-modal-save">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Edit Company Modal -->

    <script>
        var edit_token = '{{ Session::token() }}';
        var edit_url = '{{ route('edit.company') }}';
    </script>--}}
@endsection