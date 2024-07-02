@extends('layouts.admin')

@section('title', 'eleego')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Limousine Bookings
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                @csrf
                                <div class="col-lg-6">

                                    <input type="text" name="search" class="form-control"
                                        placeholder="Enter Booking ID">
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
                        <table class="table table-borderless">
                            <thead class="bg-gradient-navy">
                                <tr>
                                    <th>ID</th>
                                    <th>Vehicle ID</th>
                                    <th>Service Type</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @if ($bookings)
                                    @foreach ($bookings as $key => $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->vehicle_id }}</td>
                                            <td>{{ $booking->service_type }}</td>
                                            <td>{{ $booking->customer_name }}</td>
                                            <td>{{ $booking->customer_email }}</td>
                                            <td>${{ $booking->total_amount }}</td>
                                            <td><button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#bookingModal_{{ $key }}" data-whatever="@mdo"
                                                    id="view_{{ $key }}"><i class="fa fa-eye"></i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="bookingModal_{{ $key }}" tabindex="-1"
                                            role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control"
                                                            value="{{ $booking->id }}" name="bookingId">
                                                        <div class="modal-header bg-info">
                                                            <h5 class="modal-title" id="bookingModalLabel">View
                                                                Booking</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body small">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label for="id" class="col-form-label">ID:</label>
                                                                    <div class="form-control-plaintext">{{ $booking->id }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="id" class="col-form-label">Vehicle
                                                                        ID:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->vehicle_id }}
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="id"
                                                                    value="{{ $booking->id }}">
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="vehicle_id" class="col-form-label">Pickup
                                                                        Date:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->pickup_date_time }}</div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="service_type" class="col-form-label">Drop
                                                                        Date:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->drop_date_time }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="vehicle_id" class="col-form-label">Vehicle
                                                                        Name:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->vehicle->name }}</div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="service_type" class="col-form-label">Service
                                                                        Type:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->service_type }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="pickup_address"
                                                                        class="col-form-label">Pickup
                                                                        Address:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->pickup_address }}</div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="drop_address" class="col-form-label">Drop
                                                                        Address:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->drop_address }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="no_of_persons" class="col-form-label">No.
                                                                        of
                                                                        persons:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->no_of_persons }}</div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="customer_name"
                                                                        class="col-form-label">Customer
                                                                        Name:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->customer_name }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="customer_email"
                                                                        class="col-form-label">Customer
                                                                        Email:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->customer_email }}</div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="customer_phone"
                                                                        class="col-form-label">Customer
                                                                        phone:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->customer_phone }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="payment_method"
                                                                        class="col-form-label">Payment
                                                                        Method:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->payment_method }}</div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="total_amount" class="col-form-label">Total
                                                                        Amount:</label>
                                                                    <div class="form-control-plaintext">
                                                                        ${{ $booking->total_amount }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="additional_services"
                                                                        class="col-form-label">Additional Services:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ implode(', ', $booking->additional_services) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="additional_information"
                                                                        class="col-form-label">Additional
                                                                        Information:</label>
                                                                    <div class="form-control-plaintext">
                                                                        {{ $booking->additional_information }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal"><i class="fa fa-times">
                                                                    Close</i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </tbody>
                            {{ $bookings->links() }}
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('div.alert').delay(2000).slideUp(300);

        function deleteVehicle(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value === true) {

                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/product/product-delete') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            if (results.success === true) {
                                swal("Done!", results.message, "success");
                                location.reload();
                            } else {
                                swal("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    result.dismiss;
                }

            })


        }
    </script>
@endsection
