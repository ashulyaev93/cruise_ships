@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Галерея изображений</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Галерея изображений</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="ship_id">Корабль</label>
                            <select name="ship_id" id="ship_id" class="form-control" required>
                                @foreach($ships as $ship)
                                    <option value="{{ $ship->id }}">{{ $ship->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Название изображения</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="url">Загрузить изображение</label>
                            <input type="file" name="url" id="url" class="form-control-file" required>
                        </div>

                        <div class="form-group">
                            <label for="ordering">Порядок</label>
                            <input type="number" name="ordering" id="ordering" class="form-control" value="{{ old('ordering', $defaultOrdering) }}">
                        </div>

                        <button type="submit" class="btn btn-success">Создать</button>
                        <a href="{{ route('gallery.index') }}" class="btn btn-danger">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
