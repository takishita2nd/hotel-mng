@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">月毎の集計</div>

                <div class="panel-body">
                    <table class="total">
                        <tr>
                            <th class="yearmonth">年月</th>
                            <th class="couont">件数</th>
                            <th class="total">売上</th>
                        </tr>
                    @foreach ($Lists as $list)
                        <tr>
                            <td class="yearmonth">{{ $list->yearmonth }}</td>
                            <td class="couont">{{ $list->count }}</td>
                            <td class="total">{{ $list->total }}</td>

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
