@extends('layouts.master')

@section('title')
    Inventory Catalogue
@endsection

@section('content')
    @include('includes.message-block')
    <h1>Inventory Catalogue</h1>
    <div class="container-fluid">
    <div class="row" style="padding-top: 50px">
        <div class="row" style="padding-bottom: 20px; padding-right: 20px">

           <!-- Add Catalogue Btn -->
            <div class="pull-right">
                <a href="#" class="btn btn-primary" id="add-co-btn"><i class="fa fa-plus"></i> Add Inventory Catalogue</a>
            </div>
            <!-- Add Catalogue Btn -->


        </div>


        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered catalogueTable">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center">#</th>
                        <th rowspan="2" style="text-align: center">Supplier Company</th>
                        <th colspan="3" style="text-align: center">Product</th>
                        <th rowspan="2" style="text-align: center">Actions</th>
                    </tr>
                    <tr>
                        <th scope="col" style="text-align: center">Family</th>
                        <th scope="col" style="text-align: center">Series</th>
                        <th scope="col" style="text-align: center">Model</th>
                    </tr>
                </thead>
                <tbody class="tbody-company">
                    @foreach($catalogue as $item)
                    <tr class="catalogue-row" data-catalogueid="{{ $item->catalogue_Id }}">
                        <td>{{ $item->catalogue_Id }}</td>
                        <th scope="row">{{ $item->supplier_Company }}</th>
                        <td>{{ $item->product_Family }}</td>
                        <td>{{ $item->product_Series }}</td>
                        <td>{{ $item->product_Model }}</td>
                        <td class="td-edit" align="center">
                            <a href="#" class="fa fa-pencil catalgue-details-from-db" aria-hidden="true"
                               id="edit-catalogue-btn" data-companyid=""></a>
                            <a href="#" class="fa fa-trash" style="color: red" aria-hidden="true"></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Serach -->

    </div> <!-- row div -->
    </div> <!-- container div -->


    <!-- Add Catalogue Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Company</h4>
                </div>
                <form action="{{ route('catalogue.create') }}" method="POST">
                <div class="modal-body">
                    <div class="form-group">

                        <label for="supplier_Company">Select Manufacturer:</label>
                        <select class="form-control" name="supplier_Company" id="supplier_Company" {{ $errors->has('supplier_Company') ? 'has-error' : '' }}>
                            <option value="Hitachi" selected> Hitachi</option>
                        </select>

                        <label for="product_Family">Select Family:</label>
                        <select class="form-control" name="product_Family" id="product_Family" {{ $errors->has('product_Family') ? 'has-error' : '' }}>
                            <option value="Ink Jet Printer" selected> Ink Jet Printer</option>
                        </select>

                        <label for="product_Series">Select Product Series:</label>
                        <select class="form-control" name="product_Series" id="product_Series" {{ $errors->has('product_Series') ? 'has-error' : '' }}  required autofocus>
                            <option value="" selected> === Select Series ===</option>
                            <option value="UX"> UX-Series </option>
                            <option value="RX2"> RX2-Series </option>
                            <option value="PXR"> PXR-Series </option>
                            <option value="PXR"> PXR-Series </option>
                        </select>

                        <input type="text" class="form-control" name="product_Model" id="product_Model" placeholder="Enter Model#" {{ $errors->has('product_Model') ? 'has-error' : '' }}>


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
    <!-- Add Company Modla -->

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