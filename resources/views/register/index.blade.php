@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約一覧</div>

                <div class="panel-body">
                    <detail-component></detail-component>
                    <div>{{ Html::Link('/management/create', '追加', ['class' => 'btn']) }}</div>
                </div>
                @can('manager')
                <div>{{ Html::link('/management/schedule', 'スケジュール', ['class' => 'btn']) }}</div>
                <div>{{ Html::link('/management/total', '集計', ['class' => 'btn']) }}</div>
                <div>{{ Html::link('/room', '部屋一覧へ', ['class' => 'btn']) }}</div>
                <div>{{ Html::link('/management/checkout', '本日のチェックアウト', ['class' => 'btn']) }}</div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
