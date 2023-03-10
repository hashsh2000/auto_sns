@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-2">
            <h5></h5>
        </div>
        <div class="col-8 text-center">
            <h5>DMテンプレート一覧</h5><br>
            <span>{{ @$message }}</span>
        </div>
        <div class="col-2 text-right">
            <a href="{{ route('dm.create') }}" class="btn btn-primary">+</a>
        </div>
        </div>
        <div class="row mt-3">
        <div class="col-12">
            <div class="card-deck">
                @foreach ($dm_list as $dm)
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{$dm->title}}</h5>
                    <p class="card-text">
                        {{ Str::limit($dm->content, 80, '...') }}
                    </p>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-secondary">
                        @if ($dm->active_flg == 1)
                        <span class="text-primary">現在有効化されています。</span><br>
                        @endif
                        検索キーワード:{{ $dm->keyword_name }}
                        @if ($dm->keyword_deleted != 0)(削除済み)@endif
                        </small>
                        <a href="{{ route('dm.edit', $dm->id) }}" class="btn btn-primary pull-left">編集</a>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
