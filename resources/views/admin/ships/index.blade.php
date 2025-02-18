@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Лайнеры</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Лайнеры</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if($ships->isEmpty())
                        <p>Нет доступных лайнеров.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ships as $ship)
                                    <tr>
                                        <td>{{ $ship->title }}</td>
                                        <td>
                                            <a href="{{ route('ships.show', $ship) }}" class="btn btn-primary btn-sm">Просмотр</a>
                                            <a href="{{ route('ships.edit', $ship) }}" class="btn btn-warning btn-sm">Редактировать</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ships->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
