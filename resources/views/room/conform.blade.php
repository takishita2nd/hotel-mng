@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">削除確認</div>

                <div class="panel-body">
                {!! Form::open(['url' => action('RoomController@delete')]) !!}
                {!! Form::hidden('id', $item->id) !!}
                <table class="edit">
                    <tr>
                        <th>名前</th>
                        <td>{!! $item->name !!}</td>
                    </tr>
                    <tr>
                        <th>価格</th>
                        <td>{!! $item->price !!}</td>
                    </tr>
                </table>
                {!! Form::submit('削除') !!}
                {!! Form::close() !!}
                </div>
                <div>{{ Html::link('/room', '戻る', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
