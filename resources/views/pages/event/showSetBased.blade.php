@extends('layout.main')

@section('title', "ผลการแข่งขัน{$sport->name}")

@section('content')
<div class="content-container">
    <div class="section-header">
        <div class="w-100 text-center">ผลการแข่งขัน<span style="color: #FFA02F">{{$sport->name}}</span></div>
    </div>

    @if($events->isEmpty())
    <h4 class="text-center mt-5">ยังไม่มีผลการแข่งขันสำหรับกีฬาชนิดนี้</h4>
    @endif

    {{Date::setLocale('th')}}

    <ul class="nav nav-pills nav-fill mt-3" role="tablist">
        @foreach($events as $day => $_)
        <li class="nav-item">
            <a class="nav-link{{$loop->first ? ' active' : ''}}" 
            data-toggle="tab" href="#day{{$day}}" role="tab">
            {{Date::parse($day)->format('j F Y')}}</a>
        </li>
        @endforeach
    </ul>
    
    <div class="tab-content mt-5">
    @foreach($events as $date => $events)
    <div class="tab-pane{{$loop->first ? ' active' : ''}}" id="day{{$date}}"
    role="tabpanel">

        <div id="date{{$date}}" role="tablist" aria-multiselectable="true">

            @foreach($events as $event)
            <div class="card mt-3">
                <div class="card-header" role="tab" id="heading{{$event->id}}">
                    <a href="#collapse{{$event->id}}" data-toggle="collapse"
                    data-parent="#date{{$date}}" aria-controls="collapse{{$event->id}}">
                        ({{Date::parse($event->date)->format('H:i')}}) {{$event->name}} 
                        ({{$event->results[0]->university->code}} vs. {{$event->results[1]->university->code}})
                    </a>
                </div>

                <div id="collapse{{$event->id}}" class="collapse p-4" role="tabpanel"
                aria-labelledby="heading{{$event->id}}">
                    <table class="table table-stripped">
                        <thead>
                            <th>{{$event->results[0]->athlete ? 'ชื่อนักกีฬา' : 'ชื่อสถาบัน'}}</th>
                            <th>คะแนนรวม</th>
                        </thead>
                        <tbody>
                            @foreach($event->results as $result)
                            <tr class="{{$result->is_winner ? 'table-warning' : ''}}">
                            <td>
                                <img src="/img/logo-uni/logo{{$result->university->code}}.png">
                                {{$result->athlete ? "({$result->university->code}) " . $result->athlete->fullname() 
                                : $result->university->name}}
                            </td>
                            <td>
                                @if(is_null($result->score) && $result->is_winner)
                                ชนะ
                                @elseif(is_null($result->score) && ! $result->is_winner)
                                แพ้
                                @elseif($result->score == 'W')
                                สละสิทธิ์
                                @else
                                {{$result->score}}
                                @endif                        
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
             @endforeach

        </div>
        
    </div>
    @endforeach
    </div>

</div>
@endsection