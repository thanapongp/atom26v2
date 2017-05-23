<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('partials.favico')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>เข้าสู่ระบบไตรธาราเกมส์</title>
</head>
<body>
    <div class="login">
        <div class="card login-panel">
            <form action="{{route('auth.login')}}" method="POST">
                <legend class="login-header">
                    เข้าสู่ระบบไตรธาราเกมส์
                </legend>

                @if(session('status'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group{{ ($errors->has('username')) ? ' has-danger' : '' }}">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-lg{{ ($errors->has('username')) ? ' form-control-danger' : '' }}" placeholder="Username" name="username" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <span class="help-block text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div class="form-group{{ ($errors->has('password')) ? ' has-danger' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-lg{{ ($errors->has('username')) ? ' form-control-danger' : '' }}" placeholder="Password" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">
                    <i class="fa fa-sign-in"></i> เข้าสู่ระบบ
                </button>
                <a href="/password/reset" class="inside-panel-link">ลืมรหัสผ่าน</a>
            </form>
        </div>
    </div>
</body>
</html>