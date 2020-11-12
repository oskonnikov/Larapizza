@extends('layouts.admin')
@section('title', 'Добавление пользователя')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <form role="form" method="POST" action="{{ url('/admin/user/save') }}">
                {{ csrf_field() }}
                <input id="id" name="id" value="" type="hidden">
                <div class="form-group">
                    <label for="surname">Фамилия</label>
                    <input id="surname" class="form-control" name="surname" value="" placeholder="Фамилия">
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input id="name" class="form-control" name="name" value="" placeholder="Имя" required="">
                </div>
                <div class="form-group">
                    <label for="patronymic">Отчество</label>
                    <input id="patronymic" class="form-control" name="patronymic" value="" placeholder="Отчество">
                </div>
                <div class="form-group">
                    <label for="gender">Пол</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="unset">Не выбран</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                        <option value="other">Другой</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Дата рождения</label>
                    <input id="date_of_birth" class="form-control" name="date_of_birth" value="" placeholder="2000-01-01">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputPassword">Пароль</label>
                    <input id="password" type="password" class="form-control" name="password"
                           placeholder="Пароль">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    {{ $errors->has('password') ? ' has-error' : '' }}
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
            $('#date_of_birth').mask('0000-00-00');
            $('#email').mask("A", {
                translation: {
                    "A": { pattern: /[\w@\-.+]/, recursive: true }
                }
            });
        });
    </script>
@endsection