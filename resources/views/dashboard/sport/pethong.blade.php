@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">เพิ่มกีฬาเปตอง <small><a href="{{route('event.index.dashboard')}}">กลับ</a></small></h4>
    <div class="card-block">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa fa-check"></i> {{session('status')}}
        </div>
        @endif
        <form action="{{route('event.store')}}" method="POST" >

            {{--name--}}
            <div class="form-group">
                <label for="name">ชื่อการแข่งขัน</label>
                <input name="name" type="text" value="{{old('name')}}" class="form-control" style="width: 50%;">
                <small class="form-text text-muted">เช่น "เปตองชายเดี่ยวสาย A รอบแรก"</small>
            </div>

            <div class="form-group" style="width: 50%;">
                <label for="date">วันเวลาการแข่งขัน</label>
                <div class='input-group date' id='date'>
                    <input type='text' name="date" value="{{old('date')}}" class="form-control"/>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>

            <div class="form-group" style="width: 50%;">
                <label for="venue">สถานที่แข่งขัน</label>
                <input name="venue" type="text" value="สนามเปตอง ม.อุบลฯ" class="form-control" readonly>
            </div>

            <input type="hidden" name="sport_id" value="5">
            <input type="hidden" name="label" value="pethong">

            {{--type--}}
            <fieldset class="form-group">
                <legend>ประเภทการแข่งขัน</legend>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input"
                               name="optionType" value="single" checked>
                        เดี่ยว
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input"
                               name="optionType" value="team">
                        ทีม
                    </label>
                </div>
            </fieldset>

            <table class="table w-100">
                <thead>
                    <th>ชื่อทีม/ผู้เข้าแข่งขัน</th>
                    <th>คะแนนรวม</th>
                    <th>ชนะ ?</th>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <label class="d-block">สถาบัน</label>
                        <select name="university_id[1]" class="form-control">
                            @foreach($universities as $university)
                            <option value="{{$university->id}}">({{$university->code}}) {{$university->name}}</option>
                            @endforeach
                        </select>

                        <div class="athletic-container">
                            <label class="mt-2 d-block">ชื่อผู้เข้าแข่งขัน</label>
                            <select name="athlete_id[1]" class="form-control d-inline-block">
                            </select>
                            <i class="fa fa-spinner fa-pulse fa-fw loading-icon"></i>
                        </div>
                    </td>
                    <td>
                        <input name="score[1]" type="text" class="form-control" style="width: 100px">
                    </td>
                    <td>
                        <input type="radio" name="is_winner" value="1">
                    </td>
                    </tr>

                    <tr>
                    <td>
                        <label class="d-block">สถาบัน</label>
                        <select name="university_id[2]" class="form-control">
                            @foreach($universities as $university)
                            <option value="{{$university->id}}">({{$university->code}}) {{$university->name}}</option>
                            @endforeach
                        </select>

                        <div class="athletic-container">
                            <label class="mt-2 d-block">ชื่อผู้เข้าแข่งขัน</label>
                            <select name="athlete_id[2]" class="form-control d-inline-block">
                            </select>
                            <i class="fa fa-spinner fa-pulse fa-fw loading-icon"></i>
                        </div>
                    </td>
                    <td>
                        <input name="score[2]" type="text" class="form-control" style="width: 100px">
                    </td>
                    <td>
                        <input type="radio" name="is_winner" value="2">
                    </td>
                    </tr>
                </tbody>
            </table>
            
            {{csrf_field()}}

            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> เพิ่มผลการแข่งขัน
            </button>

        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$('input[name="optionType"]').on('change', function () {
    if ($(this).val() === 'team') {
        $('.athletic-container').hide().find('select').attr('disabled', true);
    } else {
        $('.athletic-container').show().find('select').attr('disabled', false);
        $('select[name^="university_id"]').trigger('change');
    }
});

$('select[name^="athlete_id"]').select2({
    width: '100%'
});

$('select[name^="university_id"]').select2({
    width: '100%'
}).on('change', function () {
    if ($('input[name="optionType"]:checked').val() !== 'team') {
        fetchAthletes($(this).val(), $(this));
    }
}).trigger("change");

$('#date').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
    },
    format: 'DD/MM/YYYY HH:mm'
});

function fetchAthletes(value, selector) {
    let athlete_select = selector.parent().find('.athletic-container select');
    let loading_icon = selector.parent().find('.athletic-container i');

    loading_icon.show();

    axios.get('/api/athlete', {
        params: {
            uni_id: value,
            sport_id: $('input[name="sport_id"]').val()
        }
    })
    .then(function (response) {
        let options = [];

        response.data.forEach(function (user) {
            let option = new Option(user.name, user.id);
            options.push(option);
        });

        loading_icon.hide();
        athlete_select.find('option').remove();

        if (options.length !== 0) {
            athlete_select.append(options).val(options[0].value).trigger("change");
        } else {
            athlete_select.append(options).val("").trigger("change");
        }
    });
}
</script>
<style>
    .select2-container .select2-selection--single {
        height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px;
    }
</style>
@endsection