<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phoenix Gastrobar | Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <style>
        :root {
            --primary: #E25E3E;
            --secondary: #FF9B50;
            --third: #FFBB5C;
        }

        .login-page {
            background-image: url("{{ asset('image/assets/logo.png') }}");
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(8px);
            aspect-ratio: auto;
        }

        .img-circle {
            border-color: var(--primary);
        }

        .login-logo b {
            color: var(--primary);
        }

        button[type="submit"] {
            background-color: var(--primary);
            color: white;
        }

        button[type="submit"]:hover {
            background-color: var(--third);
            color: black;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="{{ asset('image/assets/logo.png') }}"
            alt="Phoenix Gatrobar Logo">
    </div>
    <div class="login-box ">
        <div class="login-logo">
            <a href="{{ asset('AdminLTE/index2.html') }}"><b>Phoenix</b>Gastrobar</a>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ganti Password</p>

                <form action="{{ route('change') }}" method="POST" id="changePassword">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password Lama" name="old"
                            id="old">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password Baru" name="new"
                            id="new">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password Baru" name="con"
                            id="con">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">Show Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" id="ganti">Ganti
                                password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            let jum = 1;
            const oldP = $('#old');
            const newP = $('#new');
            const conP = $('#con');
            $('#exampleCheck1').change(function() {
                if (jum++ % 2 !== 0) {
                    oldP.attr('type', 'text');
                    newP.attr('type', 'text');
                    conP.attr('type', 'text');
                } else {
                    oldP.attr('type', 'password');
                    newP.attr('type', 'password');
                    conP.attr('type', 'password');
                }
            })


            $.validator.addMethod("passwordMatch", function(value, element) {
                var newPassword = $("#new").val();
                return newPassword === value;
            }, "Password confirmation does not match");

            $('#changePassword').validate({
                rules: {
                    old: {
                        required: true
                    },
                    new: {
                        required: true,
                        minlength: 8
                    },
                    con: {
                        required: true,
                        passwordMatch: true // Apply custom rule to check for equality
                    }
                },
                messages: {
                    old: {
                        required: "Please enter your old password"
                    },
                    new: {
                        required: "Please enter a new password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    con: {
                        required: "Please confirm your new password",
                        passwordMatch: "Password confirmation does not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error); // Adjusted the error placement
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
