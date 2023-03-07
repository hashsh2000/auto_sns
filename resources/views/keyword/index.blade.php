@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-2">
            <h5></h5>
        </div>
        <div class="col-8 text-center">
            <h5>検索ワード一覧</h5><br>
            <span>{{ @$message }}</span>
        </div>
        <div class="col-2 text-right">
            <a href="{{ route('keyword.create') }}" class="btn btn-primary">+</a>
        </div>
        </div>
        <div class="row mt-3">
        <div class="col-12">
            <div class="card-deck">
                @foreach ($keyword_list as $keyword)
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{$keyword->title}}</h5>
                    <p class="card-text">
                        {{ Str::limit($keyword->keyword, 80, '...') }}
                    </p>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-primary">
                        @if ($keyword->active_flg == 1)
                        現在有効化されています。
                        @endif
                        </small>
                        <a href="{{ route('keyword.edit', $keyword->id) }}" class="btn btn-primary pull-left">編集</a>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
