@extends('layouts.app')

@section('content')
<div class="admin">

    <h2 class="admin-title">Admin</h2>

    {{-- 検索 --}}
    <form method="GET" action="{{ route('admin.index') }}" class="admin-search">

        <input type="text"
               name="keyword"
               value="{{ request('keyword') }}"
               placeholder="名前やメールアドレスを入力してください"
               class="admin-input">

        <select name="gender" class="admin-select">
            <option value="">性別</option>
            <option value="1" {{ request('gender')=='1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender')=='2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender')=='3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id" class="admin-select">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id')==(string)$category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}" class="admin-date">

        <button type="submit" class="admin-btn admin-btn-search">検索</button>
        <a href="{{ route('admin.index') }}" class="admin-btn admin-btn-reset">リセット</a>
    </form>


    {{-- エクスポート＋ページネーション --}}
    <div class="admin-top-row">
        <a href="{{ route('admin.export', request()->query()) }}" class="admin-btn-export">
            エクスポート
        </a>

        <div class="admin-pagination">
            {{ $contacts->onEachSide(1)->links('pagination::default') }}
        </div>
    </div>


    {{-- テーブル --}}
    <table class="admin-table">
        <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender == 1) 男性
                    @elseif($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ optional($contact->category)->content }}</td>
                <td>
                    <button
                        type="button"
                        class="admin-detail-btn"
                        data-delete-url="{{ route('admin.contacts.destroy', $contact) }}"
                        data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                        data-gender="{{ $contact->gender }}"
                        data-email="{{ $contact->email }}"
                        data-category="{{ optional($contact->category)->content }}"
                        data-detail="{{ $contact->detail }}">
                        詳細
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


{{-- モーダル --}}
<div id="adminModal" class="admin-modal">
    <div class="admin-modal-content">
        <span class="admin-modal-close">&times;</span>

        <h3 class="admin-modal-title">お問い合わせ詳細</h3>

        <div class="admin-modal-body">
            <p><strong>お名前：</strong><span id="modal-name"></span></p>
            <p><strong>性別：</strong><span id="modal-gender"></span></p>
            <p><strong>メール：</strong><span id="modal-email"></span></p>
            <p><strong>種類：</strong><span id="modal-category"></span></p>
            <p><strong>内容：</strong></p>
            <p id="modal-detail"></p>
        </div>

        <div class="admin-modal-actions">
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-delete-btn">
                    削除
                </button>
            </form>
        </div>
    </div>
</div>


<script>
document.querySelectorAll('.admin-detail-btn').forEach(btn => {
    btn.addEventListener('click', function() {

        document.getElementById('modal-name').textContent = this.dataset.name;

        let gender = this.dataset.gender;
        gender = gender == 1 ? '男性' : (gender == 2 ? '女性' : 'その他');
        document.getElementById('modal-gender').textContent = gender;

        document.getElementById('modal-email').textContent = this.dataset.email;
        document.getElementById('modal-category').textContent = this.dataset.category;
        document.getElementById('modal-detail').textContent = this.dataset.detail;

        const deleteForm = document.getElementById('delete-form');
        deleteForm.action = this.dataset.deleteUrl;

        document.getElementById('adminModal').style.display = 'flex';
    });
});

document.querySelector('.admin-modal-close').addEventListener('click', function() {
    document.getElementById('adminModal').style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target.id === 'adminModal') {
        document.getElementById('adminModal').style.display = 'none';
    }
});
</script>

@endsection
