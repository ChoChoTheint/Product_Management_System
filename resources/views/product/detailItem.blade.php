@php
$currentUrl = url()->current();
$previousUrl = url()->previous();
if ($currentUrl != $previousUrl)
Session::put('requestReferrer', $previousUrl);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
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
        <div class="row mb-5">
            <div class="col-md-8">
                <h2>Product Registration System</h2>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ Session::get('requestReferrer') }}" class="btn btn-outline-warning m-1" title="Back">Back</a>
                <a href="{{ route('index') }}" class="btn btn-outline-primary m-1">List</a>
                <a href="{{ route('normalRegister') }}" class="btn btn-outline-secondary m-1">Create</a>
                <a href="{{ route('logout') }}" class="btn btn-outline-danger m-1">Logout</a>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="card" style="width: 48rem;">
                <div class="card-header">
                    <h1>Item Details</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Item Code: {{ $getDetailItem->item_code }}</p>
                            <p>Item Name: {{ $getDetailItem->item_name }}</p>
                            <p>Category Name: {{ $getDetailItem->category_name }}</p>
                            <p>Safety Stock: {{ $getDetailItem->safety_stock }}</p>
                            <p>Received Date: {{ $getDetailItem->received_date }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p>Description: {{ $getDetailItem->description ?? 'Description do not have.' }} </p>
                            <!-- check image have or null -->
                            @if (isset($getDetailItem->file_path))
                                <p>Photo: </p><img src="{{ asset('file/' . $getDetailItem->file_path) }}"
                                    alt="image" height="200" width="200">
                            @else
                                <img class="rounded"
                                    src="https://w7.pngwing.com/pngs/753/432/png-transparent-user-profile-2018-in-sight-user-conference-expo-business-default-business-angle-service-people-thumbnail.png"
                                    alt="image" height="200" width="200">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
