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
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="100">ID</th>
                                <th>Название</th>
                                <th>c1</th>
                                <th>c2</th>
                                <th>Город</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($streets as $street)
                                <tr>
                                    <td>{{ $street->id }}</td>
                                    <td>{{ $street->address }}</td>
                                    <td>{{ $street->c1 }}</td>
                                    <td>{{ $street->c2 }}</td>
                                    <td>{{ $street->city->city_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>c1</th>
                                <th>c2</th>
                                <th>Город</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>

            <section class="col-lg-6">

                <div class="box box-primary">

                </div>
            </section>
        </div>
    </section>

@endsection