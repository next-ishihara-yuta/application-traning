@extends('layouts.top')

@section('title', 'リクエスト基礎')

@section('content')
    <div>
        <h2 class="title_002">社員コードとパスワードを入力してください。</h2>
        <form method="POST" action="/practice_05">
            {{ csrf_field() }}
            <div class="textBox">
                <label>社員コード</label>
                <input type="text" name="employeeCode" placeholder="employee code">
                @error('employeeCode')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="textBox">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="password">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <p>
                <input type="submit" value="ログイン">
            </p>
        </form>
    </div>
@endsection