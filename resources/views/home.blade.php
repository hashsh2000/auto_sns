@extends('layouts.app')

@section('content')


<div class="container">
    <ul class="list-group">
        <li class="list-group-item">
            <h3>ダッシュボード</h3>
            <p>ここにダッシュボードの内容を表示します。</p>
        </li>
    </ul>
    <ul class="list-group mt-3">
        <li class="list-group-item">
            <h3>メニュー</h3>
        </li>
        <a href="#" class="text-decoration-none text-dark">
            <li class="list-group-item">項目1</li>
        </a>
        <a href="#" class="text-decoration-none text-dark">
            <li class="list-group-item">項目2</li>
        </a>
        <a href="#" class="text-decoration-none text-dark">
            <li class="list-group-item">項目3</li>
        </a>
        <a href="#" class="text-decoration-none text-dark">
            <li class="list-group-item">項目4</li>
        </a>
        <a href="#" class="text-decoration-none text-dark">
            <li class="list-group-item">項目5</li>
        </a>
        <a href="#" class="text-decoration-none text-dark">
            <li class="list-group-item">項目6</li>
        </a>
    </ul>
</div>
@endsection
