@extends('layout.main')

@section('css')
@endsection

@section('title', 'ลงทะเบียนผู้เข้าร่วมงาน')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div class="text-center w-100">
            <span>ลงทะเบียนเข้าร่วมงานสำเร็จ</span>
        </div>
    </div>

    <div class="container" style="margin-top: 1rem">
        <div class="text-center">
            กรุณารอให้ผู้ดูแลข้อมูลประจำสถาบันของท่านยืนยันข้อมูลก่อนเข้าสู่ระบบ
        </div>
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