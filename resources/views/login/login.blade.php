<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
</head>

<body>

    <head>
        <style>
            .gradient-custom {
                /* fallback for old browsers */
                background: #6a11cb;

                /* Chrome 10-25, Safari 5.1-6 */
                background: -webkit-linear-gradient(to right,
                        rgba(106, 17, 203, 1),
                        rgba(37, 117, 252, 1));

                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                background: linear-gradient(to right,
                        rgba(106, 17, 203, 1),
                        rgba(37, 117, 252, 1));
            }
        </style>
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- MDB -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    </head>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem">
                        <div class="card-body p-5 text-center">
                            <form action="{{ route('employee') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="text-white-50 mb-5">
                                        Product Registration System
                                    </h2>
                                    <!--logout success message -->
                                    @if (session('success'))
                                        <div class="alert alert-success" id="success-message">
                                            {{ session('success') }}
                                        </div>
                                    @endif


                                    <input type="text" id="emp_id" class=" form-control form-control-lg"
                                        name="emp_id" placeholder="Enter Employee ID" /><br>
                                    <!-- check emp_id -->
                                    @if ($errors->has('emp_id'))
                                        <p class="text-danger" id="idMessage">{{ $errors->first('emp_id') }}</p>
                                    @endif
                                    <input type="password" id="password" class="form-control form-control-lg"
                                        name="password" placeholder="Enter Password" /><br>
                                    <!-- check password -->
                                    @if ($errors->has('password'))
                                        <p class="text-danger" id="passwordMessage">{{ $errors->first('password') }}</p>
                                    @endif
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MDB -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-hide success message after 5 seconds
        setTimeout(function() {
            $('#idMessage').fadeOut('slow');
        }, 3000);
        setTimeout(function() {
            $('#passwordMessage').fadeOut('slow');
        }, 3000);
        setTimeout(function() {
            $('#success-message').fadeOut('slow');
        }, 3000);
    </script>
</body>

</html>
