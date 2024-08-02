<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            color: #000;
            background-color: #B0BEC5;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            direction: rtl;
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 10px;
        }

        .card2 {
            margin: 20px;
        }

        .btn-primary {
            background-color: #1A237E;
            border: none;
        }

        .btn-primary:hover {
            background-color: #000;
        }

        .text-muted {
            font-size: 14px;
        }

        .form-control::placeholder {
            color: #BDBDBD;
            font-weight: 300;
        }

        .custom-checkbox .custom-control-label::before {
            border-color: #1A237E;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #1A237E;
        }

        a {
            color: #1A237E;
        }

        a:hover {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row px-3 mb-4">
                            <h3 class="mb-0 text-center">تسجيل الدخول</h3>
                        </div>
                        <form method="POST" action="{{ route('customLogin') }}">
                            @csrf
                            
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">البريد الإلكتروني</h6>
                                </label>
                                <input class="form-control mb-4" type="email" name="email"
                                    placeholder="أدخل بريدك الإلكتروني">
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">كلمة المرور</h6>
                                </label>
                                <input class="form-control" type="password" name="password"
                                    placeholder="أدخل كلمة المرور">
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input id="chk1" type="checkbox" name="chk" class="custom-control-input">
                                    <label for="chk1" class="custom-control-label text-muted">تذكرني</label>
                                </div>
                                <a href="#" class="ml-auto mb-0 text-muted">نسيت كلمة المرور؟</a>
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-primary text-center">دخول</button>
                            </div>
                            <div class="row px-3">
                                <small class="font-weight-bold">ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>
