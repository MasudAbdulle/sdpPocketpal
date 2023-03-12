<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <!-- load PDF.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js"></script>

    <!-- load PDF viewer styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf_viewer.min.css" />
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="file" name="pdf_file" accept="application/pdf">
        <button type="submit">Upload PDF</button>
    </form>

    <!-- embed PDF viewer -->
    <div id="pdf-viewer"></div>

    <script>
        // handle form submit event
        document.querySelector('form').addEventListener('submit', function(event) {
            // prevent default form submission
            event.preventDefault();

            // get file input element and selected file
            var input = document.querySelector('input[type="file"]');
            var file = input.files[0];

            // create FormData object and append file to it
            var formData = new FormData();
            formData.append('pdf_file', file);

            // send POST request to upload.php using XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
            xhr.onload = function() {
                // handle response from server
                if (xhr.status === 200) {
                    console.log(xhr.responseText);

                    // load uploaded PDF document using PDF.js
                    var pdf_url = 'pdfs/' + file.name;
                    pdfjsLib.getDocument(pdf_url).promise.then(function(pdf) {
                        // get PDF viewer container element
                        var container = document.getElementById('pdf-viewer');

                        // create PDF viewer instance and set options
                        var viewer = new pdfjsViewer.PDFViewer({
                            container: container
                        });

                        // set document on viewer instance
                        viewer.setDocument(pdf);

                        // initialize viewer
                        viewer.eventBus.on('pagesinit', function() {
                            viewer.currentScaleValue = 'page-width';
                        });
                    }).catch(function(error) {
                        console.error('Error loading PDF document: ' + error);
                    });
                } else {
                    console.error(xhr.statusText);
                }
            };
            xhr.send(formData);
        });
    </script>
    
    <?php
    // check if PDF file was uploaded
    if (isset($_FILES['pdf_file'])) {
        // get PDF file details
        $pdf_name = $_FILES['pdf_file']['name'];
        $pdf_tmp_name = $_FILES['pdf_file']['tmp_name'];
        $pdf_size = $_FILES['pdf_file']['size'];
        $pdf_error = $_FILES['pdf_file']['error'];
    
        // check for upload errors
        if ($pdf_error === UPLOAD_ERR_OK) {
            // move uploaded file to designated folder on server
            move_uploaded_file($pdf_tmp_name, 'pdfs/' . $pdf_name);
    
            // send response to client
            echo 'PDF uploaded successfully';
        } else {
            echo 'Error uploading PDF: ' . $pdf_error;
        }
    }
    ?>
</body>
</html>
