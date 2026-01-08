<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>書籍一覧</title>
</head>
<body>
    <main> -->
<x-layouts.book-manager>
    <x-slot:title>
        書籍一覧
    </x-slot:title>
    <h1>書籍一覧</h1>
        @if(session('message'))
            <x-alert class="info">
                {{ session('message') }}
            </x-alert>
        @endif
        <a href="{{ route('book.create') }}">追加</a>
        <x-book-table :$books />
</x-layouts.book-manager>
    <!-- </main>
</body>
</html> -->