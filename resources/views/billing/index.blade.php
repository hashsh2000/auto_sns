@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h1 class="text-center my-5">支払い状況確認</h1>
        <div class="form-inline mb-4">
          <form method="GET" action="{{ route('billing.index') }}">
          <select class="form-control mr-2" id="year-select" name="selected_year">
            @foreach ($years as $year)
            <option value="{{ $year }}" @if ($year == $selected_year) selected @endif>
              {{ $year }}年
            </option>
            @endforeach
          </select>
          <select class="form-control mr-2" id="month-select" name="selected_month">
            @foreach ($months as $month)
            <option value="{{ str_pad($month, 2, 0, STR_PAD_LEFT) }}" @if ($month == $selected_month) selected @endif>
              {{ $month }}月
            </option>
            @endforeach
          </select>
          <button class="btn btn-primary">選択</button>
          </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>User Name</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      @if( in_array($user->id,$paid_list))
                      <td>
                          <button type="submit" class="btn" disabled>支払い確認済み</button>
                      </td>
                      @else
                      <td>
                        <form method="POST" action="{{ route('billing.form.create') }}">
                          @csrf
                          <input type="hidden" name="user_id" value="{{  $user->id  }}">
                          <input type="hidden" name="year"    value="{{  $selected_year  }}">
                          <input type="hidden" name="month"   value="{{  $selected_month  }}">
                          <button type="submit" class="btn btn-success" onclick="return confirm('このユーザーの支払いを確認しましたか?\nuser_id:{{  $user->id  }}')">支払い済み登録</button>
                        </form>
                      </td>
                      @endif
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
