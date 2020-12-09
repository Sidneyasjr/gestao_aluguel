@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-money">Repasses</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.properties.create') }}" class="text-orange">Imóveis</a></li>
                    </ul>
                </nav>
                <a href="{{ route('admin.contracts.create') }}" class="btn btn-orange icon-pencil-square-o ml-1">Novo
                    Contrato</a>
            </div>
        </header>


        <div class="dash_content_app_box">
            @if($errors->all())
                @foreach($errors->all() as $error)
                    @message(['color' => 'orange'])
                    <p class="icon-asterisk">{{ $error }}</p>
                    @endmessage
                @endforeach
            @endif

            @if(session()->exists('message'))
                @message(['color' => session()->get('color')])
                <p class="icon-asterisk">{{ session()->get('message') }}</p>
                @endmessage
            @endif
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>Parcela</th>
                        <th>Locador</th>
                        <th>Contrato</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Pago</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rents as $rent)
                        <tr>
                            <td>{{ $rent->enrollment }}</td>
                            <td>{{ $rent->customerObject->name }}</td>
                            <td><a href="{{ route('admin.contracts.edit', ['contract' => $rent->contract]) }}" class="text-orange">Nº {{ $rent->contract }}</td>
                            <td>R$ {{ $rent->value }}</td>
                            <td>{{ date('d/m/Y', strtotime($rent->due_at)) }}</td>
                            <td>
                                <label class="label">
                                    <form action="{{ route('admin.rents.update', ['rent' => $rent ]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @if($rent->status == 'unpaid')
                                            <input class="btn btn-orange" type="submit" value="Não Pago">
                                        @else
                                            <input class="btn btn-green" type="submit" value="Pago">
                                        @endif
                                    </form>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

