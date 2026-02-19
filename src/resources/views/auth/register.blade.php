@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="auth-wrapper">

    <h2 class="auth-title">Register</h2>

    <div class="auth-card">

        <form method="POST" action="{{ route('register') }}">
            @csrf

        <div class="auth-group">
            <label class="auth-label">お名前</label>
            <input type="text" name="name"
                  class="auth-input @error('name') is-error @enderror"
                  value="{{ old('name') }}"
                  placeholder="例: 山田 太郎">

            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>


        <div class="auth-group">
            <label class="auth-label">メールアドレス</label>
            <input type="email" name="email"
                  class="auth-input @error('email') is-error @enderror"
                  value="{{ old('email') }}"
                  placeholder="例: test@example.com">

            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
</div>


        <div class="auth-group">
            <label class="auth-label">パスワード</label>
            <input type="password" name="password"
                  class="auth-input @error('password') is-error @enderror"
                  placeholder="例: coachtech1106">

            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
</div>


            <div class="auth-button-wrapper">
                <button type="submit" class="auth-submit">登録</button>
            </div>

        </form>

    </div>
</div>
@endsection
