@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="icon-users">Cadastros</h4>
                        <p><b>Locadores:</b> {{ $owners }}</p>
                        <p><b>Locatários:</b> {{ $customers }}</p>
                    </article>

                    <article class="blog radius">
                        <h4 class="icon-home">Imóveis</h4>
                        <p><b>Disponíveis:</b> {{ $propertiesAvailable }}</p>
                        <p><b>Locados:</b> {{ $propertiesUnavailable }}</p>
                        <p><b>Total:</b> {{ $propertiesTotal }}</p>
                    </article>

                    <article class="users radius">
                        <h4 class="icon-file-text">Contratos</h4>
                        <p><b>Oficializados:</b> {{ $contractsTotal }}</p>
                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Mensalidade com com Parcelas em aberto</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>Parcela</th>
                            <th>Locatário</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Pago</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rents as $rent)
                            <tr>
                                <td>{{ $rent->enrollment }}</td>
                                <td>{{ $rent->customerObject->name }}</td>
                                <td>R$ {{ $rent->value }}</td>
                                <td>{{ date('d/m/Y', strtotime($rent->due_at)) }}</td>
                                <td><input type="checkbox" name="satus" disabled
                                        {{ $rent->status == 'paid' ? 'checked' : ''}}>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Repasses com Parcelas em aberto</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable2" class="nowrap stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>Parcela</th>
                            <th>Locador</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Pago</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transfers as $transfer)
                            <tr>
                                <td>{{ $transfer->enrollment }}</td>
                                <td>{{ $transfer->ownerObject->name }}</td>
                                <td>R$ {{ $transfer->value }}</td>
                                <td>{{ date('d/m/Y', strtotime($transfer->due_at)) }}</td>
                                <td><input type="checkbox" name="satus" disabled
                                        {{ $transfer->status == 'paid' ? 'checked' : ''}}>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-file-text">Últimos Contratos Cadastrados</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable3" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Locador</th>
                            <th>Locatário</th>
                            <th>Início</th>
                            <th>Fim</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $contract)
                            <tr>
                                <td><a href="{{ route('admin.contracts.edit', ['contract' => $contract->id]) }}"
                                       class="text-orange">{{ $contract->id }}</a></td>
                                <td><a href="{{ route('admin.contracts.edit', ['contract' => $contract->id]) }}"
                                       class="text-orange">{{ $contract->ownerObject->name }}</a></td>
                                <td><a href="{{ route('admin.contracts.edit', ['contract' => $contract->id]) }}"
                                       class="text-orange">{{ $contract->customerObject->name }}</a></td>
                                <td>{{ date('d/m/Y', strtotime($contract->start_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($contract->end_at)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>



    </div>
@endsection

