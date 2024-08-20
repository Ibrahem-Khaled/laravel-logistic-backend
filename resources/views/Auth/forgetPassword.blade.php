<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>استعادة كلمة المرور</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <style>
        body {
            color: #fff;
            background-color: #53045F;
            background-size: cover;
            height: 100%;
            direction: rtl;
            font-family: "Cairo", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            background-color: #fff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            display: flex;
            overflow: hidden;
            margin-top: 100px;
        }

        .image-container {
            background-image: url('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse3.mm.bing.net%2Fth%3Fid%3DOIP.zyvdkrnveztTW6Dt-VeNfQHaD4%26pid%3DApi&f=1&ipt=e2cc5542d280de32ed56b8eb717f4d4f0cf2631ade2ed857c815dcfdf4d2fa8e&ipo=images');
            background-size: cover;
            background-position: center;
            width: 50%;
            height: auto;
        }

        .form-container {
            padding: 50px;
            width: 50%;
            background-color: #f8f9fa;
            color: #000;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 120px;
        }

        .btn-primary {
            background-color: #ff5722;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e64a19;
        }

        a {
            color: #ff5722;
        }

        a:hover {
            color: #e64a19;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-container"></div>
        <div class="form-container">
            <div class="logo-container">
                <img src="{{ asset('assets/img/logo-ct-dark.png') }}" alt="Logo">
            </div>
            <h3 class="mb-4 text-center">استعادة كلمة المرور</h3>
            <form method="POST" action="{{ route('resetPassword') }}">
                @csrf
                <div class="form-group mb-4">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" placeholder="أدخل بريدك الإلكتروني">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">إرسال رابط استعادة كلمة المرور</button>
                <small class="d-block text-center">تذكرت كلمة المرور؟ <a href="{{ route('login') }}">تسجيل
                        الدخول</a></small>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>
