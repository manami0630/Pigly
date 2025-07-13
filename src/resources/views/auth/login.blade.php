<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
    <main>
        <form class="form" action="/login" method="post">
        @csrf
            <div class="form__heading">
                <h1>PiGLy</h1>
                <h2>ログイン</h2>
            </div>
            <div class="form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input class="register-form__input" type="email" name="email" id="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワードを入力">
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <input class="register-form__btn" type="submit" value="ログイン">
            </div>
            <div class="form__group">
                <a class="register__btn" href="/register">アカウント作成はこちら</a>
            </div>
        </form>
    </main>
</body>
</html>