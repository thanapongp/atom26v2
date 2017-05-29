@extends('layout.main')

@section('title', 'ตารางการแข่งขัน')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div>ตาราง<span style="color: #FFA02F">การแข่งขันรวม</span></div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered schedule-table">
            <thead class="thead-inverse">
            <tr>
                <th>กีฬา / กิจกรรม <br> <span class="hidden-md-down">(คลิกเพื่อดูตารางแข่งขัน)</span></th>
                <th>สถานที่</th>
                <th>ส <br> 27 พ.ค.</th>
                <th>อา <br> 28 พ.ค.</th>
                <th>จ <br> 29 พ.ค.</th>
                <th>อ <br> 30 พ.ค.</th>
                <th>พ <br> 31 พ.ค.</th>
                <th>พฤ <br> 1 มิ.ย.</th>
                <th>ศ <br> 2 มิ.ย.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>พิธีเปิด</td>
                <td>สนามกีฬากลาง ม.อุบลฯ</td>
                <td><i class="fa fa-circle"></i></td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/1.pdf">กรีฑา</a></td>
                <td>สนามกีฬากลาง ม.อุบลฯ</td>
                <td></td><td></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td><td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/11.pdf">เซปักตะกร้อ</a></td>
                <td>สนามตะกร้อกลางแจ้ง ลานบึกบึน</td>
                <td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/67.pdf">บริดจ์</a></td>
                <td>2C-06, 2C-05 สำนักคอมพวิเตอร์ฯ</td>
                <td></td><td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td><td></td><td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/67.pdf">หมากกระดาน</a></td>
                <td>2C-06, 2C-05 สำนักคอมพวิเตอร์ฯ</td>
                <td></td><td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/2.pdf">บาสเก็ตบอล</a></td>
                <td>ศูนย์กีฬาเอนกประสงค์</td>
                <td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/5.pdf">เปตอง</a></td>
                <td>สนามเปตอง ม.อุบลฯ</td>
                <td></td><td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/8.pdf">ฟุตซอล</a></td>
                <td>สนามฟุตซอล ม.อุบลฯ</td>
                <td></td><td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/3.pdf">ฟุตบอล</a></td>
                <td>สนามข้างแฟลตบุคลากร</td>
                <td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/4.pdf">วอลเลย์บอล</a></td>
                <td>โรงพละ ม.อุบลฯ</td>
                <td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/9.pdf">E-Sport</a></td>
                <td>อาคารวิจัย คณะวิทย์ฯ</td>
                <td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="/schedule_files/10.pdf">วิชาการ</a></td>
                <td>อาคารวิจัย คณะวิทย์ฯ</td>
                <td></td><td></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-circle"></i></td>
                <td><i class="fa fa-trophy fa-2x text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td>พิธีปิด</td>
                <td>สนามกีฬากลาง ม.อุบลฯ</td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td><i class="fa fa-circle"></i></td>
            </tr>
            </tbody>
        </table>

        <div class="text-right">
            <i class="fa fa-circle"></i> = การแข่งขันปกติ <br>
            <i class="fa fa-trophy fa-2x text-warning"></i> = การแข่งชิงเหรียญ
        </div>
    </div>
</div>
@endsection