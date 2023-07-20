@if(isset($getAllItems) && $getAllItems->count() == 0 && $getAllItems->currentPage() > 1)
@php
// Get the current URL
$currentUrl = url()->current();

// Get the URL parameters as an associative array
$queryParams = request()->query();

// Set the previous page value
$previousPage = $queryParams['page'];

// Check if the previous page value exceeds the total number of available pages
$maxPage = $getAllItems->lastPage();
if ($previousPage > $maxPage) {
$previousPage = $maxPage;
}

// Set the updated page value in the query parameters
$queryParams['page'] = $previousPage;

// Generate the previous page URL with the updated query parameters
$previousPageUrl = $currentUrl . '?' . http_build_query($queryParams);

// Redirect to the previous page URL
header('Location: ' . $previousPageUrl);
exit;
@endphp
@endif
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item List</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .disabled-button {
        pointer-events: none;
        /* Disable mouse events */
        opacity: 0.5;
        /* Reduce opacity to indicate disabled state */
        cursor: not-allowed;
        /* Show "not allowed" cursor on hover */
    }

    .dropbtn {
        background-color: #3498DB;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropbtn:hover,
    .dropbtn:focus {
        background-color: #2980B9;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }
    th{
        font-size: 18px;
    }
    tr{
        border: 1px;
    }
    .btn{
        font-size: 13px;
    }
</style>

<body style="background-color: #E0E9F0;">

    <!--register success message -->
    @if (session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif
    <!--delete success message -->
    @if (session('message'))
        <div class="alert alert-success" id="success-message">
            {{ session('message') }}
        </div>
    @endif
    <!--delete error message -->
    @if (session('error'))
        <div class="alert alert-success" id="success-message">
            {{ session('error') }}
        </div>
    @endif


    <div class="container mt-3">
        <div class="row mb-3">
            <div class="d-flex justify-content-between col-md-8">
                <h2>{{ __('messages.Form Title') }}</h2>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('index') }}"><button type="button"
                        class="btn btn-outline-primary m-1">{{ __('messages.List') }}</button></a>
                <a href="{{ route('normalRegister') }}"><button type="button"
                        class="btn btn-outline-secondary m-1">{{ __('messages.Create') }}</button></a>
                <a href="{{ route('logout') }}"><button type="button"
                        class="btn btn-outline-danger m-1">{{ __('messages.Logout') }}</button></a>
                <!-- <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn btn-sm-3">Dropdown</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="{{ route('lang.switch', 'en') }}">English</a>
                        <a href="{{ route('lang.switch', 'my') }}">Myanmar</a>

                    </div>
                </div> -->
            </div>


        </div>
        <form action="{{ route('searchData') }}" method="GET">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id" name="item_id"
                        value="{{ old('item_id') }}" placeholder="Item ID">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="code" name="item_code"
                        value="{{ old('item_code') }}" placeholder="Item Code">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id" name="item_name"
                        value="{{ old('item_name') }}" placeholder="Item Name">
                </div>
                <div class="col-sm-2">
                    <select id="selectedBox" name="category_name" class="form-select form-select-md" >
                        <option value="">Category Name</option>
                        <!-- show all category -->
                        @foreach ($getAllCategories as $category)
                            <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                {{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1 ">
                    <button type="submit" class="btn btn-primary">{{ __('messages.Search') }}</button>
                </div>
            </div>
        </form>


        @if($getAllItems->count() == 0)
        <div class="d-flex justify-content-end mx-3"><h5>Total Row : {{ $totalCount }} row</h5></div>
        @else
        <div class="text-end mt-3 d-flex justify-content-center">
            <a
                href="{{ route('generatePDF', ['item_id' => request()->item_id, 'item_code' => request()->item_code, 'item_name' => request()->item_name, 'category_name' => request()->category_name]) }}" style="text-decoration: none;">
                <button type="submit" class="btn btn-success m-1">PDF Download</button>
            </a>
            <a
                href="{{ route('generateExcelDownload', ['item_id' => request()->item_id, 'item_code' => request()->item_code, 'item_name' => request()->item_name, 'category_name' => request()->category_name]) }}">
                <button type="submit" class="btn btn-secondary m-1">Excel Download</button>
            </a>
        </div>
        <div class="d-flex justify-content-end mx-3"><h5>Total Row : {{ $totalCount }} rows</h5></div>
        @endif

    </div>

  
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">{{ __('messages.No') }}</th>
                <th scope="col">Item ID</th>
                <th scope="col">{{ __('messages.Item Code') }}</th>
                <th scope="col">{{ __('messages.Item Name') }}</th>
                <th scope="col">{{ __('messages.Category Name') }}</th>
                <th scope="col">{{ __('messages.Safety Stock') }}</th>
                <th scope="col" colspan="5" class="text-center">{{ __('messages.Action') }}</th>
            </tr>
        </thead>
        <!-- show items -->
        @if ($getAllItems->count() == 0)
            <tr>
                <td colspan="7">
                    <h6 class="p-3 text-center">No Data Found!</h6>
                </td>
            </tr>
        @else
            @foreach ($getAllItems as $item)
                <tbody>
                    <tr>
                        <td>{{ ($getAllItems->currentPage() - 1) * $getAllItems->perPage() + $loop->iteration }}</td>
                        <td>{{ $item->item_id }}</td>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->safety_stock }}</td>
                        <td>
                            @if ($item->deleted_at == null)
                        <td>
                            <button type="button" class="btn text-light active-button"
                                id="activeButton{{ $item->id }}" data-bs-toggle="modal"
                                data-bs-target="#inactiveModal" style="background-color: #1e82a4;"
                                value="{{ $item->id }}">{{ __('messages.Active') }}</button>
                        </td>
                        <td><a href="{{ route('itemEdit', $item->id) }}" title="Edit"><i
                                    class="fa-regular fa-pen-to-square " style="color:#037171;"></i></a></td>
                        <td><a href="{{ route('showDetailItem', $item->id) }}" title="Detail"><i
                                    class="fa-regular fa-rectangle-list" style="color:#037171;"></i></a></td>
                        </td>
                        <td>
                            <button type="button" title="Delete" class="custom-button" data-bs-toggle="modal"
                                data-bs-target="#deleteItemModal" data-item-id="{{ $item->id }}" value="{{ $item->id }}">
                                <i class="fa-solid fa-trash-can" style="color:#ff0000;"></i>
                            </button>
                                  

                        </td>
                    @else
                        <td><button type="button" class="btn text-light inactive-button"
                                style="background-color:#999999;"
                                id="inactiveButton{{ $item->id }}"data-bs-toggle="modal"
                                data-bs-target="#activeModal"
                                value="{{ $item->id }}">Inactive</button>
                        </td>
                        <td><a href="" title="Edit" id="editButton" class="disabled-button"><i
                                    class="fa-regular fa-pen-to-square " style="color:#037171;"></i></a></td>
                        <td><a href="{{ route('showDetailItem', $item->id) }}" title="Detail"><i
                                    class="fa-regular fa-rectangle-list" style="color:#037171;"></i></a></td>
                        </td>
                        <td>
                            <form action="" method="POST" disabled>
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Unable to Delete" id="delete-item"
                                    class="custom-button" disabled>
                                    <i class="fa-solid fa-trash-can"
                                        style="color: #999999; pointer-events: none;"></i>
                                </button>
                            </form>

                        </td>
            @endif
            </td>
            </tr>
            </tbody>
        @endforeach
        @endif
    </table>
    <!-- Modal Box for Active Button -->
    <div id="inactiveModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content w-55" style="height: 180px; background-color: #dfd;">
                <div class="row mt-5">
                    <h5 class="text-center">Are you sure want to inactive ? </h5>
                </div>
                <div class="row ms-5 mt-3 me-1 justify-content-center">
                    <div class="col-4"><button class="btn btn-success" id="changeInactive"
                            value="">{{ __('messages.Inactive') }}</button></div>
                    <div class="col-4"><button class="btn btn-danger" data-bs-dismiss="modal"
                            style="width:90px;">Cancel</button></div>
                </div><br><br>
            </div>
        </div>
    </div>

    <!-- Modal Box for Inactive Button -->
    <div id="activeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content w-55" style="height: 180px; background-color: #dfd;">
                <div class="row mt-5">
                    <h5 class="text-center">Are you sure want to active ? </h5>
                </div>
                <div class="row ms-5 mt-3 me-1 justify-content-center">
                    <div class="col-4"><button type="button" class="btn btn-success" id="changeActive"
                            value="">{{ __('messages.Active') }}</button>
                    </div>
                    <div class="col-4"><button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            style="width:90px;">Cancel</button></div>
                </div><br><br>
            </div>
        </div>
    </div>

    <!-- Modal Box for Delete Button -->
    <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-center">
        {{ $getAllItems->withQueryString()->links() }}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    
     
    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('slow');
        }, 3000);
        $(document).ready(function() {
            $(".active-button").click(function() {
                var itemId = $(this).val(); // Get the value of the active button
                console.log(itemId);
                $("#changeInactive").val(itemId); // Set the value of the changeInactive button
            });

            // Event handler for the click event on the "Inactive" button inside the modal box
            $("#changeInactive").click(function() {
                var itemId = $(this).val();
                console.log(itemId);

                $.ajax({
                    url: " {{ route('toggleInactive') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "itemId": itemId
                    },

                    success: function(response) {
                        console.log(response);
                        $("#activeButton" + itemId).text("Inactive");
                        $("#inactiveModal").modal("hide");

                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log("Error occurred:", error);
                    },
                });
            });
        });

        $(document).ready(function() {
            $(".inactive-button").click(function() {
                var itemId = $(this).val(); // Get the value of the active button
                console.log(itemId);
                $("#changeActive").val(itemId); // Set the value of the changeInactive button
            });
            // Event handler for the click event on the "Inactive" button inside the modal box
            $("#changeActive").click(function() {
                var itemId = $(this).val();
                console.log(itemId);

                $.ajax({
                    url: " {{ route('toggleActive') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "itemId": itemId
                    },

                    success: function(response) {
                        console.log(response);
                        $("#activeButton" + itemId).text("Active");
                        $("#activeModal").modal("hide");
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log("Error occurred:", error);
                    },
                });
            });
        });

        $(document).ready(function() {
            // Store the item ID when the delete button is clicked
            $(".custom-button").click(function() {
                var itemId = $(this).val();
                $("#confirmDelete").val(itemId);
            });

            // Handle delete confirmation
            $("#confirmDelete").click(function() {
                var itemId = $(this).val();
                console.log(itemId);

                $.ajax({
                    url: "{{ route('deleteItem', '') }}" + "/" + itemId,
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log("Item deleted successfully");
                        $('.item[data-item-id="' + itemId + '"]').remove();
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log("Error occurred:", error);
                    }
                });

                $("#deleteItemModal").modal("hide"); // Hide the modal after deletion
            });
        });

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
