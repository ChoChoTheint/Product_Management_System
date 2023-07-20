<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Excel Upload Register</title>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .btn {
        font-size: 13px;
    }
</style>
</head>

<body style="background-color: #E0E9F0;">
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-md-8"><h2>Product Registration System</h2></div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('index') }}"><button type="button" class="btn btn-outline-primary m-1">List</button></a>
                <a href="{{ route('normalRegister') }}"><button type="button" class="btn btn-outline-secondary m-1">Create</button></a>
                <a href="{{ route('logout') }}"><button type="button" class="btn btn-outline-danger m-1">Logout</button></a>
            </div>
        </div>
        <div class="m-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">
                    <a href="{{ route('normalRegister') }}" class="text-dark text-decoration-none">Normal Register</a>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="inlineRadio2" value="option2" checked>
                <label class="form-check-label" for="inlineRadio2">
                    <a href="{{ route('excelUpload') }}" class="text-dark text-decoration-none">Excel Upload
                        Register</a>
                </label>
            </div>
        </div>
        <div
            class="m-3 d-flex aligns-items-center justify-content-center card text-center w-75 h-70 position-absolute top-50 start-50 translate-middle bg-light bg-darken-xl">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('excelDownload') }}" class="btn btn-success">Excel Download Format</a>
                </div>
                <div class="border border-dark border-opacity-25 p-4 h-75 mt-4">
                    <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data"
                        class="text-center">
                        @csrf
                        <!-- get error message for all-->
                        @if ($errors->any())
                            <div class="card mb-4  text-danger" id="error-message">
                                <div class="card-body">
                                    <!-- error message for all -->
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach

                                </div>
                            </div>
                        @endif
                        <div>
                            <input type="file" name="file" class="mt-5" />
                        </div>
                        <div class="d-flex justify-content-center pt-5 ">
                            <button type="submit" class="btn btn-primary" name="importBtn">
                                <i class="fa fa-upload mx-3" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-hide success message after 5 seconds
        setTimeout(function() {
            $('#error-message').fadeOut('slow');
        }, 3000);
    </script>
</body>

</html>
