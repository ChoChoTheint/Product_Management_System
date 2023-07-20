<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Items List</h2>
    <div class="container">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Item ID</th>
                    <th scope="col">Item Code</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Safety Stock</th>
                    <th scope="col">Received Date</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <!-- get items -->
            @foreach ($getAllItems as $item)
                <tbody>
                    <tr>
                        <td class="p-3" id="table-border"> {{ $loop->iteration }}</td>
                        <td>{{ $item->item_id }}</td>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->safety_stock }}</td>
                        <td>{{ $item->received_date }}</td>
                        <td>{{ $item->description }}</td>
                    </tr>
                </tbody>
            @endforeach

        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
