@extends('layouts.admin')
@section('title', 'Добавление продукта')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="POST" action="{{ url('/admin/products/save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Название</label>
                    <input id="product_name" class="form-control" name="product_name"
                           value="">
                </div>
                <div class="form-group">
                    <label for="value">Стоимость (USD)</label>
                    <input id="product_price" class="form-control" name="product_price"
                           value="">
                </div>
                <div class="form-group">
                    <label for="product_active">Активен</label>
                    <select class="form-control" id="product_active" name="product_active">
                        <option value="1">Да</option>
                        <option value="0">Нет</option>
                    </select>
                </div>
                <div class="form-group upload-file">
                    <label id="output_new_file">Изображение: выберите файл с расширением *.jpg размером не более 2
                        Мегабайт</label>
                    <input type="hidden" id="file_key" name="file_key" value="new_file">
                    <div class="input-group">
                        <label class="file_upload file_upload_compact">
                            <input type="file" id="new_file" name="new_file">
                            <span class="button btn btn-warning"> Выбрать файл </span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_price">Изображение:</label>
                    <div class="product-preview">
                        <img class="mx-auto" id="product-image"
                             src="" alt="">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
@section('additional-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change', 'input[type=file]', function (inp) {
                var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;
                var file_name;
                if (file_api && inp.currentTarget.files[0]) {
                    file_name = inp.currentTarget.files[0].name;
                } else {
                    file_name = inp.currentTarget.value.replace("C:\\fakepath\\", '');
                }
                if (!file_name.length) {
                    return;
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#product-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(inp.currentTarget.files[0]);

                var file_size = parseInt(this.files[0].size / 1048576);  //file size in MB
                var target_id = $(this).attr('id');
                // console.log(target_id);
                // console.log(file_name);
                //$("."+target_id).removeAttr('disabled');
                if (file_size > 2048) {
                    console.log('Слишком большой файл');
                    $("." + target_id).attr('disabled');
                    return false;
                } else {
                    $("." + target_id).removeAttr('disabled').css("display", "block");
                }
                $("#output_new_file").html('Выбран файл: ' + file_name);
            }).change();


            function randomizeInteger(min, max) {
                if (max == null) {
                    max = (min == null ? Number.MAX_SAFE_INTEGER : min);
                    min = 0;
                }

                min = Math.ceil(min);  // inclusive min
                max = Math.floor(max); // exclusive max

                if (min > max - 1) {
                    throw new Error("Incorrect arguments.");
                }

                return min + Math.floor((max - min + 1) * Math.random());
            }

        });
    </script>
@endsection