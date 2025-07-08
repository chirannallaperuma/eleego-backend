<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 140px 40px 150px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        header {
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            height: 100px;
        }

        .logo {
            height: 200px;
        }

        .header-table {
            width: 100%;
        }

        .invoice-title {
            font-size: 44px;
            font-weight: bold;
            color: #000;
            text-shadow: 1px 1px 2px #ad830e;
            margin-top: 5px;
        }

        .meta-info {
            font-size: 14px;
            line-height: 1.6;
        }

        .address-block {
            font-size: 14px;
            margin-top: 30px;
        }

        .section {
            margin-top: 20px;
            font-size: 14px;
        }

        table.rental-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 14px;
        }

        table.rental-table thead th {
            border-top: 2px solid #ad830e;
            border-bottom: 2px solid #ad830e;
            text-align: left;
            padding: 8px;
        }

        table.rental-table td {
            padding: 8px;
        }

        table.rental-table tfoot td {
            border-top: 2px solid #ad830e;
            font-weight: bold;
            padding: 8px;
        }

        .receipt-footer {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            border-top: 1px dashed #aaa;
            padding-top: 10px;
        }

        .receipt-left,
        .receipt-right {
            width: 48%;
        }

        .scissor-line {
            border-top: 1px dashed #aaa;
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
        }

        .company-name {
            font-size: 20px;
            text-transform: uppercase;
            margin-top: 60px;
        }

        .qr-box {
            width: 120px;
            height: 120px;
            background: #eee;
            text-align: center;
            line-height: 120px;
            border: 1px solid #ccc;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <div
        style="
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.07;
            z-index: 0;
        ">
        <img src='{{ public_path('dist/img/logo_only.jpg') }}' style="width: 400px;">
    </div>

    <!-- Header with logo and title -->
    <header>
        <table class="header-table">
            <tr>
                <td width="20%">
                    <img src="{{ public_path('dist/img/logo_only.jpg') }}" class="logo">
                </td>
                <td width="80%" style="text-align: right; vertical-align: top;">
                    <div class="company-name">Eleego Limousine & Rental Service Sàrl</div>
                    <div class="invoice-title">INVOICE</div><br>
                </td>
            </tr>
        </table>
    </header>

    <!-- PAGE 1 CONTENT -->
    <main style="margin-top: 100px;">
        <table class="header-table">
            <tr>
                <td>
                    <div class="address-block">
                        Eleego Limousine and Rental Service Sàrl<br>
                        Promenade des Artisans 32,<br>
                        1217 Meyrin,<br>
                        Switzerland
                    </div>
                </td>
                <td style="text-align: right; vertical-align: top; padding-top: 25px; font-size: 14px;">
                    Invoice no.<br>{{ $invoice->invoice_no }}<br><br>
                    Invoice date.<br>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}<br>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="section">
                        <strong>Invoice To:</strong><br>
                        {{ $invoice->client_name }}<br>
                        {!! nl2br(e($invoice->client_address)) !!}
                    </div>
                </td>
                <td style="text-align: right; vertical-align: top; padding-top: 15px;">
                    <div class="meta-info">
                        Payment terms - 30 Days<br>
                        Due date - {{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Rental table -->
        <table class="rental-table">
            <thead>
                <tr>
                    <th>Rental Period</th>
                    <th>Description</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                    <tr>
                        <td>{{ $item['date'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ number_format($item['amount'], 2) }} CHF</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ number_format($invoice->total, 2) }} CHF</td>
                </tr>
            </tfoot>
        </table>

        <!-- Payment details -->
        <div class="section" style="page-break-inside: avoid; margin-top: 30px;">
            <strong>Payment details:</strong>
            <ul style="padding-left: 20px; margin-top: 5px;">
                <li>Bank Name – PostFinance AG</li>
                <li>Bank address – PostFinance AG, Mingerstrasse 20, 3030 Bern, Switzerland</li>
                <li>IBAN – CH98 0900 0000 1605 7858 4</li>
                <li>BIC – POFICHBEXXX</li>
            </ul>
        </div>

        <!-- PAGE 1 FOOTER (contact info) -->
        <div style="position: absolute; bottom: -120px; left: 0; right: 0; font-size: 11px; padding-top: 10px;">
            <table style="width: 100%; table-layout: fixed;">
                <tr>
                    <!-- Email (left) -->
                    <td style="text-align: left; font-size: 15px; width: 33%;">
                        <table>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <img src="{{ public_path('dist/img/email_icon.jpg') }}" style="height: 35px;">
                                </td>
                                <td style="vertical-align: middle; padding-left: 5px; padding-bottom: 6px;">
                                    info@eleego.ch
                                </td>
                            </tr>
                        </table>
                    </td>

                    <!-- Web (center) -->
                    <td style="text-align: center; font-size: 15px; width: 33%;">
                        <table style="margin: 0 auto;">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <img src="{{ public_path('dist/img/web_icon.jpg') }}" style="height: 35px;">
                                </td>
                                <td style="vertical-align: middle; padding-left: 6px;">
                                    eleego.ch
                                </td>
                            </tr>
                        </table>
                    </td>

                    <!-- Phone (right) -->
                    <td style="text-align: right; font-size: 15px; width: 33%;">
                        <table style="float: right;">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <img src="{{ public_path('dist/img/phone_icon.jpg') }}" style="height: 35px;">
                                </td>
                                <td style="vertical-align: middle; padding-left: 6px;">
                                    +41 78 239 68 50
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>


    </main>

    <div class="page-break"></div>

</body>

</html>
