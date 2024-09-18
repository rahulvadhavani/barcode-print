<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Labels</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Label size with padding */
        .label {
            display: flex;
            justify-content: center;
            align-items: center;
            /* width: 100mm; */
            /* height: 40mm; */
            /* padding: 10px 15px; */
            box-sizing: border-box;
            page-break-inside: avoid;
            page-break-after: always;
            /* border: 1px solid red; */
        }

        /* Content inside label */
        .barcode-content {
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        /* Barcode image styling */
        .barcode-image {
            max-width: 100%;
            width: 100%;
            height: auto;
        }
        @page{ margin: 30px 40px;}

    </style>
</head>

<body>

    @foreach($barcodes as $barcode)
    <div class="label">
        <div class="barcode-content">
            <!-- Display the PNG barcode image -->
            <img src="data:image/png;base64,{{ $barcode['barcode_html'] }}" alt="Barcode" class="barcode-image" />
            <!-- <div class="barcode-number">{{ $barcode['code'] }}</div> -->
        </div>
    </div>
    @endforeach

