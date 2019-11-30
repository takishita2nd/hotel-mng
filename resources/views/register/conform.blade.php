@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">削除確認</div>

                <div class="panel-body">
                {!! Form::open(['url' => action('RegisterManagementController@delete')]) !!}
                {!! Form::hidden('id', $item->id) !!}
                <table class="edit">
                    <tr>
                        <th>名前</th>
                        <td>{!! $item->name !!}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{!! $item->address !!}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{!! $item->phone !!}</td>
                    </tr>
                    <tr>
                        <th>人数</th>
                        <td>{!! $item->num !!}</td>
                    </tr>
                    <tr>
                        <th>宿泊日数</th>
                        <td>{!! $item->days !!}</td>
                    </tr>
                    <tr>
                        <th>宿泊日</th>
                        <td>{!! $item->start_day !!}</td>
                    </tr>
                </table>
                {!! Form::submit('削除') !!}
                {!! Form::close() !!}
                </div>
                <div>{{ Html::link('/management', '戻る', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
