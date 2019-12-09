@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">部屋一覧</div>

                <div class="panel-body">
                    <table class="room">
                        <tr>
                            <th class="name">名前</th>
                            <th class="price">住所</th>
                            <th class="command">編集</th>
                            <th class="command">削除</th>
                        </tr>
                    @foreach ($roomLists as $list)
                        <tr>
                            <td class="name">{{ $list->name }}</td>
                            <td class="price">{{ $list->price }}</td>
                            <td class="command">{{ Html::link('/room/'.$list->id.'/edit', '編集') }}</td>
                            <td class="command">{{ Html::link('/room/'.$list->id.'/conform', '削除') }}</td>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                    {{ Html::Link('/room/create', '追加', ['class' => 'btn']) }}
                </div>
                <div>{{ Html::link('/management', '予約一覧へ', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
