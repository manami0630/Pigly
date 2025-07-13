<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}" />
</head>
<body>
    <header>
        <div class="header">
            <div class="header-utilities">
                <h1 class="header__logo">
                    PiGLy
                </h1>
            </div>
            <div class="header__inner">
                <form action="/weight_logs/goal_setting" method="get">
                    <input class="header__link" type="submit" value="目標体重設定">
                </form>
                <form action="/logout" method="post">
                @csrf
                    <input class="header__link" type="submit" value="ログアウト">
                </form>
            </div>
        </div>
    </header>
    <main>
        <form class="form" action="/weight_logs/goal_setting" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user_id }}">
            <div class="form__heading">
                <h2>目標体重設定</h2>
            </div>
            <div class="form__group">
                <input class="register-form__input" type="text" name="target_weight" id="target_weight"  value="{{ old('target_weight') }}"> kg
                <div class="form__error">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <a class="settings__back-btn" href="/weight_logs">戻る</a>
                <input class="settings__update-btn" type="submit" value="更新">
            </div>
        </form>
    </main>
</body>
</html>