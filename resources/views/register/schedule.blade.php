@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">スケジュール</div>

                <div class="panel-body">
                    {!! Form::open(['url' => action('RegisterManagementController@scheduleToMonthly')]) !!}
                    <table>
                        <tr>
                            <td>{!! Form::selectYear('year', 2019, 2020) !!}年</td>
                            <td>{!! Form::selectMonth('month') !!}</td>
                            <td>{!! Form::submit('表示') !!}</td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                    <table class="schedule">
                        <tr>
                            <th class="date">日時</th>
                            <th class="name">名前</th>
                            <th class="lodging">宿泊状況</th>
                        </tr>
                    @foreach ($Lists as $list)
                        <tr>
                            <td class="date">{{ $list['day'] }}</td>
                            <td class="name">{{ $list['name'] }}</td>
                            @if ($list['lodging'])
                                <td class="lodging">チェック</td>
                            @else
                                <td class="lodging">未チェック</td>
                            @endif
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div>{{ Html::link('/management', '戻る', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
