@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約一覧</div>

                <div class="panel-body">
                    <table>
                        <tr>
                            <th>名前</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>人数</th>
                            <th>宿泊日</th>
                            <th>宿泊日数</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                    @foreach ($registerLists as $list)
                        <tr>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->address }}</td>
                            <td>{{ $list->phone }}</td>
                            <td>{{ $list->num }}</td>
                            <td>{{ $list->days }}</td>
                            <td>{{ $list->start_day }}</td>
                            <td>{{ Html::link('/management/'.$list->id.'/edit', '編集') }}</td>
                            <td>{{ Html::link('/management/'.$list->id.'/conform', '削除') }}</td>
                        </tr>
                    @endforeach
                    </table>
                    {{ Html::Link('/management/create', '追加') }}
                </div>
                <div>{{ Html::link('/management/schedule', 'スケジュール') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
