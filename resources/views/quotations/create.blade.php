@extends('layouts.admin')

@section('title', 'eleego')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Create Quotation
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('quotations.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Quotation No</label>
                                <input type="text" name="quotation_no" class="form-control" value="{{ $quotationNo }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label>Quotation Date</label>
                                <input type="date" name="quotation_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Client Name</label>
                                <input type="text" name="client_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Organization</label>
                                <input type="text" name="organization" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div id="vehicle-wrapper">
                                <label>Vehicle Type & Rate Per Day (CHF)</label>
                                <div class="row mb-2 vehicle-row">
                                    <div class="col-md-6">
                                        <input type="text" name="vehicle_types[]" class="form-control"
                                            placeholder="Vehicle Type" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" min="0" step="0.01" name="rates_per_day[]"
                                            class="form-control" placeholder="Rate Per Day (CHF)" required>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-success add-row">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Total Amount (CHF)</label>
                                <input type="number" min="0" name="total_amount" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Settle Before Date</label>
                                <input type="date" name="settle_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Cancel Before Date</label>
                                <input type="date" name="cancel_before" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Terms and Conditions</label>
                                <textarea name="terms_and_conditions" class="form-control" rows="6">{{ old('terms_and_conditions', $defaultTerms) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Generate PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('vehicle-wrapper');
            const totalField = document.getElementById('total_amount');

            function calculateTotal() {
                const rates = wrapper.querySelectorAll('input[name="rates_per_day[]"]');
                const startDate = document.querySelector('input[name="start_date"]').value;
                const endDate = document.querySelector('input[name="end_date"]').value;

                if (!startDate || !endDate) return;

                const start = new Date(startDate);
                const end = new Date(endDate);

                const diffTime = Math.abs(end - start);
                const days = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                let total = 0;
                rates.forEach(input => {
                    const rate = parseFloat(input.value);
                    if (!isNaN(rate)) {
                        total += rate * days;
                    }
                });

                totalField.value = total.toFixed(2);
            }

            wrapper.addEventListener('click', function(e) {
                const btn = e.target;

                if (btn.classList.contains('add-row')) {
                    const row = btn.closest('.vehicle-row');
                    const newRow = row.cloneNode(true);

                    newRow.querySelectorAll('input').forEach(input => input.value = '');
                    const newBtn = newRow.querySelector('button');
                    newBtn.classList.remove('btn-success', 'add-row');
                    newBtn.classList.add('btn-danger', 'remove-row');
                    newBtn.textContent = '-';

                    wrapper.appendChild(newRow);
                }

                if (btn.classList.contains('remove-row')) {
                    btn.closest('.vehicle-row').remove();
                }

                calculateTotal();
            });

            wrapper.addEventListener('input', function(e) {
                if (e.target.name === "rates_per_day[]") {
                    calculateTotal();
                }
            });

            document.querySelector('input[name="start_date"]').addEventListener('change', calculateTotal);
            document.querySelector('input[name="end_date"]').addEventListener('change', calculateTotal);
        });
    </script>
@endpush
