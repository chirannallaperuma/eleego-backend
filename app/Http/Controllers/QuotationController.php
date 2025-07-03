<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function create()
    {
        $lastQuotation = Quotation::orderBy('id', 'desc')->first();
        $nextNumber = $lastQuotation ? intval(preg_replace('/[^0-9]/', '', $lastQuotation->quotation_no)) + 1 : 1;
        $quotationNo = str_pad($nextNumber, 4, '0', STR_PAD_LEFT); // e.g., Q-0001, Q-0002

        return view('quotations.create', compact('quotationNo'));
    }

    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'quotation_no' => 'required',
        //     'quotation_date' => 'required|date',
        //     'client_name' => 'required',
        //     'organization' => 'required',
        //     'address' => 'required',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|after_or_equal:start_date',
        //     'vehicle_type' => 'required',
        //     'rate_per_day' => 'required|numeric',
        //     'contact_person' => 'required',
        //     'contact_number' => 'required',
        //     'cancel_before' => 'required|date|before_or_equal:start_date',
        // ]);
        $data = $request->all();

        $days = Carbon::parse($data['start_date'])->diffInDays(Carbon::parse($data['end_date'])) + 1;

        $total_amount = 0;
        $vehicleDetails = [];

        foreach ($data['vehicle_types'] as $index => $type) {
            $rate = $data['rates_per_day'][$index];
            $amount = $rate * $days;
            $total_amount += $amount;

            $vehicleDetails[] = [
                'type' => $type,
                'rate' => $rate,
                'amount' => $amount,
            ];
        }

        $quotation = Quotation::create([
            'quotation_no' => $data['quotation_no'],
            'quotation_date' => $data['quotation_date'],
            'client_name' => $data['client_name'],
            'organization' => $data['organization'],
            'address' => $data['address'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'vehicle_type' => json_encode(array_map(function ($type, $rate) {
                return ['type' => $type, 'rate' => $rate];
            }, $data['vehicle_types'], $data['rates_per_day'])),
            'rate_per_day' => null,
            'days' => Carbon::parse($data['start_date'])->diffInDays(Carbon::parse($data['end_date'])) + 1,
            'total_amount' => (float) $data['total_amount'],
            'cancel_before' => $data['cancel_before'],
            'contact_person' => $data['contact_person'],
            'contact_number' => $data['contact_number'],
        ]);

        $pdf = Pdf::loadView('pdf.quotation', compact('quotation'));
        $fileName = "quotation-{$quotation->quotation_no}.pdf";
        Storage::put("quotations/{$fileName}", $pdf->output());

        return response()->download(storage_path("app/quotations/{$fileName}"));
    }
}
