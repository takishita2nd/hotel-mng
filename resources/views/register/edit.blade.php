@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約登録</div>

                <div class="panel-body">
                {!! Form::open(['url' => action('RegisterManagementController@update')]) !!}
                {!! Form::hidden('id', $item->id) !!}
                <table>
                    <tr>
                        <td>名前</td>
                        <td>{!! Form::text('name', $item->name) !!}</td>
                    </tr>
                    <tr>
                        <td>住所</td>
                        <td>{!! Form::text('address', $item->address) !!}</td>
                    </tr>
                    <tr>
                        <td>電話番号</td>
                        <td>{!! Form::number('phone', $item->phone) !!}</td>
                    </tr>
                    <tr>
                        <td>人数</td>
                        <td>{!! Form::select('num', ['1' => 1, '2' => 2], $item->num) !!}</td>
                    </tr>
                    <tr>
                        <td>宿泊日数</td>
                        <td>{!! Form::select('days', ['1' => 1, '2' => 2, '3' => 3, '4' => 4], $item->days) !!}</td>
                    </tr>
                    <tr>
                        <td>宿泊日</td>
                        <td>{!! Form::date('start_day', $item->start_day) !!}</td>
                    </tr>
                </table>
                {!! Form::submit('登録') !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
