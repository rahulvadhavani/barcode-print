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


        /* Label size and page break settings */
        .label {
            display: flex;
            justify-content: center;
            align-items: center;
            page-break-inside: avoid;
            page-break-after: always;
            box-sizing: border-box;
            /* Ensure padding and border are included */
            padding: 0;
            margin: 0;
        }

        /* Content inside label */
        .barcode-content {
            text-align: center;
            width: 100%;
            /* height: 100%; */
            box-sizing: border-box;
            /* Ensure padding and border are included */
        }

        .barcode-html {
            width: 100%;
            /* height: auto; */
        }

        .barcode-number {
            font-size: 12pt;
            margin-top: 10pt;
        }
    </style>
</head>

<body>

    @foreach($barcodes as $barcode)
    <div class="label" style="border: 1px solid red;">
        <div class="barcode-content">
            <div class="barcode-html">{!! $barcode['barcode_html'] !!}</div>
            <div class="barcode-number">{{ $barcode['code'] }}</div>
        </div>
    </div>
    @endforeach

</body>

</html>