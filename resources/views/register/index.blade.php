@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">予約一覧</div>

                <div class="panel-body">
                    <table>
                    @foreach ($registerLists as $list)
                        <tr>
                            <td>これは {{ $list->name }} ユーザーです。</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
