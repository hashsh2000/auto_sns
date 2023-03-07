@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('フォーム') }}</div>
        <div class="card-body">
          @if ($action == 'edit')
          <form method="POST" action="{{ route('keyword.form.edit', ['dm_id' => @$keyword_data['id']]) }}">
          @else
          <form method="POST" action="{{ route('keyword.form.create') }}">
          @endif
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">{{ __('キーワード名') }}</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ @$keyword_data['title'] }}" required autofocus>
              @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="keyword" class="form-label">{{ __('検索キーワード') }}</label>
              <textarea class="form-control @error('keyword') is-invalid @enderror" id="keyword" name="keyword" style="height: 200px;"; required>{{ @$keyword_data['keyword'] }}</textarea>
              @error('keyword')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary" name="save" value="1">{{ __('保存') }}</button>
            @if ($action == 'edit' && @$keyword_data['active_flg'] != 1)
            <button type="submit" class="btn btn-danger" name="delete" value="1" onclick="return confirm('この設定を削除しますか？')">{{ __('削除') }}</button>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
