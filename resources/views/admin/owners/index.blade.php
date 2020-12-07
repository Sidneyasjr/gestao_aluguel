@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-users">Proprietários</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.owners.index') }}" class="text-orange">Proprietários</a></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.owners.create') }}" class="btn btn-orange icon-user ml-1">Criar
                    Proprietário</a>
            </div>
        </header>


        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome Completo</th>>
                        <th>E-mail</th>
                        <th>Dia do Repasse</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($owners as $owner)
                        <tr>
                            <td>{{ $owner->id }}</td>
                            <td><a href="{{ route('admin.owners.edit', ['owner' => $owner->id]) }}" class="text-orange">{{ $owner->name }}</a></td>
                            <td><a href="mailto:{{ $owner->email }}" class="text-orange">{{ $owner->email }}</a></td>
                            <td>{{ $owner->day_transfer }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
