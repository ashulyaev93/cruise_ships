@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $ship->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('ships.index') }}">Лайнеры</a></li>
                        <li class="breadcrumb-item active">{{ $ship->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <h3>Основная информация</h3>
                                <p><strong>Название:</strong> {{ $ship->title }}</p>
                                <p><strong>Статус:</strong>
                                    @if($ship->state == 1)
                                        <span class="badge badge-success">Активен</span>
                                    @else
                                        <span class="badge badge-danger">Неактивен</span>
                                    @endif
                                </p>
                                <p><strong>Порядок сортировки:</strong> {{ $ship->ordering ?? 'Не указан' }}</p>
                            </div>

                            @if($ship->description)
                            <div class="mb-4">
                                <h3>Описание</h3>
                                <div class="p-3 bg-light">
                                    {!! $ship->description !!}
                                </div>
                            </div>
                            @endif

                            @if($ship->spec)
                            <div class="mb-4">
                                <h3>Спецификация</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Характеристика</th>
                                            <th>Значение</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ship->spec as $item)
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['value'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            @if($cabinCategories->isNotEmpty())
                            <div class="mb-4">
                                <h3>Категории кают</h3>
                                <ul class="list-group">
                                    @foreach($cabinCategories as $category)
                                    <li class="list-group-item">
                                        {{ $category->title }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if($gallery->isNotEmpty())
                            <div class="mb-4">
                                <h3>Галерея</h3>
                                <div class="row">
                                    @foreach($gallery as $image)
                                    <div class="col-md-3 mb-3">
                                        <img
                                            src="{{ (filter_var($image->url, FILTER_VALIDATE_URL)) ? $image->url : asset('storage/' . $image->url) }}"
                                            alt="{{ $image->title }}"
                                            class="img-fluid rounded">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="mt-4">
                                <a href="{{ route('ships.index') }}" class="btn btn-secondary">Назад</a>
                                <a href="{{ route('ships.edit', $ship) }}" class="btn btn-primary">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
