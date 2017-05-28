@extends('layout.main')

@section('title', 'ผลการแข่งขันกรีฑา')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div class="w-100 text-center">ผลการแข่งขัน<span style="color: #FFA02F">กรีฑา</span></div>
    </div>

    {{Date::setLocale('th')}}

    @foreach($events as $date => $events)
    <h5 class="mt-5">{{Date::parse($date)->format('j F Y')}}</h5>
    <hr>
    
    
    <div id="date{{$date}}" role="tablist" aria-multiselectable="true">

        @foreach($events as $event)
        <div class="card">
            <div class="card-header" role="tab" id="heading{{$event->id}}">
                <a href="#collapse{{$event->id}}" data-toggle="collapse"
                data-parent="date{{$date}}" aria-controls="collapse{{$event->id}}">
                    ({{Date::parse($event->date)->format('H:i')}}) {{$event->name}}
                </a>
            </div>

            <div id="collapse{{$event->id}}" class="collapse p-4" role="tabpanel"
            aria-labelledby="heading{{$event->id}}">
                <table class="table table-stripped">
                    <thead>
                        <th>ลำดับที่</th>
                        <th>{{$event->results[0]->athlete ? 'ชื่อนักกีฬา' : 'ชื่อสถาบัน'}}</th>
                        <th>เวลา</th>
                    </thead>
                    <tbody>
                        @foreach($event->results as $result)
                        <tr>
                        <td>{{$result->order}}</td>
                        <td>
                            <img src="/img/logo-uni/logo{{$result->university->code}}.png">
                            {{$result->athlete ? "({$result->university->code}) " . $result->athlete->fullname() 
                            : $result->university->name}}
                        </td>
                        <td>
                            {{$result->time}}
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
         @endforeach

    </div>
    @endforeach

</div>
@endsection