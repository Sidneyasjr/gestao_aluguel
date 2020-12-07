@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-home">Imoveis</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.properties.index') }}" class="text-orange">Imoveis</a></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.properties.create') }}" class="btn btn-orange icon-user ml-1">Criar Imovel</a>
            </div>
        </header>


        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome do Proprietário</th>
                        <th>Rua</th>
                        <th>Numero</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($properties as $property)
                        <tr>
                            <td><a href="{{ route('admin.properties.edit', ['property' => $property]) }}" class="text-orange">{{ $property->id }}</a></td>
                            <td><a href="{{ route('admin.properties.edit', ['property' => $property]) }}" class="text-orange">{{ $property->ownerObject->name }}</a></td>
                            <td>{{ $property->street }}</td>
                            <td>{{ $property->number }}</td>
                            <td>{{ $property->neighborhood }}</td>
                            <td>{{ $property->city }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
