<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normal Register</title>
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
    <!-- nav -->
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-md-8">
                <h2>Product Registration System</h2>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('index') }}"><button type="button"
                        class="btn btn-outline-primary m-1">List</button></a>
                <a href="{{ route('normalRegister') }}"><button type="button"
                        class="btn btn-outline-secondary m-1">Create</button></a>
                <a href="{{ route('logout') }}"><button type="button"
                        class="btn btn-outline-danger m-1">Logout</button></a>
            </div>
        </div>
        <!-- register form -->
        <div class="m-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="inlineRadio1" value="option1" checked>
                <label class="form-check-label" for="inlineRadio1">Normal Register</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">
                    <a href="{{ route('excelUpload') }}" class="text-dark text-decoration-none">Excel Upload
                        Register</a>
                </label>
            </div>
        </div>
        <!-- normal register form -->
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="id" class="col-sm-2 col-form-label">Item ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="item_id" value="{{ $itemId }}"
                        readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="code" class="col-sm-2 col-form-label">Item Code <span
                        style="color: red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="code" name="item_code"
                        value="{{ old('item_code') }}">
                    <!-- error message for item_code -->
                    @if ($errors->has('item_code'))
                        <p class="text-danger" id="idMessage">{{ $errors->first('item_code') }}</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="item_name" class="col-sm-2 col-form-label">Item Name <span style="color: red;">*</span>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="item_name" name="item_name"
                        value="{{ old('item_name') }}">
                    <!-- error message for item_name -->
                    @if ($errors->has('item_name'))
                        <p class="text-danger" id="idMessage">{{ $errors->first('item_name') }}</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="category_name" class="col-sm-2 col-form-label">Category Name <span
                        style="color: red;">*</span> </label>
                <div class="col-sm-8">
                    <select id="selectedBox" name="category_id" class="form-select form-select-md">
                        <option value="" id="selectedBox">Open this select menu</option>
                        <!-- get all category -->
                        @foreach ($getAllCategories as $category)
                            <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                {{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <!-- error message for category_id -->
                    @if ($errors->has('category_id'))
                        <p class="text-danger" id="idMessage">{{ $errors->first('category_id') }}</p>
                    @endif
                </div>


                <div class="col-sm-2">
                    <button type="button" id="addCategory" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#addModal">+</button>
                    <!--register success message -->
                    @if (session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    <button type="button" id="removeCategory" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">-</button>
                    <!--register success message -->
                    @if (session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="stock" class="col-sm-2 col-form-label"> Safety Stock <span
                        style="color: red;">*</span> </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stock" name="stock"
                        value="{{ old('stock') }}">
                    <!-- error message for stock -->
                    @if ($errors->has('stock'))
                        <p class="text-danger" id="idMessage">{{ $errors->first('stock') }}</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="date" class="col-sm-2 col-form-label">Received Date <span
                        style="color: red;">*</span> </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date" name="date"
                        value="{{ old('date') }}">
                    <!-- error message for date -->
                    @if ($errors->has('date'))
                        <p class="text-danger" id="idMessage">{{ $errors->first('date') }}</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" id="" cols="120" rows="3" name="description"
                        value="{{ old('description') }}"></textarea>
                </div>
            </div>

            <div class="input-group mb-3">
                <label for="file" class="col-sm-2 col-form-label">Upload Photo</label>
                <input type="file" class="form-control m-1" id="choosePhoto" name="file">
                <input type="button" value="Remove" id="removePhotoButton" class="btn btn-danger">
            </div>
            @if ($errors->has('file'))
                <p class="text-danger" id="idMessage">{{ $errors->first('file') }}</p>
            @endif
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>

    <!-- add category modal -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content w-100" style="height: 180px; background-color: rgb(74, 234, 215);">
                <div class="row mt-3">
                    <h5 class="text-center">Add Catagory <span style="color: red;">*</span></h5>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-1" id="dialogCategoryInput" name="categoryName"
                        placeholder="Enter Category Name">
                    <div id="errorContainer" class="mb-1" style="color: red;"></div>
                    <button type="button" class="btn btn-secondary" id="btn-closeAdd" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="addCategoryButton" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete category modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content w-100" style="height: 180px; background-color: rgb(240, 104, 104);">
                <div class="row mt-3">
                    <h5 class="text-center">Delete Catagory </h5>
                </div>
                <div class="modal-body">
                    <select name="category_id" class="form-select form-select-md mb-1"
                        id="removeDialogCategorySelect">
                        <option value="notSelect" id="selectedBox">Open this select menu</option>
                        @foreach ($getAllCategories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <!-- <p id="noDeleteAbleCategory"></p> -->
                    <div id="errorRemoveContainer" style="color: white;" class="mb-1"></div>
                    <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="removeCategoryButton" class="btn btn-primary">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // add category
            $('#addCategoryButton').click(function() {
                var categoryName = $('#dialogCategoryInput').val();
                if (categoryName === '') {
                    $('#errorContainer').text("* Please enter a category name.");
                    return true;
                } else {
                    $('#errorContainer').text("");
                }
                var trimCategoryName = categoryName.trim().toLowerCase();
                var duplicateName = false;
                var selectOptions = document.getElementById("selectedBox").options;
                for (var i = 0; i < selectOptions.length; i++) {
                    if (selectOptions[i].text.trim().toLowerCase() == trimCategoryName) {
                        duplicateName = true;
                        break; // Exit the loop early if a duplicate is found
                    }
                }
                if (duplicateName) {
                    $("#errorContainer").text("* Category Name is already exit!.");
                    return;
                }
                $.ajax({
                    url: "{{ route('categories.store') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'category_name': categoryName
                    },
                    success: function(response) {
                        var latestChildValue = $('#selectedBox option:last-child').val();
                        var newChildValue = parseInt(latestChildValue) + 1;

                        var option = $('<option>').val(newChildValue).text(categoryName);
                        $('#selectedBox').append(option);
                        $('#selectedCategory').val(newChildValue);
                        alert('Category created successfully!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to save category');
                    }
                });
            });
             //remove error message
             $("#btn-closeAdd").click(function() {
                $("#errorContainer").text("");
                $("#dialogCategoryInput").text("");
            });
            // remove category
            $('#removeCategoryButton').click(function() {
                var selectedValue = $('#removeDialogCategorySelect').val();
                if (selectedValue === "notSelect") {
                    $('#errorRemoveContainer').text('* Not category selected!');
                    return true;
                    location.reload();
                }
                var categoryCount = $("#selectedBox option").length;
                $.ajax({
                    url: "{{ route('categories.destory') }}",
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'category_name': selectedValue

                    },
                    success: function(response) {
                        if (response.success == true) {
                            $('#selectedBox option').each(function() {
                                if ($('#selectedBox option').text() === selectedValue) {
                                    $('#selectedBox option').text().remove();
                                }
                            })
                            alert('Category deleted successfully!');
                            location.reload();
                        } else {
                            $("#errorRemoveContainer").text("Category can\'t deleted!");
                            $('#errorContainer').text("");
                
                        }
                       
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to deleted category!');
                    }
                });

            });
             //remove error message
             $("#btn-close").click(function() {
                $("#errorRemoveContainer").text("");
            });
            //remove photo
            $('#removePhotoButton').click(function() {
                $('#choosePhoto').val('');
            });
        });
    </script>
</body>

</html>
