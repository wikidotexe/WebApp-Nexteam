<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{
    public function exportPdf($id)
    {
        $invoice = Invoice::findOrFail($id);

        $html = view('invoices.pdf', compact('invoice'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Invoice-{$invoice->invoice_number}.pdf", ["Attachment" => true]);
    }
}
