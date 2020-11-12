@extends('layouts.admin')
@section('title', 'Добавление параметра')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="POST" action="{{ url('/admin/settings/save') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <label for="name">Параметр</label>
                    <input id="name" class="form-control" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="value">Значение</label>
                    <textarea class="form-control" id="value" name="value" rows="8"></textarea>
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

        });
    </script>
@endsection