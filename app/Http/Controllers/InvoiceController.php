<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{
   public function exportPdf($id)
    {
        $invoice = Invoice::with(['client', 'project', 'items'])->findOrFail($id);

        // Bersihkan semua string di array
        $cleanData = json_decode(json_encode($invoice), true);
        array_walk_recursive($cleanData, function (&$value) {
            if (is_string($value)) {
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
            }
        });

        $html = view('invoices.pdf', ['invoice' => $cleanData])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Invoice-{$invoice->invoice_number}.pdf", ["Attachment" => true]);
    }
}
