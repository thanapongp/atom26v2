@extends('layout.main')

@section('title', 'ผลการแข่งขันวิชาการ')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div class="w-100 text-center">ผลการแข่งขัน<span style="color: #FFA02F">วิชาการ</span></div>
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
                    </a>
                </div>

                <div id="collapse{{$event->id}}" class="collapse p-4" role="tabpanel"
                aria-labelledby="heading{{$event->id}}">
                    <table class="table table-stripped">
                        <thead>
                            <th>ลำดับที่</th>
                            <th>{{$event->results[0]->athlete ? 'ชื่อนักกีฬา' : 'ชื่อสถาบัน'}}</th>
                        </thead>
                        <tbody>
                            @foreach($event->results as $result)
                            <tr{{$loop->first ? ' class=table-warning' : ''}}>
                            <td>
                                @if($loop->iteration == 1)
                                <i class="fa fa-trophy" style="color: #C98910"></i>
                                @elseif($loop->iteration == 2)
                                <i class="fa fa-trophy" style="color: #A8A8A8"></i>
                                @elseif($loop->iteration == 3)
                                <i class="fa fa-trophy" style="color: #965A38"></i>
                                @endif
                                
                                {{$result->order}}
                            </td>
                            <td>
                                <img src="/img/logo-uni/logo{{$result->university->code}}.png">
                                {{$result->athlete ? "({$result->university->code}) " . $result->athlete->fullname() 
                                : $result->university->name}}
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