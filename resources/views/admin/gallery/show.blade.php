@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $image->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Галерея</a></li>
                        <li class="breadcrumb-item active">{{ $image->title }}</li>
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
                        <div class="card-body text-center">
                            <img src="{{ $image->url }}" alt="{{ $image->title }}" class="img-thumbnail mb-3" style="max-width: 500px; height: auto;">
                            <p><strong>Название:</strong> {{ $image->title }}</p>
                            <form action="{{ route('gallery.destroy', $image) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Вы уверены, что хотите удалить это изображение?')">
                                    Удалить
                                </button>
                            </form>
                            <a href="{{ route('gallery.index') }}" class="btn btn-secondary ml-2">Назад</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
