<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <!-- Print Button -->
    <div class="container text-center mt-5">
        <button id="printButton" class="btn btn-primary">
            Print Barcode
        </button>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="barcodeModal" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalLabel">Barcode PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="barcodeIframe" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Load the PDF in the iframe -->
    <script type="text/javascript">
        $(document).ready(function () {
    $('#printButton').on('click', function () {
        // Send an AJAX request to get the PDF and data
        $.ajax({
            url: "{{ route('test-print') }}", // Call the Laravel route
            method: 'GET',
            success: function (response) {
                if (response.status) {
                    // Set the iframe src to the base64 PDF
                    $('#barcodeIframe').attr('src', response.pdf);

                    // Display additional data (if needed)
                    console.log(response.data); // This contains the id and code array

                    // Show the modal with the PDF
                    $('#barcodeModal').modal('show');
                } else {
                    console.error('Failed to generate PDF');
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    // Clear the iframe when the modal is hidden
    $('#barcodeModal').on('hidden.bs.modal', function () {
        $('#barcodeIframe').attr('src', ''); // Clear iframe
    });
});

    </script>

</body>
</html>
