<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; color: #333; }
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
        table.items th { background-color: #f4f4f4; }

        /* Total */
        .total { text-align: right; font-size: 16px; font-weight: bold; }

        /* Bank Info */
        .bank-info { margin-top: 20px; line-height: 1.5; }

        /* Notes */
        .notes { margin-top: 10px; font-style: italic; }

        /* Footer */
        .footer { margin-top: 30px; font-size: 12px; text-align: center; color: #777; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="clearfix">
        <div class="company-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Company Logo">
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
                <th style="width: 50%;">Description</th>
                <th style="width: 15%;">Price</th>
                <th style="width: 15%;">Amount</th>
                <th style="width: 20%;">Tax ({{ $invoice->tax }}%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                @php
                    $itemTotal = $item->quantity * $item->unit_price;
                    $itemTax = $itemTotal * ($invoice->tax / 100);
                @endphp
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>Rp{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($itemTotal, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($itemTax, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $total = 0;
                foreach($invoice->items as $item) {
                    $total += $item->quantity * $item->unit_price;
                }
                $taxAmount = $total * ($invoice->tax / 100);
                $grandTotal = $total + $taxAmount;
            @endphp
            <tr>
                <td colspan="2" class="total">Total</td>
                <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($taxAmount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="total">Grand Total</td>
                <td>Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
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
        <p>If you have any questions, please contact: info@perusahaan.com</p>
        <p>www.nofileexistshere.my.id/</p>
    </div>
</body>
</html>
