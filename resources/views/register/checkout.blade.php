@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">本日のチェックアウト時刻</div>

                <div class="panel-body">
                    <table class="checkout">
                        <tr>
                            <th class="name">部屋</th>
                            <th class="time">チェックアウト時刻</th>
                        </tr>
                    @foreach ($Lists as $list)
                        <tr>
                            <td class="name">{{ $list->roomname }}</td>
                            <td class="time">{{ $list->checkout }}</td>
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
