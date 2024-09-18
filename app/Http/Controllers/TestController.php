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
        // $barcodes = [
        //     ['id' => 12, 'code' => '123456789'],
        //     ['id' => 15, 'code' => '987654321'],
        // ];

        // // Generate the barcode HTML using DNS1DFacade
        // foreach ($barcodes as &$barcode) {
        //     $barcode['barcode_html'] = DNS1DFacade::getBarcodePNG($barcode['code'], 'C128',2,40,[0,0,0],true);
        // }

        // // Generate the PDF by loading the view and setting paper size
        // // return View('pdf', compact('barcodes'));
        // $pdf = FacadePdf::loadView('pdf', compact('barcodes'))
        //     ->setPaper([0, 0, 113.39, 283.46], 'landscape'); // 100mm x 40mm size in points

        // Stream the PDF to the browser with a file name
        return $pdf->stream('barcode-labels.pdf');
    }


    public function printBarcode()
    {
        // Example array of barcodes (replace with your actual data)
        $barcodes = [
            ['id' => 12, 'code' => '123456789'],
            ['id' => 15, 'code' => '987654321'],
        ];

        // Generate the barcode HTML from the controller using DNS1DFacade
        // Generate the barcode HTML using DNS1DFacade
        foreach ($barcodes as &$barcode) {
            $barcode['barcode_html'] = DNS1DFacade::getBarcodePNG($barcode['code'], 'C128', 2, 40, [0, 0, 0], true);
        }

        // Generate the PDF by loading the view and setting paper size
        // return View('pdf', compact('barcodes'));
        $pdf = FacadePdf::loadView('pdf', compact('barcodes'))
            ->setPaper([0, 0, 113.39, 283.46], 'landscape'); // 100mm x 40mm size in points

        // Load the view and pass the barcode data
        // $pdf = FacadePdf::loadView('pdf', compact('barcodes'))
        // ->setPaper([0, 0, 144, 288], 'landscape'); // 2" x 4" size (144 x 288 points)

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
