<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Model</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dropzone.css">
    <script type="text/javascript" src="../js/dropzone.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Model</h2>
                    <h5>File</h5>
                    <div class="file_upload">
                        <form action="../utils/file_upload.php" class="dz-clickable" id="dropzone">
                            <div class="dz-message needsclick">
                                <strong>Drop files here or click to upload.</strong>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button id="uploadBtn" class="btn btn-primary">Upload</button>
                        <a href="../index.php" class="btn btn-danger ml-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            var myDropzone = new Dropzone('#dropzone', {
                url: '../utils/file_upload.php',
                paramName: 'file',
                uploadMultiple: true,
                autoProcessQueue: false,
                success: function(file, response) {}
            });

            $('#uploadBtn').click(function() {
                myDropzone.processQueue()
            });
            $("#dropzone").addClass('dropzone')
        });
    </script>
</body>