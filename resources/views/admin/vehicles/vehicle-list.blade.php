@extends('layouts.admin')

@section('title', 'eleego')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Vehicle List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="/vehicles/add"><button type="button" class="btn btn-success btn-sm float-right"><i
                                        class="fa fa-plus">New Vehicle</i></button></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                @csrf
                                <div class="col-lg-6">

                                    <input type="text" name="search" class="form-control"
                                        placeholder="Enter vehicle name">
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary btn-sm float-left">
                                        <i class="fa fa-search">Search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if (session('alert'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                </button>
                                {{ session('alert') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table table-borderless table-responsive-lg">
                            <thead class="bg-gradient-navy">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Brand</th>
                                    <th>Vehicle Name</th>
                                    <th>Transmission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @if ($vehicles)
                                    @foreach ($vehicles as $key => $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->id }}</td>
                                            @if ($vehicle->image != null)
                                                <td><img src="/uploads/vehicles/{{ $vehicle->image }}" alt=""
                                                        class="img-thumbnail" width="45"></td>
                                            @elseif($vehicle->image == null)
                                                <td><img src="/img/no_image.jpg" class="img-thumbnail" alt=""
                                                        width="45"></td>
                                            @endif
                                            <td>{{ $vehicle->brand_name }}</td>
                                            <td>{{ $vehicle->name }}</td>
                                            <td>{{ $vehicle->transmission }}</td>
                                            <td><button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#vehicleModal_{{ $key }}" data-whatever="@mdo"
                                                    id="view_{{ $key }}"><i class="fa fa-eye"></i></button>
                                                <button onclick="deleteVehicle({{ $vehicle->id }})"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="vehicleModal_{{ $key }}" tabindex="-1"
                                            role="dialog" aria-labelledby="vehicleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('vehicles.update') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control"
                                                            value="{{ $vehicle->id }}" name="productId">
                                                        <div class="modal-header bg-info">
                                                            <h5 class="modal-title" id="vehicleModalLabel">Update
                                                                Vehicle</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body small">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="name" class="col-form-label">Brand
                                                                        Name:</label>
                                                                    <select name="brand_name" id="brand_name"
                                                                        class="form-control">
                                                                        @foreach ($brands as $brand)
                                                                            <option value="{{ $brand->brand_name }}"
                                                                                {{ $vehicle->brands->brand_name == $brand->brand_name ? 'selected' : '' }}>
                                                                                {{ $brand->brand_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="name"
                                                                        class="col-form-label">Name:</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="name"
                                                                        value="{{ $vehicle->name }}">
                                                                </div>

                                                                <input type="hidden" name="id"
                                                                    value="{{ $vehicle->id }}">
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-lg-6">
                                                                    <label for="transmission"
                                                                        class="col-form-label">Transmission:</label>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input @error('transmission') is-invalid @enderror"
                                                                            type="radio" name="transmission"
                                                                            id="manual" value="manual"
                                                                            {{ $vehicle->transmission == 'manual' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="manual">
                                                                            Manual
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input @error('transmission') is-invalid @enderror"
                                                                            type="radio" name="transmission"
                                                                            id="auto" value="auto"
                                                                            {{ $vehicle->transmission == 'auto' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="auto">
                                                                            Auto
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="fuel_type" class="col-form-label">Fuel
                                                                        Type:</label>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input @error('fuel_type') is-invalid @enderror"
                                                                            type="radio" name="fuel_type"
                                                                            id="petrol" value="petrol"
                                                                            {{ $vehicle->fuel_type == 'petrol' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="petrol">
                                                                            Petrol
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input @error('fuel_type') is-invalid @enderror"
                                                                            type="radio" name="fuel_type"
                                                                            id="diesel" value="diesel"
                                                                            {{ $vehicle->fuel_type == 'diesel' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="diesel">
                                                                            Diesel
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input @error('fuel_type') is-invalid @enderror"
                                                                            type="radio" name="fuel_type"
                                                                            id="electric" value="electric"
                                                                            {{ $vehicle->fuel_type == 'electric' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="electric">
                                                                            Electric
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="capacity" class="col-form-label">Engine
                                                                        Capacity (CC):</label>
                                                                    <input type="text" class="form-control"
                                                                        id="capacity" name="capacity"
                                                                        value="{{ $vehicle->capacity }}">
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="seats" class="col-form-label">No.
                                                                        of
                                                                        seats:</label>
                                                                    <input type="text" class="form-control"
                                                                        id="seats" name="seats"
                                                                        value="{{ $vehicle->seats }}">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="doors" class="col-form-label">No.
                                                                        of
                                                                        Doors:</label>
                                                                    <input type="text" class="form-control"
                                                                        id="doors" name="doors"
                                                                        value="{{ $vehicle->doors }}">
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="luggages"
                                                                        class="col-form-label">luggages:</label>
                                                                    <input type="text" class="form-control"
                                                                        id="luggages" name="luggages"
                                                                        value="{{ $vehicle->luggages }}">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="doors"
                                                                        class="col-form-label">Availability:</label>
                                                                    <select id="availability" type="number"
                                                                        step="any" min="0"
                                                                        class="form-control @error('availability') is-invalid @enderror"
                                                                        name="availability">
                                                                        <option value="Available"
                                                                            {{ $vehicle->availability == 'Available' ? 'selected' : '' }}>
                                                                            Available</option>
                                                                        <option value="Booked"
                                                                            {{ $vehicle->availability == 'Booked' ? 'selected' : '' }}>
                                                                            Booked</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="category"
                                                                        class="col-form-label">Category:</label>
                                                                    <select id="category"
                                                                        class="form-control @error('category') is-invalid @enderror"
                                                                        name="category" value="{{ old('category') }}">
                                                                        <option value="Limousine"
                                                                            {{ $vehicle->category == 'Limousine' ? 'selected' : '' }}>
                                                                            Limousine</option>
                                                                        <option value="Rental"
                                                                            {{ $vehicle->category == 'Rental' ? 'selected' : '' }}>
                                                                            Rental</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group float-right" style="padding-top: 20px">
                                                                @if ($vehicle->image != null)
                                                                    <img id="vehicle_{{ $key }}"
                                                                        class="img-thumbnail" width="200"
                                                                        src="/uploads/vehicles/{{ $vehicle->image }}"
                                                                        alt="vehicle" />
                                                                @elseif($vehicle->image == null)
                                                                    <img id="vehicle_{{ $key }}"
                                                                        class="img-thumbnail" width="200"
                                                                        src="{{ asset('img/no_image.jpg') }}"
                                                                        alt="vehicle" />
                                                                @endif
                                                                <p>Choose image</p>
                                                                <input type='file' name="image"
                                                                    id="itempic_{{ $key }}"
                                                                    onchange="imageUpload(this,'{{ $key }}')" />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal"><i class="fa fa-times">
                                                                    Close</i></button>
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-save">
                                                                    Update</i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('div.alert').delay(2000).slideUp(300);

        function deleteVehicle(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "{{ route('vehicles.delete', ':id') }}".replace(':id', id),
                data: {
                    _token: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(results) {
                    if (results.success) {
                        Swal.fire("Done!", results.message, "success").then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", results.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire("Error!", "Something went wrong: " + error, "error");
                }
            });
        }

        function imageUpload(input, index) {

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
                        if (s >= 100000 || h > w) {
                            setTimeout(function() {
                                sweetAlert("Oops...",
                                    "Attachment should smaller than 100 kb and same width, height!",
                                    "error");
                            }, 500);

                            this.value = "";
                            $('#itempic').val('')
                        } else {
                            $('#product_image_' + index)
                                .attr('src', e.target.result);
                        }
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
