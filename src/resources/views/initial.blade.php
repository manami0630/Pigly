<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/initial.css') }}" />
</head>
<body>
    <main>
        <form class="form" action="/register/step2" method="post">
        @csrf
            <div class="form__heading">
                <h1>PiGLy</h1>
                <h2>新規会員登録</h2>
                <p>STEP2 体重データの入力</p>
            </div>
            <div class="form__group">
                <label class="register-form__label" for="weight">現在の体重</label>
                <input class="register-form__input" type="text" name="weight" id="weight" placeholder="現在の体重を入力" value="{{ old('weight') }}"> kg
                <div class="form__error">
                    @error('weight')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="register-form__label" for="target_weight">目標体重</label>
                <input class="register-form__input" type="text" name="target_weight" id="target_weight" placeholder="目標の体重を入力" value="{{ old('target_weight') }}"> kg
                <div class="form__error">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <input class="register-form__btn" type="submit" value="アカウント作成">
            </div>
        </form>
    </main>
</body>
</html>