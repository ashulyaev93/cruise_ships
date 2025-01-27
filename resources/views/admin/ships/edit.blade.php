@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать лайнер: {{ $ship->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('ships.index') }}">Лайнеры</a></li>
                        <li class="breadcrumb-item active">Редактировать лайнер</li>
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
                    <form action="{{ route('ships.update', $ship) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $ship->title) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description" id="description" class="form-control" rows="10">{!! old('description', $ship->description) !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Спецификация</label>
                            <div id="spec-container">
                                @if(old('spec', $ship->spec))
                                    @foreach(old('spec', $ship->spec) as $index => $item)
                                        <div class="row mb-2 spec-item">
                                            <div class="col-5">
                                                <input type="text" name="spec[{{$index}}][name]"
                                                    class="form-control"
                                                    value="{{ $item['name'] }}"
                                                    placeholder="Название характеристики">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" name="spec[{{$index}}][value]"
                                                    class="form-control"
                                                    value="{{ $item['value'] }}"
                                                    placeholder="Значение">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-danger remove-spec">Удалить</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ordering">Порядок сортировки</label>
                            <input type="number" name="ordering" id="ordering" class="form-control" value="{{ old('ordering', $ship->ordering) }}">
                        </div>
                        <div class="form-group">
                            <label for="state">Статус</label>
                            <select name="state" id="state" class="form-control">
                                <option value="1" {{ old('state', $ship->state) == 1 ? 'selected' : '' }}>Активен</option>
                                <option value="0" {{ old('state', $ship->state) == 0 ? 'selected' : '' }}>Неактивен</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Сохранить изменения</button>
                        <a href="{{ route('ships.index') }}" class="btn btn-danger">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('spec-container');
    const addButton = document.getElementById('add-spec');

    addButton.addEventListener('click', function() {
        const index = container.children.length;
        const newRow = `
            <div class="row mb-2 spec-item">
                <div class="col-5">
                    <input type="text" name="spec[${index}][name]"
                           class="form-control"
                           placeholder="Название характеристики">
                </div>
                <div class="col-5">
                    <input type="text" name="spec[${index}][value]"
                           class="form-control"
                           placeholder="Значение">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger remove-spec">Удалить</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newRow);
    });

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-spec')) {
            e.target.closest('.spec-item').remove();
        }
    });
});
</script>
@endpush
