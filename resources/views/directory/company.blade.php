@extends('layouts.master')

@section('title')
    Company Directory
@endsection

@section('content')
    @include('includes.message-block')
    <h1>Company Directory</h1>
    <div class="container-fluid">
    <div class="row" style="padding-top: 50px">
        <div class="row" style="padding-bottom: 20px; padding-right: 20px">

           <!-- Add Co Btn -->
            <div class="pull-right">
                <a href="#" class="btn btn-primary" id="add-co-btn"><i class="fa fa-plus"></i> Add Company</a>
            </div>
            <!-- Add Co Btn -->

            <!-- Serach -->
            <div>
                <form action="{{ route('companyView') }}" class="navbar-form" method="get" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" style="width: 300px" name="search" placeholder="Search by Company Name">
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

            <div>{{ $companies->links() }}</div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered companyTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Tel</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="tbody-company">
                @foreach($companies as $co)
                <tr class="company-row" data-companyid="{{ $co->id }}">
                    <td>{{ $co->id }}</td>
                    <th scope="row" class="td-company-name">{{ $co->companyName }}</th>
                    <td class="td-contact-name">{{ $co->contactName }}</td>
                    <td class="td-contact-tel">{{ $co->contactTel }}</td>
                    <td class="td-contact-mobile">{{ $co->contactMobile }}</td>
                    <td class="td-contact-email">{{ $co->contactEmail }}</td>
                    <td class="td-city">{{ $co->city }}</td>
                    <td class="td-country">{{ $co->country }}</td>
                    <td class="td-address">{{ $co->address }}</td>
                    <td class="td-edit" align="center">
                        <a href="#" class="fa fa-pencil co-details-from-db" aria-hidden="true"
                           id="edit-co-btn" data-companyid="{{ $co->id }}"></a>
                        <a href="{{ route('delete.company', ['company_id' => $co->id, 'current_page' => $companies->currentPage()]) }}" class="fa fa-trash" style="color: red" aria-hidden="true"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Serach -->

    </div> <!-- row div -->
    </div> <!-- container div -->


    <!-- Add Company Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Company</h4>
                </div>
                <form action="{{ route('create.company', ['current_page' => $companies->currentPage()]) }}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Enter Company Name" {{ $errors->has('companyName') ? 'has-error' : '' }}>
                        <input type="text" class="form-control" name="contactName" id="contactName" placeholder="Enter Contact Name" {{ $errors->has('contactName') ? 'has-error' : '' }}>
                        <input type="text" class="form-control" name="contactTel" id="contactTel" placeholder="Enter Contact Tel" {{ $errors->has('contactTel') ? 'has-error' : '' }}>
                        <input type="text" class="form-control" name="contactMobile" id="contactMobile" placeholder="Enter Contact Mobile" {{ $errors->has('contactMobile') ? 'has-error' : '' }}>
                        <input type="text" class="form-control" name="contactEmail" id="contactEmail" placeholder="Enter Contact Email" {{ $errors->has('companyName') ? 'has-error' : '' }}>
                        <label for="city">Select City:</label>
                        <select name="city" id="city" class="form-control" {{ $errors->has('city') ? 'has-error' : '' }}>
                            <option value="" selected> === Select City ===</option>
                            <option value="Dubai">Dubai</option>
                            <option value="Abu Dhabi">Abu Dhabi</option>
                            <option value="Sharjah">Sharjah</option>
                            <option value="Ajman">Ajman</option>
                            <option value="Umm al-Quwain">Umm al-Quwain</option>
                            <option value="Ras al-Khaima">Ras al-Khaimah</option>
                            <option value="Fujairah">Fujairah</option>
                        </select>
                        <label for="country">Select Country:</label>
                        <select name="country" id="country" class="form-control" {{ $errors->has('country') ? 'has-error' : '' }}>
                            <option value="" selected> === Select Country ===</option>
                            <option value="Oman">Oman</option>
                            <option value="UAE">United Arab Emirates</option>
                        </select>
                        <textarea name="address" id="address" rows="5" placeholder="Enter Address"></textarea>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
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
    </script>
@endsection