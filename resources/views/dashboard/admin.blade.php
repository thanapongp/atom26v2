@extends('layout.dashboard')

@section('title', 'ระบบ Admin')

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">สถานะ Server</h4>
    <div class="card-block">
        <div class="row">
            <div class="col">
                <h5>Server Load</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar"
                         style="width: {{round(sys_getloadavg()[0])}}%; height: 20px;"
                         aria-valuenow="{{round(sys_getloadavg()[0])}}"
                         aria-valuemin="0" aria-valuemax="100">
                        {{round(sys_getloadavg()[0])}}%</div>
                </div>
            </div>

            <div class="col">
                <h5>ลิงค์ต่างๆ</h5>
                <a href="/cougar">phpMyadmin</a>
                <a href="/dashboard/editor">ระบบฝ่ายไอที</a>
                <a href="/dashboard/hostess">ระบบปฏิคม</a>
            </div>
        </div>
    </div>
</div>
<div class="card dashboard-card">
    <h4 class="card-title">ข้อมูล Server</h4>
    <div class="card-block">
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>Hostname</td>
                <td>{{$_SERVER['SERVER_NAME']}}</td>
            </tr>
            <tr>
                <td>Server IP Address</td>
                <td>{{$_SERVER['SERVER_ADDR']}}</td>
            </tr>
            <tr>
                <td>OS</td>
                <td>{{php_uname('s')}}</td>
            </tr>
            <tr>
                <td>Software</td>
                <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
            </tr>
            <tr>
                <td>PHP Version</td>
                <td>{{phpversion()}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection