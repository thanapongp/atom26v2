@extends('layout.main')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('title', 'หน้าแรก')

@section('content')
<div class="content-container">
    <div class="row">
        <div class="col-4 select-row">
            <select name="university_id" class="d-block">
                @foreach($universities as $university)
                <option value="{{$university->id}}">{{$university->name}}</option>
                @endforeach
            </select>
            <select name="athlete_id" class="d-block athlete_select" style="margin-top: 2rem">
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-4 select-row">
            <select name="university_id" class="d-block">
                @foreach($universities as $university)
                <option value="{{$university->id}}">{{$university->name}}</option>
                @endforeach
            </select>
            <select name="athlete_id" class="d-block athlete_select">
            </select>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$('select[name^="university_id"]').select2({
    placeholder: 'สถาบัน'
});

$('select[name^="athlete_id"]').select2({
    width: '100%',
    margin: '1rem 0'
});

$('select[name^="university_id"]').on('change', function () {
    var athlete_select = $(this).siblings('select');

    athlete_select.find('option').remove();

    axios.get('/api/athlete', {
        params: {
            uni_id: $(this).val()
        }
    })
    .then(function (response) {
        var options = [];

        response.data.forEach(function (user) {
            var option = new Option(user.name, user.id);
            options.push(option);
        });

        athlete_select.append(options).val("").trigger("change");
    });
});
</script>
<style>

.select-row span.select2-container:not(:first-of-type) {
    margin-top: 1rem;
}

</style>
@endsection