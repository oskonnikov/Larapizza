@extends('layouts.admin')
@section('title', 'Мои данные')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h4>{{ Auth::user()->surname }} {{ Auth::user()->name }} {{ Auth::user()->patronymic }}</h4>
            <p class="text-muted">Дата рождения: {{ Auth::user()->date_of_birth }}</p>
            <p class="text-muted">Email: {{ Auth::user()->email }}</p>
            <a href="{{ url('/admin/personal/edit') }}" class="btn btn-primary">Изменить</a>
        </div>
    </div>
@endsection