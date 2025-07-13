<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/details.css') }}" />
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
                @csrf
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
        <div class="details__content">
            <form class="form" action="/weight_logs/{{$weight_log->id}}/update" method="post">
            @csrf
                <div class="form__heading">
                    <h2>Weight Log</h2>
                </div>
                @if(isset($weight_log))
                <div class="modal" id="{{$weight_log->id}}">
                    <div class="form__group">
                        <label class="details-form__label">日付</label>
                        <input class="details-form__input" type="date" name="date" value="{{ old('date', $weight_log->date ?? now()->format('Y-m-d')) }}">
                        <div class="form__error">
                            @error('date')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="details-form__label">体重</label>
                        <input class="details__input" type="text" name="weight" value="{{$weight_log->weight}}">kg
                        <div class="form__error">
                            @error('weight')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="details-form__label">摂取カロリー</label>
                        <input class="details__input" type="text" name="calories" value="{{$weight_log->calories}}">cal
                        <div class="form__error">
                            @error('calories')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="details-form__label">運動時間</label>
                        <input class="details-form__input" type="time" name="exercise_time" value="{{ old('exercise_time', $weight_log->exercise_time ?? '00:00') }}">
                        <div class="form__error">
                            @error('exercise_time')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="details-form__label">運動内容</label>
                        <textarea cols="30" rows="8" placeholder="運動内容を追加" name="exercise_content" >{{$weight_log->exercise_content}}</textarea>
                        <div class="form__error">
                            @error('exercise_content')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="form__button">
                    <a class="details__back-btn" href="/weight_logs">戻る</a>
                    <button class="form__button-submit" type="submit">更新</button>
                </div>
            </form>
            <form class="delete" action="/weight_logs/{{$weight_log->id}}/delete" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
                <button type="submit" style="background:none;border:none;padding:0;">
                    <img src="{{ asset('storage/img/icons8-trash-can.svg') }}" alt="ゴミ箱アイコン" style="width:24px;">
                </button>
            </form>
        </div>
    </main>
</body>
</html>