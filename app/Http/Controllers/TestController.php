<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS1DFacade;

class TestController extends Controller
{
    //
    public function index()
    {
        return view('test');
        $barcodes = [
            ['id' => 12, 'code' => '123456789'],
            ['id' => 15, 'code' => '987654321'],
        ];

        // Generate the barcode HTML from the controller using DNS1DFacade
        foreach ($barcodes as &$barcode) {
            $barcode['barcode_html'] = DNS1DFacade::getBarcodeHTML($barcode['code'], 'C128');
        }

        // Load the view and pass the barcode data
        return View('pdf', compact('barcodes'));
        $pdf = FacadePdf::loadView('pdf', compact('barcodes'))
            ->setPaper([0, 0, 144, 288], 'landscape');
    }


    public function printBarcode()
    {
        // Example array of barcodes (replace with your actual data)
        $barcodes = [
            ['id' => 12, 'code' => '123456789'],
            ['id' => 15, 'code' => '987654321'],
        ];

        // Generate the barcode HTML from the controller using DNS1DFacade
        foreach ($barcodes as &$barcode) {
            $barcode['barcode_html'] = DNS1DFacade::getBarcodeHTML($barcode['code'], 'C128');
        }

        // Load the view and pass the barcode data
        $pdf = FacadePdf::loadView('pdf', compact('barcodes'))
            ->setPaper([0, 0, 144, 288], 'landscape'); // 2" x 4" size (144 x 288 points)

        // Convert the PDF to raw data (binary)
        $pdfContent = $pdf->output();

        // Encode the binary PDF data to base64
        $base64Pdf = base64_encode($pdfContent);

        // Return the response as a JSON object with the PDF and barcode data
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'pdf' => 'data:application/pdf;base64,' . $base64Pdf, // PDF as base64 data URL
            'data' => $barcodes, // Return the barcode data with barcode_html
        ]);
    }
}
