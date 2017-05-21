@extends('layout.main')

@section('css')
@endsection

@section('title', 'ลงทะเบียนผู้เข้าร่วมงาน')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div>
            <span>ลงทะเบียนเข้าร่วมงาน</span>
        </div>
    </div>

    <div class="container" style="margin-top: 1rem">
    <form action="{{route('auth.registerPost')}}" method="POST" 
    enctype="multipart/form-data">
        <div class="row" style="margin-bottom: 1rem">
            <div class="col-4 text-right"><h4>ข้อมูลทั่วไป</h4></div>
            <div class="col-6"></div>
        </div>

        <div class="form-group row">
            <label for="gender" class="col-4 col-form-label text-right">เพศ<span style="color: red">*</span></label>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="ชาย"
                        {{old('gender') == 'ชาย' ? ' checked' : ''}}{{! old('gender') ? ' checked' : ''}}>
                        ชาย
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="หญิง"
                        {{old('gender') == 'หญิง' ? ' checked' : ''}}>
                        หญิง
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="title" class="col-4 col-form-label text-right">คำนำหน้าชื่อ<span style="color: red">*</span></label>
            <div class="col-6">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="title" value="นาย"
                        {{old('title') == 'นาย' ? ' checked' : ''}}{{! old('title') ? ' checked' : ''}}>
                        นาย
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="title" value="นางสาว"
                        {{old('title') == 'นางสาว' ? ' checked' : ''}}>
                        นางสาว
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="title" id="othertitle" 
                        value="{{(old('title') != 'นาย' || old('title') != 'นางสาว') ? old('title') : ''}}"
                        {{(old('title') != 'นาย' || old('title') != 'นางสาว') && old('title') ? ' checked' : ''}}>
                        <input class="form-control" type="text" placeholder="อื่นๆ" 
                        onkeyup="syncValue(this.value, 'othertitle');"
                        value="{{(old('title') != 'นาย' || old('title') != 'นางสาว') ? old('title') : ''}}">
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group row{{ ($errors->has('firstname')) ? ' has-danger' : '' }}">
            <label for="firstname" class="col-4 col-form-label text-right">
                ชื่อ<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('firstname')) ? ' form-control-danger' : '' }}" 
                name="firstname" type="text" value="{{old('firstname')}}" required>
                @if ($errors->has('firstname'))
                <span class="form-text text-danger">{{ $errors->first('firstname') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('lastname')) ? ' has-danger' : '' }}">
            <label for="lastname" class="col-4 col-form-label text-right">
                นามสกุล<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('lastname')) ? ' form-control-danger' : '' }}" 
                name="lastname" type="text" value="{{old('lastname')}}" required>
                @if ($errors->has('lastname'))
                <span class="form-text text-danger">{{ $errors->first('lastname') }}
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('birthdate')) ? ' has-danger' : '' }}">
            <label for="birthdate" class="col-4 col-form-label text-right">
                วันเกิด (ค.ศ.)<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('birthdate')) ? ' form-control-danger' : '' }}" 
                name="birthdate" type="date" value="{{old('birthdate')}}" required>
                <span class="form-text text-muted">ในรูปแบบ เดือน/วัน/ค.ศ.</span>
                @if ($errors->has('birthdate'))
                <span class="form-text text-danger">{{ $errors->first('birthdate') }}
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('citizen_id')) ? ' has-danger' : '' }}">
            <label for="citizen_id" class="col-4 col-form-label text-right">
                เลขประจำตัวประชาชน<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('citizen_id')) ? ' form-control-danger' : '' }}" 
                name="citizen_id" type="text" value="{{old('citizen_id')}}" required>
                <span class="form-text text-muted" style="font-size: 13px;">
                    ข้อมูลนี้จะเป็นความลับและถูกเข้ารหัสอย่างดี
                </span>
                @if ($errors->has('citizen_id'))
                <span class="form-text text-danger">{{ $errors->first('citizen_id') }}
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('student_id')) ? ' has-danger' : '' }}">
            <label for="student_id" class="col-4 col-form-label text-right">
                รหัสนักศึกษา
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('student_id')) ? ' form-control-danger' : '' }}" 
                name="student_id" value="{{old('student_id')}}" type="text">
                <span class="form-text text-muted" style="font-size: 13px;">
                    กรณีเป็นนักศึกษา
                </span>
                @if ($errors->has('student_id'))
                <span class="form-text text-danger">{{ $errors->first('student_id') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('tel')) ? ' has-danger' : '' }}">
            <label for="tel" class="col-4 col-form-label text-right">
                โทรศัพท์<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('tel')) ? ' form-control-danger' : '' }}" 
                name="tel" type="text" value="{{old('tel')}}" required>
                @if ($errors->has('tel'))
                <span class="form-text text-danger">{{ $errors->first('tel') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('tel_alt')) ? ' has-danger' : '' }}">
            <label for="tel_alt" class="col-4 col-form-label text-right">
                โทรศัพท์ฉุกเฉิน
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('tel_alt')) ? ' form-control-danger' : '' }}" 
                name="tel_alt" value="{{old('tel_alt')}}" type="text">
                @if ($errors->has('tel_alt'))
                <span class="form-text text-danger">{{ $errors->first('tel_alt') }}</span>
                @endif
            </div>
        </div>


        <div class="row" style="margin: 2rem 0">
            <div class="col-4 text-right"><h4>ข้อมูลการเข้าร่วมงาน</h4></div>
            <div class="col-6"></div>
        </div>

        <div class="form-group row{{ ($errors->has('user_type_id')) ? ' has-danger' : '' }}">
            <label for="user_type_id" class="col-4 col-form-label text-right">
                ประเภทผู้เข้าร่วมงาน<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <select class="form-control{{ ($errors->has('user_type_id')) ? ' form-control-danger' : '' }}" 
                name="user_type_id" required>
                    <option value="">เลือกประเภทผู้เข้าร่วมงาน</option>
                    <optgroup label="ผู้จัดการแข่งขัน">
                        <option value="2"{{old('user_type_id') == 2 ? ' selected' : ''}}>กรรมการอำนวยการ/กรรมการดำเนินงาน</option>
                        <option value="3"{{old('user_type_id') == 3 ? ' selected' : ''}}>อนุกรรมการ</option>
                        <option value="5"{{old('user_type_id') == 5 ? ' selected' : ''}}>เจ้าหน้าที่จัดการแข่งขัน</option>
                        <option value="9">อาสาสมัคร</option>
                    </optgroup>
                    <optgroup label="ผู้ร่วมงาน">
                        <option value="1"{{old('user_type_id') == 1 ? ' selected' : ''}}>กรรมการบริหารกีฬาวิทยาศาสตร์สัมพันธ์แห่งประเทศไทย</option>
                        <option value="4"{{old('user_type_id') == 4 ? 'selected' : ''}}>กรรมการผู้ตัดสิน</option>
                        <option value="6"{{old('user_type_id') == 6 ? ' selected' : ''}}>นักกีฬา/กิจกรรมสัมพันธ์</option>
                        <option value="7"{{old('user_type_id') == 7 ? ' selected' : ''}}>ผู้จัดการ/ผู้ฝึกสอน/ผู้ช่วยผู้ฝึกสอน</option>
                        <option value="8"{{old('user_type_id') == 8 ? ' selected' : ''}}>ช่างภาพ/สื่อมวลชน</option>
                        <option value="10"{{old('user_type_id') == 10 ? ' selected' : ''}}>ผู้เข้าร่วมงาน</option>
                        <option value="11"{{old('user_type_id') == 11 ? ' selected' : ''}}>ผู้ให้การสนับสนุน</option>
                        <option value="12"{{old('user_type_id') == 12 ? ' selected' : ''}}>อาจารย์/บุคลากร</option>
                    </optgroup>
                </select>
                @if ($errors->has('user_type_id'))
                <span class="form-text text-danger">{{ $errors->first('user_type_id') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('university_id')) ? ' has-danger' : '' }}">
            <label for="university_id" class="col-4 col-form-label text-right">
                สถาบันในสังกัด<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <select class="form-control{{ ($errors->has('university_id')) ? ' form-control-danger' : '' }}" 
                name="university_id" required>
                    <option value="">เลือกสถาบันในสังกัด</option>
                    @foreach($universities as $university)
                    <option value="{{$university->id}}"{{old('university_id') == $university->id ? ' selected' : ''}}>{{$university->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('university_id'))
                <span class="form-text text-danger">{{ $errors->first('university_id') }}</span>
                @endif
            </div>
        </div>
        
        <div class="collapse" id="departmentCollapse">
        <div class="form-group row{{ ($errors->has('department_id')) ? ' has-danger' : '' }}">
            <label for="department_id" class="col-4 col-form-label text-right">
                ฝ่าย<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <select class="form-control{{ ($errors->has('department_id')) ? ' form-control-danger' : '' }}" 
                name="department_id" required>
                    <option value="">เลือกฝ่าย</option>
                    @foreach($departments as $department)
                    <option value="{{$department->id}}"{{old('department_id') == $department->id ? ' selected' : ''}}>{{$department->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('department_id'))
                <span class="form-text text-danger">{{ $errors->first('university_id') }}</span>
                @endif
            </div>
        </div>
        </div>

        <div class="form-group row">
            <label for="alsoathlete" class="col-4 col-form-label text-right">
                ต้องการลงแข่งกีฬา
            </label>
            <div class="col-6">
                <div class="form-check form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="alsoathlete"{{old('alsoathlete') ? ' checked' : ''}}>
                    </label>
                </div>
            </div>
        </div>

        <div class="collapse" id="sportList">
        <div class="form-group row">
            <label for="sportList" class="col-4 col-form-label text-right">
                เลือกประเภทกีฬา
            </label>
            <div class="col-6">
                @foreach($sports->chunk(2) as $chunk)
                <div class="row">
                @foreach($chunk as $sport)
                <div class="form-check col-4">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="sportList[]"
                        value="{{$sport->id}}"
                        @if(old('sportList'))
                        {{in_array($sport->id, old('sportList')) ? ' checked' : ''}}
                        @endif>
                        {{$sport->name}}
                    </label>
                </div>
                @endforeach
                </div>
                @endforeach
            </div>
        </div>
        </div>

        <div class="form-group row{{ ($errors->has('pic')) ? ' has-danger' : '' }}">
            <label for="pic" class="col-4 col-form-label text-right">
                รูปติดบัตร<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control-file{{ ($errors->has('pic')) ? ' form-control-danger' : '' }}" 
                name="pic" type="file" required>
                <span class="form-text text-muted" style="font-size: 15px">
                    ขนาดไม่เกิน 5MB ควรมีขนาดเป็นสี่เหลี่ยมจัตุรัสและเห็นหน้าชัดเจน
                </span>
                @if ($errors->has('pic'))
                <span class="form-text text-danger">{{ $errors->first('pic') }}</span>
                @endif
            </div>
        </div>

        <div class="row" style="margin: 2rem 0">
            <div class="col-4 text-right"><h4>ข้อมูลการเข้าใช้ระบบ</h4></div>
            <div class="col-6"></div>
        </div>

        <div class="form-group row{{ ($errors->has('email')) ? ' has-danger' : '' }}">
            <label for="email" class="col-4 col-form-label text-right">
                E-mail<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('email')) ? ' form-control-danger' : '' }}" 
                name="email" type="email" value="{{old('email')}}" required>
                @if ($errors->has('email'))
                <span class="form-text text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('username')) ? ' has-danger' : '' }}">
            <label for="username" class="col-4 col-form-label text-right">
                Username<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('username')) ? ' form-control-danger' : '' }}" 
                name="username" type="text" value="{{old('email')}}" required>
                @if ($errors->has('username'))
                <span class="form-text text-danger">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('password')) ? ' has-danger' : '' }}">
            <label for="password" class="col-4 col-form-label text-right">
                Password<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('password')) ? ' form-control-danger' : '' }}" 
                name="password" type="password" minlength="6" maxlength="20" required>
                @if ($errors->has('password'))
                <span class="form-text text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row{{ ($errors->has('password_confirmation')) ? ' has-danger' : '' }}">
            <label for="password_confirmation" class="col-4 col-form-label text-right">
                Password (อีกครัง)<span style="color: red">*</span>
            </label>
            <div class="col-4">
                <input class="form-control{{ ($errors->has('password_confirmation')) ? ' form-control-danger' : '' }}" 
                name="password_confirmation" type="password" minlength="6" maxlength="20" required>
                @if ($errors->has('password_confirmation'))
                <span class="form-text text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4"></div>
            <div class="col-4">
                {{csrf_field()}}
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> ลงทะเบียนเข้าร่วมงาน
                </button>
                <a href="/" class="text-muted">ยกเลิก</a>
            </div>
        </div>

    </form>
    </div>

</div>
@endsection

@section('js')
<script>
function syncValue(value, id) {
    $('#' + id).val(value);
}

// jQuery plugin to prevent double submission of forms
jQuery.fn.preventDoubleSubmission = function() {
    $(this).on('submit',function(e) {
        var $form = $(this);

        $('select[name="university_id"]').prop('disabled', false);
        $('input[name="alsoathlete"]').prop('disabled', false);

        if ($form.data('submitted') === true) {
            e.preventDefault();
        } else {
            $form.data('submitted', true);
        }
    });
  return this;
};

$('form').preventDoubleSubmission();

$('select[name="user_type_id"]').change(function() {
    if ($(this).val() == '2' || $(this).val() == '3' || $(this).val() == '5') {
        $('select[name="university_id"]').val('22');
        $('select[name="university_id"]').attr('value', '22');
        
        $('select[name="university_id"]').prop('disabled', true);
        $('#departmentCollapse').collapse('show');
    } else {
        $('select[name="university_id"]').prop('disabled', false);
        $('#departmentCollapse').collapse('hide');
    }

    if ($(this).val() == '6') {
        $('input[name="alsoathlete"]').prop({'checked': true,'disabled': true});
        $('#sportList').collapse('show');
    } else {
        $('input[name="alsoathlete"]').prop({'disabled': false});
    }

    if ($(this).val() == '9') {
        $('select[name="university_id"]').val('22');
        $('select[name="university_id"]').attr('value', '22');
        
        $('select[name="university_id"]').prop('disabled', true);
    }
});

$('input[name="alsoathlete"]').change(function() {
    if ($('input[name="alsoathlete"]').is(':checked')) {
        $('#sportList').collapse('show');
    } else {
        $('#sportList').collapse('hide');
    }
});

$(document).ready(function () {
    $('input').trigger('change');
    $('select').trigger('change');
});
</script>
@endsection