@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-users">Clientes</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.customers.index') }}" class="text-orange">Clientes</a></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.customers.create') }}" class="btn btn-orange icon-user ml-1">Criar Cliente</a>
            </div>
        </header>


        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome Completo</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td><a href="{{ route('admin.customers.edit', ['customer' => $customer->id ]) }}" class="text-orange">{{ $customer->name }}</a></td>
                            <td><a href="mailto:{{ $customer->email }}" class="text-orange">{{ $customer->email }}</a></td>
                            <td>{{ $customer->telephone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
