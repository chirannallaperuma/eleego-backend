@extends('layouts.admin')

@section('title', 'Create Invoice')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Create Rental Invoice</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Invoice No</label>
                        <input type="text" name="invoice_no" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Invoice Date</label>
                        <input type="date" name="invoice_date" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Client Address</label>
                    <textarea name="client_address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Reference No</label>
                    <input type="text" name="reference" class="form-control" required>
                </div>

                <hr>
                <h6 class="text-primary">Rental Items</h6>
                <div id="items">
                    <div class="row mb-2 item-row">
                        <div class="col-md-6">
                            <input type="text" name="items[0][date]" class="form-control" placeholder="e.g. 02/02/2025-26/02/2025(25 Days) or 30/03/2025-09:30PM" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="items[0][description]" class="form-control" placeholder="Description" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="items[0][amount]" step="0.01" class="form-control" placeholder="Amount" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-success add-row">+</button>
                        </div>
                    </div>
                </div>

                <hr>
                <h6 class="text-primary">Extras (Optional)</h6>
                <div id="extras">
                    <div class="row mb-2 extra-row">
                        <div class="col-md-4">
                            <input type="text" name="extras[0][date]" class="form-control" placeholder="Date">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="extras[0][description]" class="form-control" placeholder="Description">
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="extras[0][amount]" step="0.01" class="form-control" placeholder="Amount">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-success add-extra">+</button>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-3">
                    <label>Total Amount (CHF)</label>
                    <input type="number" step="0.01" name="total" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Generate PDF</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let itemIndex = 1;
    let extraIndex = 1;

    document.addEventListener('DOMContentLoaded', function () {
        const addRowBtn = document.querySelector('.add-row');
        const addExtraBtn = document.querySelector('.add-extra');

        addRowBtn.addEventListener('click', () => {
            const row = document.querySelector('.item-row');
            const clone = row.cloneNode(true);
            clone.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.name = input.name.replace(/\[\d+\]/, `[${itemIndex}]`);
            });
            const btn = clone.querySelector('.add-row');
            btn.classList.remove('btn-success', 'add-row');
            btn.classList.add('btn-danger', 'remove-row');
            btn.innerText = '-';
            btn.addEventListener('click', () => clone.remove());
            document.getElementById('items').appendChild(clone);
            itemIndex++;
        });

        addExtraBtn.addEventListener('click', () => {
            const row = document.querySelector('.extra-row');
            const clone = row.cloneNode(true);
            clone.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.name = input.name.replace(/\[\d+\]/, `[${extraIndex}]`);
            });
            const btn = clone.querySelector('.add-extra');
            btn.classList.remove('btn-success', 'add-extra');
            btn.classList.add('btn-danger', 'remove-row');
            btn.innerText = '-';
            btn.addEventListener('click', () => clone.remove());
            document.getElementById('extras').appendChild(clone);
            extraIndex++;
        });
    });
</script>
@endpush
