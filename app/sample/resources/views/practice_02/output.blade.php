@extends('layouts.app')

@section('title', 'blade基礎')

@section('content')
<div class="content">
    <p>入力された文字は</p>
    <p>
        「{{$text}}」
    </p>
    <p>です。</p>
</div>
@endsection
