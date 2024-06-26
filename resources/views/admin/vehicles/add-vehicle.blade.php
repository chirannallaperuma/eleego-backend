@extends('layouts.admin')

@section('title', 'eleego')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            New Vehicle
                        </div>
                        <div class="text-info text-uppercase float-right">
                            <a href="/vehicles" target="_self">
                                <button type="button" class="btn btn-success btn-sm"><i class="fa fa-list">Vehicle
                                        List</i></button>
                            </a>
                        </div>
                    </div>

                    @if (session('alert'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            </button>
                            {{ session('alert') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('vehicles.store') }}" class="form" id="vehicleForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group row">
                                        <label for="brand_select" class="col-md-4 col-form-label text-md-right">Brand
                                            Name</label>

                                        <div class="col-md-6">
                                            <select id="brand_select" type="text"
                                                class="form-control @error('brand_name') is-invalid @enderror"
                                                name="brand_name" value="{{ old('brand_name') }}">
                                            </select>

                                            @error('brand_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                                                data-target="#brandModal" data-whatever="@mdo">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="transmission"
                                            class="col-md-4 col-form-label text-md-right">Transmission</label>

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('transmission') is-invalid @enderror"
                                                    type="radio" name="transmission" id="manual" value="manual"
                                                    {{ old('transmission') == 'manual' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="manual">
                                                    Manual
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('transmission') is-invalid @enderror"
                                                    type="radio" name="transmission" id="auto" value="auto"
                                                    {{ old('transmission') == 'auto' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="auto">
                                                    Auto
                                                </label>
                                            </div>

                                            @error('transmission')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="fuel_type" class="col-md-4 col-form-label text-md-right">Fuel
                                            Type</label>

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('fuel_type') is-invalid @enderror"
                                                    type="radio" name="fuel_type" id="petrol" value="petrol"
                                                    {{ old('fuel_type') == 'petrol' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="petrol">
                                                    Petrol
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('fuel_type') is-invalid @enderror"
                                                    type="radio" name="fuel_type" id="diesel" value="diesel"
                                                    {{ old('fuel_type') == 'diesel' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="diesel">
                                                    Diesel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('fuel_type') is-invalid @enderror"
                                                    type="radio" name="fuel_type" id="electric" value="electric"
                                                    {{ old('fuel_type') == 'electric' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="electric">
                                                    Electric
                                                </label>
                                            </div>

                                            @error('fuel_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="capacity" class="col-md-4 col-form-label text-md-right">Engine
                                            Capacity
                                            (CC)</label>

                                        <div class="col-md-6">
                                            <input id="capacity" type="number" min="0"
                                                class="form-control @error('capacity') is-invalid @enderror"
                                                name="capacity" value="{{ old('capacity') }}">

                                            @error('capacity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="seats" class="col-md-4 col-form-label text-md-right">No. of
                                            seats</label>

                                        <div class="col-md-6">
                                            <input id="seats" type="number" min="0"
                                                class="form-control @error('seats') is-invalid @enderror" name="seats"
                                                value="{{ old('seats') }}">

                                            @error('seats')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="doors" class="col-md-4 col-form-label text-md-right">No. of
                                            Doors</label>

                                        <div class="col-md-6">
                                            <input id="doors" type="number" step="any" min="0"
                                                class="form-control @error('doors') is-invalid @enderror" name="doors"
                                                value="{{ old('doors') }}">

                                            @error('doors')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="luggages"
                                            class="col-md-4 col-form-label text-md-right">luggages</label>

                                        <div class="col-md-6">
                                            <input id="luggages" type="number" step="any" min="0"
                                                class="form-control @error('luggages') is-invalid @enderror"
                                                name="luggages" value="{{ old('luggages') }}">

                                            @error('luggages')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="availability"
                                            class="col-md-4 col-form-label text-md-right">Availability</label>

                                        <div class="col-md-6">
                                            <select id="availability" type="number" step="any" min="0"
                                                class="form-control @error('availability') is-invalid @enderror"
                                                name="availability" value="{{ old('availability') }}">
                                                <option>Available</option>
                                                <option>Booked</option>
                                            </select>

                                            @error('availability')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category"
                                            class="col-md-4 col-form-label text-md-right">Category</label>

                                        <div class="col-md-6">
                                            <select id="category" type="number" step="any" min="0"
                                                class="form-control @error('category') is-invalid @enderror"
                                                name="category" value="{{ old('category') }}">
                                                <option>Limousine</option>
                                                <option>Rental</option>
                                            </select>

                                            @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-lg-4">
                                    <div class="card-body">
                                        <div class="form-group" style="padding-top: 20px">
                                            <img id="vehicle_image" class="img-thumbnail" width="200"
                                                src="{{ asset('img/no_image.jpg') }}" alt="vehicle_image" />
                                            <p>choose image</p>
                                            <input type="file" name="image" id="itempic"
                                                onchange="imageUpload(this); " />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Vehicle
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade small" id="brandModal" role="dialog" tabindex="-1" aria-labelledby="brandModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="categoryForm">
                    <div class="modal-header bg-info small">
                        <h5 class="modal-title" id="exampleModalLabel">New Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-lable="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="modal_brand_name" class="col-form-label">Brand Name</label>
                            <input type="text" class="form-control" id="modal_brand_name" name="modal_brand_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveBrand()"
                            id="brand">
                            Save
                        </button>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('div.alert').delay(2000).slideUp(300);

        function saveBrand() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var brand_name = $('#modal_brand_name').val();
            console.log(brand_name);
            $.ajax({
                url: '/vehicle-brands',
                method: 'post',
                data: {
                    brand_name: brand_name
                }

            }).done(function(response) {
                $('#modal_brand_name').val('');
                $('#brand').html('');
                getBrands();
            });
        }

        $(function() {
            getBrands();
        });

        function imageUpload(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = new Image();
                    img.src = e.target.result;

                    var w;
                    var h;
                    var s;
                    img.onload = function(ev) {
                        w = this.width;
                        h = this.height;
                        s = input.files[0].size;
                        if (s >= 500000 || h > w) {
                            console.log("a")
                            setTimeout(function() {
                                sweetAlert("Oops...",
                                    "Attachment should be smaller than 100 kb and have the same width and height!",
                                    "error");
                            }, 500);

                            this.value = "400";
                            $('#itempic').val('')
                        } else {
                            console.log("b")
                            $('#vehicle_image').attr('src', e.target.result);
                        }
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function getBrands() {
            $.getJSON("/vehicle-brands", function(data) {
                $.each(data, function(key, val) {
                    $('#brand_select').append("<option value='" + val.id + "'>" + val.brand_name +
                        "</option>");
                })
            })
        }

        $('#vehicleForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var selectedBrandName = $('#brand_select option:selected').text();
            $('<input>').attr({
                type: 'hidden',
                name: 'brand_name',
                value: selectedBrandName
            }).appendTo(form);
            form.off('submit').submit();
        });
    </script>
@endsection
