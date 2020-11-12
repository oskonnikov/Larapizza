@extends('layouts.admin')
@section('title', 'Изменение данных пользователя')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <form role="form" method="POST" action="{{ url('/admin/user/save') }}">
                {{ csrf_field() }}
                <input id="id" name="id" value="{{ $user->id }}" type="hidden">
                <div class="form-group">
                    <label for="surname">Фамилия</label>
                    <input id="surname" class="form-control" name="surname" value="{{ $user->surname }}" placeholder="Фамилия">
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input id="name" class="form-control" name="name" value="{{ $user->name }}" placeholder="Имя" required="">
                </div>
                <div class="form-group">
                    <label for="patronymic">Отчество</label>
                    <input id="patronymic" class="form-control" name="patronymic" value="{{ $user->patronymic }}" placeholder="Отчество">
                </div>
                @if(Auth::user()->isSuperAdmin())
                    <div class="form-group">
                        <label for="permissions">Права доступа</label>
                        <select class="form-control" id="permissions" name="permissions">
                            <option {{ $user->permissions == 'manager' ? 'selected':''}} value="manager">Менеджер</option>
                            <option {{ $user->permissions == 'admin' ? 'selected':''}} value="admin">Администратор</option>
                            <option {{ $user->permissions == 'locked' ? 'selected':''}} value="locked">Заблокирован</option>
                        </select>
                    </div>
                    @endif
                <div class="form-group">
                    <label for="gender">Пол</label>
                    <select class="form-control" id="gender" name="gender">
                        <option {{ $user->gender == 'unset' ? 'selected':''}} value="unset">Не выбран</option>
                        <option {{ $user->gender == 'male' ? 'selected':''}} value="male">Мужской</option>
                        <option {{ $user->gender == 'female' ? 'selected':''}} value="female">Женский</option>
                        <option {{ $user->gender == 'other' ? 'selected':''}} value="other">Другой</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Дата рождения</label>
                    <input id="date_of_birth" class="form-control" name="date_of_birth" value="{{ $user->date_of_birth }}" placeholder="2000-01-01">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
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