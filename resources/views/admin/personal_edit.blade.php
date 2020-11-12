@extends('layouts.admin')
@section('title', 'Изменение моих данных')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <form role="form" method="POST" action="{{ url('/admin/personal/save') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="surname">Фамилия</label>
                    <input id="surname" class="form-control" name="surname" value="{{ Auth::user()->surname }}" placeholder="Фамилия">
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input id="name" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Имя" required="">
                </div>
                <div class="form-group">
                    <label for="patronymic">Отчество</label>
                    <input id="patronymic" class="form-control" name="patronymic" value="{{ Auth::user()->patronymic }}" placeholder="Отчество">
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Дата рождения</label>
                    <input id="date_of_birth" class="form-control" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}" placeholder="2000-01-01">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email" required="">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="inputPassword">Пароль</label>
                    <input id="password" type="password" class="form-control" name="password"
                           placeholder="Пароль">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputPassword">Повторите пароль</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           placeholder="Повторите пароль">
                </div>
                <button class="btn btn-primary" type="submit">Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
@section('additional-scripts')
    <script>
        $(document).ready(function(){
            $('#date_of_birth').mask('2000-01-01');
            $('#email').mask("A", {
                translation: {
                    "A": { pattern: /[\w@\-.+]/, recursive: true }
                }
            });
        });
    </script>
@endsection