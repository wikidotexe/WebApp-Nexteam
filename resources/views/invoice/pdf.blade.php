<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 297mm; /* Tinggi kertas A4 */
        }

        .clearfix::after { content: ""; display: table; clear: both; }

        /* Header */
        .company-logo { float: left; }
        .company-logo img { max-height: 60px; }
        .invoice-title { float: right; text-align: right; font-size: 32px; font-weight: bold; color: #2c3e50; }

        /* Top Info */
        .top-info { margin-top: 20px; }
        .top-info table { width: 100%; }
        .top-info td { vertical-align: top; padding: 5px; }

        /* Items Table */
        table.items { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table.items th, table.items td { border: 1px solid #ddd; padding: 8px; }
        table.items th {
            background-color: #3498db;
            color: white;
            text-align: left;
        }
        table.items td { vertical-align: top; }

        /* Right align numeric columns */
        .text-right { text-align: right; }

        /* Total styles */
        .total { text-align: left; font-size: 16px; font-weight: bold; }

        /* Bank Info */
        .bank-info { margin-top: 20px; line-height: 1.5; }

        /* Notes */
        .notes { margin-top: 10px; font-style: italic; }

        /* Footer fixed di bawah kertas */
        .footer {
            position: absolute;
            bottom: -10mm; /* Jarak dari bawah kertas */
            left: 0;
            width: 100%;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>

</head>
<body>
    <!-- Header -->
    <div class="clearfix">
        <div class="company-logo">
            <img src="{{ public_path('front/images/Logo NFEH.png') }}" alt="Company Logo">
            <p><strong>NoFileExistsHere.</strong><br>
               Jl. Perumahan Pesona Grogol 2, Depok<br>
               info@nofileexistshere.my.id | (08) 889177045
            </p>
        </div>
        <div class="invoice-title">
            INVOICE
        </div>
    </div>

    <!-- Bill To & Invoice Info -->
    <div class="top-info">
        <table>
            <tr>
                <td>
                    <strong>Bill to:</strong><br>
                    {{ $invoice->client->name }}<br>
                    {{ $invoice->client->address ?? '-' }}<br>
                    {{ $invoice->client->email ?? '' }}<br>
                    {{ $invoice->client->phone ?? '' }}
                </td>
                <td style="text-align: right;">
                    <strong>Invoice No:</strong> {{ $invoice->invoice_number }}<br>
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d F, Y') }}<br>
                    <strong>Status:</strong> {{ ucfirst($invoice->status) }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Items Table -->
    <table class="items">
        <thead>
            <tr>
                <th style="width: 40%;">Description</th>
                <th style="width: 15%;">Price</th>
                <th style="width: 10%;">Qty</th>
                <th style="width: 10%;">Tax ({{ $invoice->tax ?? 0 }}%)</th>
                <th style="width: 25%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                @php
                    $qty = $item->quantity;
                    $unit = $item->unit_price;
                    $itemTotal = $qty * $unit; // harga sebelum pajak
                    $itemTax = $itemTotal * (($invoice->tax ?? 0) / 100); // pajak untuk item
                    $itemAmount = $itemTotal + $itemTax; // amount = item + tax
                @endphp
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="text-right">Rp{{ number_format($unit, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $qty }}</td>
                    <td class="text-right">Rp{{ number_format($itemTax, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($itemAmount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $total = 0;      // sum of itemTotal (without tax)
                $totalTax = 0;   // sum of itemTax
                foreach($invoice->items as $item) {
                    $itemTotal = $item->quantity * $item->unit_price;
                    $itemTax = $itemTotal * (($invoice->tax ?? 0) / 100);
                    $total += $itemTotal;
                    $totalTax += $itemTax;
                }
                $grandTotal = $total + $totalTax; // sum(amounts)
            @endphp
            <tr>
                <td colspan="4" class="total">Total</td>
                <td class="text-right">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Notes -->
    <div class="notes">
        <p>Note : {{ $invoice->notes ?? 'none' }}</p>
    </div>

    <!-- Bank Info -->
    <div class="bank-info">
        <p><strong>Bank Account:</strong></p>
        <p>{{ $invoice->bank_name ?? 'Sea Bank' }}<br>
           {{ $invoice->bank_account ?? '901859577634' }} - {{ $invoice->account_holder ?? 'Dwiki Arlian Maulana' }}
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>If you have any questions, please contact: info@nofileexistshere.my.id</p>
        <p>www.nofileexistshere.my.id</p>
    </div>
</body>
</html>
