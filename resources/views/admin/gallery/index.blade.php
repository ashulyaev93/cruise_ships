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
            <div class="row mb-3">
                <div class="col-4">
                    <a href="{{ route('gallery.create') }}" class="btn btn-primary">Добавить изображение</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($gallery->isEmpty())
                        <p>Нет изображений для отображения.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Предпросмотр</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gallery as $image)
                                    <tr>
                                        <td>{{ $image->title }}</td>
                                        <td>
                                        <img
                                            src="{{ (filter_var($image->url, FILTER_VALIDATE_URL)) ? $image->url : asset('storage/' . $image->url) }}"
                                            alt="{{ $image->title }}"
                                            class="img-thumbnail"
                                            style="max-width: 150px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('gallery.show', $image) }}" class="btn btn-primary btn-sm">Просмотреть</a>
                                            <form action="{{ route('gallery.destroy', $image) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Вы уверены, что хотите удалить это изображение?')">
                                                    Удалить
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $gallery->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
