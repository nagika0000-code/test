@extends('layouts.app')

@section('content')
<div class="admin-show">

    <h2>お問い合わせ詳細</h2>

    <a href="{{ route('admin.index') }}">← 一覧に戻る</a>

    <div class="admin-card">
        <p><strong>お名前：</strong>{{ $contact->last_name }} {{ $contact->first_name }}</p>
        <p><strong>性別：</strong>
            @if($contact->gender == 1) 男性
            @elseif($contact->gender == 2) 女性
            @else その他
            @endif
        </p>
        <p><strong>メール：</strong>{{ $contact->email }}</p>
        <p><strong>電話：</strong>{{ $contact->tel }}</p>
        <p><strong>住所：</strong>{{ $contact->address }}</p>
        <p><strong>建物：</strong>{{ $contact->building }}</p>
        <p><strong>種類ID：</strong>{{ $contact->category_id }}</p>
        <p><strong>内容：</strong><br>{{ $contact->detail }}</p>
        <p><strong>登録日：</strong>{{ $contact->created_at }}</p>
    </div>

</div>
@endsection
