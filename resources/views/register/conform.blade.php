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
                <table>
                    <tr>
                        <td>名前</td>
                        <td>{!! $item->name !!}</td>
                    </tr>
                    <tr>
                        <td>住所</td>
                        <td>{!! $item->address !!}</td>
                    </tr>
                    <tr>
                        <td>電話番号</td>
                        <td>{!! $item->phone !!}</td>
                    </tr>
                    <tr>
                        <td>人数</td>
                        <td>{!! $item->num !!}</td>
                    </tr>
                    <tr>
                        <td>宿泊日数</td>
                        <td>{!! $item->days !!}</td>
                    </tr>
                    <tr>
                        <td>宿泊日</td>
                        <td>{!! $item->start_day !!}</td>
                    </tr>
                </table>
                {!! Form::submit('削除') !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
