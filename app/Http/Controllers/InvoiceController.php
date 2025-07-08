<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_no' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'client_name' => 'required|string',
            'client_address' => 'required|string',
            'reference' => 'required|string',
            'total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.date' => 'required|string',
            'items.*.description' => 'required|string',
            'items.*.amount' => 'required|numeric',
            'extras' => 'nullable|array',
            'extras.*.date' => 'nullable|string',
            'extras.*.description' => 'nullable|string',
            'extras.*.amount' => 'nullable|numeric',
        ]);

        $invoice = Invoice::create([
            'invoice_no' => $validated['invoice_no'],
            'invoice_date' => $validated['invoice_date'],
            'due_date' => Carbon::parse($validated['due_date'])->startOfDay(),
            'client_name' => $validated['client_name'],
            'client_address' => $validated['client_address'],
            'reference' => $validated['reference'],
            'total' => $validated['total'],
            'items' => $validated['items'],
            'extras' => $validated['extras'] ?? [],
        ]);

        $qrCodeData = 'SPC|0200|1|CH9809000000160578584|CHF' . number_format($invoice->total, 2, '.', '') . '|Eleego Limousine & Rental|...';

        $pdf = Pdf::loadView('pdf.invoice',  compact('invoice', 'qrCodeData'));
        return $pdf->download("invoice-{$invoice->invoice_no}.pdf");
    }
}
