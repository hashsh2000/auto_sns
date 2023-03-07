@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('フォーム') }}</div>
        <div class="card-body">
          @if ($action == 'edit')
          <form method="POST" action="{{ route('dm.form.edit', ['dm_id' => @$dm_data['id']]) }}">
          @else
          <form method="POST" action="{{ route('dm.form.create') }}">
          @endif
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">{{ __('タイトル') }}</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ @$dm_data['title'] }}" required autofocus>
              @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="keyword" class="form-label">{{ __('キーワード') }}</label>
              <select class="form-select @error('keyword') is-invalid @enderror" id="keyword" name="keyword" required>
                @if ($action == 'create')
                <option value="" selected disabled hidden>{{ __('選択してください') }}</option>
                @endif
                @foreach ($keyword_list as $keyword)
                  <option value="{{ $keyword->id }}" @if (@$dm_data['keyword_id'] == $keyword->id) selected @endif>
                    {{ $keyword->title }}
                  </option>
                @endforeach
              </select>
              @error('keyword')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">{{ __('本文') }}</label>
              <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" style="height: 300px;"; required>{{ @$dm_data['content'] }}</textarea>
              @error('content')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <input type="hidden" id="active_flg" name="active_flg" value="{{ @$dm_data['active_flg'] }}">
            <button type="submit" class="btn btn-primary" name="save" value="1">{{ __('保存') }}</button>
            @if ( @$dm_data['active_flg'] != 1)
            <button type="submit" class="btn btn-info" name="active" value="1" onclick="return confirm('この設定を有効化しますか？')">{{ __('有効化') }}</button>
            @if ($action == 'edit')
            <button type="submit" class="btn btn-danger" name="delete" value="1" onclick="return confirm('この設定を削除しますか？')">{{ __('削除') }}</button>
            @endif
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
