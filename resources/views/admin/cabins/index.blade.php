@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Категории кают</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Категории кают</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if($cabins->isEmpty())
                        <p>Нет доступных категорий кают.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Тип</th>
                                    <th>Корабль</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cabins as $cabin)
                                    <tr>
                                        <td>{{ $cabin->title }}</td>
                                        <td>{{ $cabin->type }}</td>
                                        <td>{{ $cabin->ship->title }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('cabins.edit', $cabin->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $cabins->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
