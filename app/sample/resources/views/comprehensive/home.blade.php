@extends('layouts.app')

@section('title', '総合課題')

@section('content')

    @if (@session('errors'))
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (@$responseData['message'])
        <p class="success">{{ $responseData['message'] }}</p>
    @endif
    @if (@$responseData['errorMessage'])
        <p class="error">{{ $responseData['errorMessage'] }}</p>
    @endif
    <div class="content">
        <h2 class="title_002">
            勤怠登録
        </h2>
        <form method="POST" action="/comprehensive/work">
            {{ csrf_field() }}
            <div class="textBox">
                <label>出社時刻</label>
                <input type="datetime-local" name="startTime" placeholder="出社時刻" step="900">
                @if (@$validations['startTime'])
                    @foreach ($validations['startTime'] as $validation)
                        <p class="error">{{ $validation }}</p>
                    @endforeach
                @endif
                <label>退社時刻</label>
                <input type="datetime-local" name="endTime" placeholder="退社時刻" step="900">
                @if (@$validations['endTime'])
                    @foreach ($validations['endTime'] as $validation)
                        <p class="error">{{ $validation }}</p>
                    @endforeach
                @endif
            </div>
            <div class="sentenseBox">
                <label>作業内容</label>
                <input type="text" name="details">
                @if (@$validations['details'])
                    @foreach ($validations['details'] as $validation)
                        <p class="error">{{ $validation }}</p>
                    @endforeach
                @endif
            </div>
            <p>
                <input type="hidden" name="employeeCode" value={{ $responseData['employeeCode'] }}>
                <input type="submit" value="登録">
            </p>
        </form>
    </div>
    <div class="content">
        <h2 class="title_002">
            勤務情報
        </h2>
        <div>
            <form method="GET" action="/comprehensive/work/get">
                {{ csrf_field() }}
                <div class="textBox">
                    <label></label>
                    @if (empty($responseData['workInfo']) === false)
                    <input type="month" name="month">
                    @else
                        <input type="month" name="month">
                    @endif

                    @if (@$validations['month'])
                        @foreach ($validations['month'] as $validation)
                            <p class="error">{{ $validation }}</p>
                        @endforeach
                    @endif
                </div>
                <p>
                    <input type="hidden" name="employeeCode" value={{ $responseData['employeeCode'] }}>
                    <input type="submit" value="検索">

                </p>
            </form>
            <table class="table_1">
                <tr>
                    <th>勤務日</th>
                    <th>開始時間</th>
                    <th>終了時間</th>
                    <th>作業内容</th>
                </tr>
                @if (empty($responseData['workInfo']) === false)
                    @foreach ($responseData['workInfo'] as $info)
                        <tr>
                            <td>{{ $info['day'] }}</td>
                            <td>{{ $info['start_time'] }}</td>
                            <td>{{ $info['end_time'] }}</td>
                            <td>{{ $info['details'] }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
            @if (empty($responseData['workInfo']) === false)
            {{ $responseData['workInfo']->links() }}
            @else
            <p class="error">該当する勤怠情報が存在しません</p>
            @endif
        </div>
    </div>
@endsection