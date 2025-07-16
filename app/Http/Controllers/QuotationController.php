<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Setting;
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

        $defaultTerms = Setting::where('key', 'default_terms_and_conditions')->value('value');

        return view('quotations.create', compact('quotationNo', 'defaultTerms'));
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
            $date_range = $data['vehicle_dates'][$index];

            $vehicleDetails[] = [
                'type' => $type,
                'rate' => $rate,
                'date' => $date_range,
            ];
        }

        $defaultTerms = $data['terms_and_conditions'] ?? '';

        $formattedSettleDate = Carbon::parse($data['settle_date'])->format('F jS, Y');
        $formattedCancelDate = Carbon::parse($data['cancel_before'])->format('F jS, Y');

        $finalTerms = str_replace(
            ['{{settle_date}}', '{{cancel_before}}'],
            [$formattedSettleDate, $formattedCancelDate],
            $defaultTerms
        );

        $quotation = Quotation::create([
            'quotation_no' => $data['quotation_no'],
            'quotation_date' => $data['quotation_date'],
            'client_name' => $data['client_name'],
            'organization' => $data['organization'],
            'address' => $data['address'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'vehicle_type' => json_encode($vehicleDetails), 
            'rate_per_day' => null,
            'days' => Carbon::parse($data['start_date'])->diffInDays(Carbon::parse($data['end_date'])) + 1,
            'total_amount' => (float) $data['total_amount'],
            'cancel_before' => $data['cancel_before'],
            'contact_person' => $data['contact_person'],
            'contact_number' => $data['contact_number'],
            'terms_and_conditions' => $finalTerms,
        ]);

        $pdf = Pdf::loadView('pdf.quotation', compact('quotation'));
        $fileName = "quotation-{$quotation->quotation_no}.pdf";
        Storage::put("quotations/{$fileName}", $pdf->output());

        return response()->download(storage_path("app/quotations/{$fileName}"));
    }
}
