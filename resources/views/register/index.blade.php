@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約一覧</div>

                <div class="panel-body">
                    {!! Form::open(['url' => action('RegisterManagementController@indexToMonthly')]) !!}
                    <table>
                        <tr>
                            <td>{!! Form::selectYear('year', 2019, 2020) !!}年</td>
                            <td>{!! Form::selectMonth('month') !!}</td>
                            <td>{!! Form::submit('表示') !!}</td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                    <table class="management">
                        <tr>
                            <th class="name">名前</th>
                            <th class="address">住所</th>
                            <th class="phone">電話番号</th>
                            <th class="num">人数</th>
                            <th class="date">宿泊日</th>
                            <th class="num">宿泊日数</th>
                            <th class="command">編集</th>
                            <th class="command">削除</th>
                            <th class="command">宿泊</th>
                        </tr>
                    @foreach ($registerLists as $list)
                        <tr>
                            <td class="name">{{ $list->name }}</td>
                            <td class="address">{{ $list->address }}</td>
                            <td class="phone">{{ $list->phone }}</td>
                            <td class="num">{{ $list->num }}</td>
                            <td class="date">{{ $list->start_day }}</td>
                            <td class="num">{{ $list->days }}</td>
                            <td class="command">{{ Html::link('/management/'.$list->id.'/edit', '編集') }}</td>
                            <td class="command">{{ Html::link('/management/'.$list->id.'/conform', '削除') }}</td>
                            <td class="command">
                            {!! Form::open(['url' => action('RegisterManagementController@lodging')]) !!}
                            {!! Form::hidden('id', $list->id) !!}
                            {!! Form::submit('宿泊') !!}
                            {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </table>
                    {{ Html::Link('/management/create', '追加', ['class' => 'btn']) }}
                </div>
                <div>{{ Html::link('/management/schedule', 'スケジュール', ['class' => 'btn']) }}</div>
                <div>{{ Html::link('/management/total', '集計', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
