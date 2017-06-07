@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Page edit
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">

                @include('admin.includes.message-block')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Редактировать страницу</h3>
                    </div>

                    <form action="{{ route('admin.page.edit', ['id' => $page->id]) }}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Статус</label>
                                <select class="form-control" name="enabled">
                                    <option value="1" @if($page->enabled == 1) selected @endif >Включена</option>
                                    <option value="0" @if($page->enabled == 0) selected @endif>Выключена</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $page->name }}">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ $page->slug }}" disabled>
                            </div>

                            @if($page->is_content == 1)
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" cols="30" rows="10">{{ $page->content }}</textarea>
                                </div>
                            @endif
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="btn-group pull-right" role="group" aria-label="...">
                                <a href="{{ route('admin.pages') }}" class="btn btn-default">Назад</a>
                                <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>

@endsection