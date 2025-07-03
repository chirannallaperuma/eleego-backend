<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 100px 0px 100px;
            /* removes left and right margins */
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 80px;
            z-index: 5;
        }

        .top-border-wrapper {
            position: relative;
            width: 100%;
            height: 80px;
            text-align: center;
        }

        .top-border-line {
            position: absolute;
            top: 35px;
            left: -50px;
            right: -50px;
            height: 30px;
            z-index: 1;
        }

        .top-border-line::before,
        .top-border-line::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #ad830e;
        }

        .top-border-line::before {
            top: 0;
        }

        .top-border-line::after {
            top: 20px;
        }

        .top-border-line .middle-line {
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #ad830e;
            z-index: 0;
        }

        .top-border-logo {
            position: relative;
            z-index: 2;
            display: inline-block;
            background: #fff;
            padding: 0 20px;
        }

        .top-border-logo img {
            height: 170px;
            vertical-align: middle;
        }

        .quotation-box-wrapper {
            position: relative;
            margin-top: 90px;
        }

        .quotation-box {
            padding: 20px;
            position: relative;
            z-index: 2;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        ul li {
            list-style-type: none;
            margin-bottom: 8px;
        }

        ul li::before {
            content: "▪ ";
            color: #000;
            font-weight: bold;
        }

        footer {
            width: 100%;
            background-color: white;
            left: 0;
            right: 0;
        }

        .footer-pattern-table {
            border-collapse: collapse;
            width: 100%;
            height: 24px;
            /* Increased from 14px */
            table-layout: fixed;
        }

        .footer-pattern-table td {
            padding: 0;
            vertical-align: middle;
            border: none;
        }

        .line-pattern {
            background-color: #ad830e;
            height: 24px;
            /* Increased to match table height */
            position: relative;
        }

        .line-pattern::before,
        .line-pattern::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            height: 7px;
            /* Increased white line thickness (was 2px) */
            background-color: white;
        }

        .line-pattern::before {
            top: 3px;
            /* Adjusted position slightly for balance */
        }

        .line-pattern::after {
            bottom: 3px;
        }

        .center-block {
            width: 600px;
            height: 24px;
            /* Increased to match new footer height */
            background-color: #ad830e;
        }


        .footer-text {
            margin-top: 2px;
            text-align: center;
            font-size: 14px;
            color: #4b5563;
            padding: 8px 0;
        }

        h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    @php
        $logoPath = public_path('dist/img/logo-sm.jpg');
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/jpeg;base64,' . $logoData;
    @endphp

    <header>
        <div class="top-border-wrapper">
            <div class="top-border-line">
                <div class="middle-line"></div>
            </div>
            <div class="top-border-logo">
                <img src="{{ $logoSrc }}" alt="Logo">
            </div>
        </div>
    </header>

    <main>
        <div class="quotation-box-wrapper">
            <div class="quotation-box">
                <h1>Quotation No: {{ $quotation->quotation_no }}</h1>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($quotation->quotation_date)->format('d/m/Y') }}</p>

                <div style="display: flex; font-size: 14px;">
                    <div style="min-width: 40px;"><strong>To:</strong></div>
                    <div>
                        {{ $quotation->client_name }}<br>
                        {{ $quotation->organization }}<br>
                        {{ $quotation->address }}
                    </div>
                </div>

                <p><strong>Requested period:</strong>
                    {{ \Carbon\Carbon::parse($quotation->start_date)->format('d/m/Y') }} -
                    {{ \Carbon\Carbon::parse($quotation->end_date)->format('d/m/Y') }}
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type of the vehicle</th>
                            <th>Amount per day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $vehicles = json_decode($quotation->vehicle_type, true);
                        @endphp
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($quotation->start_date)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($quotation->end_date)->format('d M Y') }}
                                </td>
                                <td>{{ $vehicle['type'] }}</td>
                                <td>{{ number_format($vehicle['rate'], 2) }} CHF</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p style="margin-top: 15px; font-weight: bold;">
                    Total Amount for the Period: {{ number_format($quotation->total_amount, 2) }} CHF
                </p>

                <h3 style="margin-top: 30px;">Terms and conditions:</h3>
                <ul>
                    <li>Daily Kilometer Allowance: 150 km per day included totaling {{ $quotation->days * 150 }} km for
                        the entire rental period.</li>
                    <li>Tolls, parking fees, and driver meals are to be covered by the client or reimbursed upon
                        presentation of receipts.</li>
                    <li>A deposit of 30% is required to
                        confirm the booking. The remaining balance should be settled no later than
                        {{ \Carbon\Carbon::parse($quotation->start_date)->format('F jS, Y') }}. Complimentary
                        cancellation is available until
                        {{ \Carbon\Carbon::parse($quotation->cancel_before)->format('F jS, Y') }}.</li>
                    <li>Any additional kilometers or hours beyond the agreed limit will be invoiced at the end of the
                        assignment.</li>
                    <li>For further clarifications please contact:<br>
                        <strong>G. A. Ranasinghe:</strong> +41 78 239 68 50
                    </li>
                </ul>
            </div>
        </div>
    </main>

    <footer>
        <table class="footer-pattern-table" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="line-pattern"></td>
                <td class="center-block"></td>
                <td class="line-pattern"></td>
            </tr>
        </table>

        <div class="footer-text">
            Tel: +41 78 239 68 50 | Email: info@eleego.ch | Website: www.eleego.ch
        </div>
    </footer>


</body>

</html>
