@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Cities
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            @include('admin.includes.message-block')
            <section class="col-lg-6">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Список городов</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="100">ID</th>
                                <th>Название</th>
                                <th>Метро</th>
                                <th>Slug</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->city_name }}</td>
                                    <td>{{ \App\Models\City::availabilityMetro($city->metro) }}</td>
                                    <td>{{ $city->slug }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Метро</th>
                                <th>Slug</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>

            <section class="col-lg-6">

                <div class="box box-primary">
                    <form action="{{ route('admin.city.create') }}" method="post" role="form">
                        <div class="box-header">
                            <h3 class="box-title">Добавить новый город на сайт</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Название города</label>
                                <input type="text" name="city_name" class="form-control" value="{{ old('city_name') }}" placeholder="Название города">
                            </div>

                            <div class="form-group">
                                <label>Метро</label>
                                <select name="metro" class="form-control">
                                    <option value="0">Нету</option>
                                    <option value="1">Есть</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Добавить</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>

@endsection