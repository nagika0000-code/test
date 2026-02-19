@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="page-title" style="text-align:center;">Confirm</h2>

    <div class="confirm-wrapper">
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $input['last_name'] }} {{ $input['first_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if($input['gender'] == 1) 男性
                    @elseif($input['gender'] == 2) 女性
                    @else その他
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $input['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $input['tel'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $input['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $input['building'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $input['category_name'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{!! nl2br(e($input['detail'])) !!}</td>
            </tr>
        </table>

        {{-- ボタンエリア --}}
        <div class="confirm-buttons">

            {{-- 送信 --}}
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                @foreach($input as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <button type="submit" class="btn-confirm">送信</button>
            </form>

            {{-- 修正 --}}
            <form method="GET" action="{{ route('contact.index') }}">
                @foreach($input as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                 <button type="submit" class="confirm-back">修正</button>

            </form>
        </div>

    </div>
</div>
@endsection
