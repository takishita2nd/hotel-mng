@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約登録</div>

                <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['url' => action('RegisterManagementController@store')]) !!}
                <table class="edit">
                    <tr>
                        <th>名前</th>
                        <td>{!! Form::text('name') !!}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{!! Form::text('address') !!}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{!! Form::text('phone') !!}</td>
                    </tr>
                    <tr>
                        <th>人数</th>
                        <td>{!! Form::select('num', ['1' => 1, '2' => 2]) !!}</td>
                    </tr>
                    <tr>
                        <th>宿泊部屋</th>
                        <td>{!! Form::select('room', $rooms) !!}</td>
                    </tr>
                    <tr>
                        <th>宿泊日数</th>
                        <td>{!! Form::number('days', 1) !!}</td>
                    </tr>
                    <tr>
                        <th>宿泊日</th>
                        <td>{!! Form::date('start_day', \Carbon\Carbon::now()) !!}</td>
                    </tr>
                </table>
                {!! Form::submit('登録') !!}
                {!! Form::close() !!}
                </div>
                <div>{{ Html::link('/management', '戻る', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
