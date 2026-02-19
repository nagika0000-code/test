@extends('layouts.app')

@section('content')
<div class="thanks-wrapper">

    <div class="thanks-bg-text">
        Thank you
    </div>

    <div class="thanks-content">
        <p class="thanks-message">
            お問い合わせありがとうございました
        </p>

        <a href="{{ route('contact.index') }}" class="thanks-home-btn">
            HOME
        </a>
    </div>

</div>
@endsection
