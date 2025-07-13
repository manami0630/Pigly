<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <div class="admin__content">
            @if(isset($target_weight) && isset($latest_weight) && isset($difference))
            <table class="table">
                <tr class="row">
                    <th class="label">目標体重</th>
                    <th class="label">目標まで</th>
                    <th class="label">最新体重</th>
                </tr>
                <tr class="row">
                    <td class="data">{{ $target_weight }}kg</td>
                    <td class="data">{{ $difference }}kg</td>
                    <td class="data">{{ $latest_weight }}kg</td>
                </tr>
            </table>
            @else
                <p>データが見つかりませんでした。</p>
            @endif
            <div class="form">
                <div class="flex">
                    <form class="search-form" action="{{ route('weight_logs.search') }}" method="get">
                        <div class="search-form__actions">
                            <input class="search-form__date" type="date" name="start_date" value="{{request('start_date')}}"> ～
                            <input class="search-form__date" type="date" name="end_date" value="{{request('end_date')}}">
                            <input class="search-form__search-btn" type="submit" value="検索">
                        </div>
                    </form>
                    <div class="date__add">
                        <button class="date__add-btn">データ追加</button>
                    </div>
                </div>
                <table class="admin__table">
                    <tr class="admin__row">
                        <th class="admin__label">日付</th>
                        <th class="admin__label">体重</th>
                        <th class="admin__label">食事摂取カロリー</th>
                        <th class="admin__label">運動時間</th>
                        <th class="admin__label"></th>
                    </tr>
                    @foreach ($weight_logs as $weight_log)
                    <tr class="admin__row">
                        <td class="admin__data">{{$weight_log->date}}
                        </td>
                        <td class="admin__data">
                        {{$weight_log->weight}}kg
                        </td>
                        <td class="admin__data">{{$weight_log->calories}}cal
                        </td>
                        <td class="admin__data">{{$weight_log->exercise_time}}
                        </td>
                        <td class="admin__data">
                            <a class="admin__detail-btn" href="/weight_logs/{{$weight_log->id}}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="pagination">
                {{ $weight_logs->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <form action="/weight_logs" method="post">
                    @csrf
                        <div class="form__heading">
                            <h2>Weight Logを追加</h2>
                        </div>
                        <div class="form__group">
                            <div class="form__group-title">
                                <label class="modal-form__label">日付</label>
                                <span class="form__label--required">必須</span>
                            </div>
                            <input class="modal-form__input" type="date" name="date" value="{{ date('Y-m-d') }}">
                            <div class="form__error">
                                @error('date')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__group-title">
                                <label class="modal-form__label">体重</label>
                                <span class="form__label--required">必須</span>
                            </div>
                            <input class="modal__input" type="text" name="weight" value="" placeholder="50.0">kg
                            <div class="form__error">
                                @error('weight')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__group-title">
                                <label class="modal-form__label">摂取カロリー</label>
                                <span class="form__label--required">必須</span>
                            </div>
                            <input class="modal__input" type="text" name="calories" value="" placeholder="1200">cal
                            <div class="form__error">
                                @error('calories')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__group-title">
                                <label class="modal-form__label">運動時間</label>
                                <span class="form__label--required">必須</span>
                            </div>
                            <input class="modal-form__input" type="time" name="exercise_time" value="" placeholder="00:00">
                            <div class="form__error">
                                @error('exercise_time')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form__group">
                            <label class="modal-form__label">運動内容</label>
                            <textarea cols="30" rows="8" placeholder="運動内容を追加" name="exercise_content" ></textarea>
                            <div class="form__error">
                                @error('exercise_content')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form__button">
                            <a class="modal__back-btn" href="/weight_logs">戻る</a>
                            <button class="form__button-submit" type="submit">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            const addButton = document.querySelector('.date__add-btn');
            const modal = document.getElementById('modal');
            addButton.addEventListener('click', () => {
                modal.style.display = 'block';
            });
        </script>
    </main>
</body>
</html>