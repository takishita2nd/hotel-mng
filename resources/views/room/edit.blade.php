@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約登録</div>

                <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['url' => action('RoomController@update')]) !!}
                {!! Form::hidden('id', $item->id) !!}
                <table class="edit">
                    <tr>
                        <th>名前</th>
                        <td>{!! Form::text('name', $item->name) !!}</td>
                    </tr>
                    <tr>
                        <th>値段</th>
                        <td>{!! Form::text('price', $item->price) !!}</td>
                    </tr>
                </table>
                {!! Form::submit('登録') !!}
                {!! Form::close() !!}
                </div>
                <div>{{ Html::link('/room', '戻る', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
