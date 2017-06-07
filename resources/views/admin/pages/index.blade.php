@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Pages
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">

                @include('admin.includes.message-block')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список странц на сайте</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Slug</th>
                                <th>Статус</th>
                                <th width="50px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->name }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{{ \App\Models\Page::availabilityStatus($page->enabled) }}</td>
                                    <td style="text-align: center;"><a href="/admin-panel/page/edit/{{ $page->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Slug</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
    </section>

@endsection