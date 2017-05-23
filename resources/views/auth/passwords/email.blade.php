<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('partials.favico')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>รีเซ็ตรหัสผ่าน</title>
</head>
<body>
    <div class="login">
        <div class="card login-panel">
            <form action="{{ route('password.email') }}" method="POST">
                <legend class="login-header">
                    รีเซ็ตรหัสผ่าน
                </legend>

                @if(session('status'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group{{ ($errors->has('email')) ? ' has-danger' : '' }}">
                    <label for="email">E-mail ที่ใช้สมัคร</label>
                    <input type="email" class="form-control form-control-lg{{ ($errors->has('email')) ? ' form-control-danger' : '' }}" placeholder="email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                {{csrf_field()}}
                <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">
                    <i class="fa fa-envelope"></i> รับอีเมล์สำหรับรีเซ็ตรหัสผ่าน
                </button>
                <a href="/login " class="inside-panel-link">Login</a>
            </form>
        </div>
    </div>
</body>
</html>