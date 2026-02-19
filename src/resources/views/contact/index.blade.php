@extends('layouts.app')

@section('content')

{{-- エラー表示 --}}
@if ($errors->any())
<div class="contact-error">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2 class="page-title">Contact</h2>


<form method="POST" action="/confirm" class="contact-form">
    @csrf

    @php
        $genderValue = request('gender') ?? '1';
        $selectedGender = old('gender') ?? $genderValue;
    @endphp

    {{-- 名前 --}}
    <div class="contact-group">
        <div class="contact-label">
            お名前 <span class="required">※</span>
        </div>

        <div class="contact-input-area contact-row">
            <input class="contact-input"
                   type="text"
                   name="last_name"
                   value="{{ old('last_name', request('last_name')) }}"
                   placeholder="例: 山田">

            <input class="contact-input"
                   type="text"
                   name="first_name"
                   value="{{ old('first_name', request('first_name')) }}"
                   placeholder="例: 太郎">
        </div>
    </div>

    {{-- 性別 --}}
    <div class="contact-group">
        <div class="contact-label">
            性別 <span class="required">※</span>
        </div>

        <div class="contact-input-area contact-row">
            <label><input type="radio" name="gender" value="1"
                {{ $selectedGender  == '1' ? 'checked' : '' }}> 男性</label>

            <label><input type="radio" name="gender" value="2"
                {{ $selectedGender == '2' ? 'checked' : '' }}> 女性</label>

            <label><input type="radio" name="gender" value="3"
                {{ $selectedGender == '3' ? 'checked' : '' }}> その他</label>
        </div>
    </div>

    {{-- メール --}}
    <div class="contact-group">
        <div class="contact-label">
            メールアドレス <span class="required">※</span>
        </div>

        <div class="contact-input-area">
            <input class="contact-input"
                   type="email"
                   name="email"
                   value="{{ old('email', request('email')) }}"
                   placeholder="例: test@example.com">
        </div>
    </div>

    {{-- 電話番号 --}}
    <div class="contact-group">
        <div class="contact-label">
            電話番号 <span class="required">※</span>
        </div>

        <div class="contact-input-area contact-row tel-row">
            <input class="contact-input tel-input"
                   type="text"
                   name="tel1"
                   maxlength="5"
                   pattern="\d*"
                   inputmode="numeric"
                   value="{{ old('tel1', request('tel1')) }}">
            <span class="tel-dash">-</span>

            <input class="contact-input tel-input"
                   type="text"
                   name="tel2"
                   maxlength="5"
                   pattern="\d*"
                   inputmode="numeric"
                   value="{{ old('tel2', request('tel2')) }}">
            <span class="tel-dash">-</span>

            <input class="contact-input tel-input"
                   type="text"
                   name="tel3"
                   maxlength="5"
                   pattern="\d*"
                   inputmode="numeric"
                   value="{{ old('tel3', request('tel3')) }}">
        </div>
    </div>

    {{-- 住所 --}}
    <div class="contact-group">
        <div class="contact-label">
            住所 <span class="required">※</span>
        </div>

        <div class="contact-input-area">
            <input class="contact-input"
                   type="text"
                   name="address"
                   value="{{ old('address', request('address')) }}"
                   placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
        </div>
    </div>

    {{-- 建物名 --}}
    <div class="contact-group">
        <div class="contact-label">
            建物名
        </div>

        <div class="contact-input-area">
            <input class="contact-input"
                   type="text"
                   name="building"
                   value="{{ old('building', request('building')) }}"
                   placeholder="例: 千駄ヶ谷マンション101">
        </div>
    </div>

    {{-- お問い合わせ種類 --}}
    <div class="contact-group">
        <div class="contact-label">
            お問い合わせの種類 <span class="required">※</span>
        </div>

        <div class="contact-input-area">
            <select name="category_id" class="contact-select">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="contact-group">
        <div class="contact-label">
            お問い合わせ内容 <span class="required">※</span>
        </div>

        <div class="contact-input-area">
            <textarea class="contact-textarea"
                name="detail"
                placeholder="お問い合わせ内容をご記載ください">{{ old('detail', request('detail')) }}
            </textarea>
        </div>
    </div>

    {{-- ボタン --}}
    <div class="contact-group">
        <button type="submit" class="contact-button">
            確認画面
        </button>
    </div>

</form>

@endsection
