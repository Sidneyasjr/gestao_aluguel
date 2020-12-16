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
                        <p><b>Mensalidades a receber:</b> R$ {{ $rentsUnpaid }}</p>
                        <p><b>Repasses a pagar:</b> R$ {{ $transferUnpaid }}</p>
                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Mensalidades em aberto</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>Parcela</th>
                            <th>Locatário</th>
                            <th>Contrato</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rents as $rent)
                            <tr>
                                <td><a href="{{ route('admin.rents.index') }}"
                                       class="text-orange">{{ $rent->enrollment }}</td>
                                <td><a href="{{ route('admin.rents.index') }}"
                                       class="text-orange">{{ $rent->customerObject->name }}</td>
                                <td><a href="{{ route('admin.rents.index') }}"
                                       class="text-orange">Nº {{ $rent->contract }}</td>
                                <td><a href="{{ route('admin.rents.index') }}" class="text-orange">R$ {{ $rent->value }}
                                </td>
                                <td><a href="{{ route('admin.rents.index') }}"
                                       class="text-orange">{{ date('d/m/Y', strtotime($rent->due_at)) }}</td>
                                <td>
                                    <div class="status">
                                        <label class="label">
                                            @if($rent->status == 'unpaid')
                                                <span class="check text-orange icon-thumbs-o-down transition"
                                                      data-toggleclass="active icon-thumbs-o-up text-blue  icon-thumbs-o-down text-orange"
                                                      data-onpaid="{{ route('admin.rents.onpaid', ['rent'=> $rent->id]) }}"></span>
                                            @else
                                                <span class="check text-blue icon-thumbs-o-up transition"
                                                      data-toggleclass="active icon-thumbs-o-up text-blue  icon-thumbs-o-down text-orange"
                                                      data-onpaid="{{ route('admin.rents.onpaid', ['rent'=> $rent->id]) }}"></span>
                                            @endif
                                        </label>
                                    </div>
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
                <h2 class="icon-tachometer">Repasses em aberto</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable2" class="nowrap stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>Parcela</th>
                            <th>Locador</th>
                            <th>Contrato</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transfers as $transfer)
                            <tr>
                                <td><a href="{{ route('admin.transfers.index') }}"
                                       class="text-orange">{{ $transfer->enrollment }}</td>
                                <td><a href="{{ route('admin.transfers.index') }}"
                                       class="text-orange">{{ $transfer->ownerObject->name }}</td>
                                <td><a href="{{ route('admin.transfers.index') }}"
                                       class="text-orange">Nº {{ $transfer->contract }}</td>
                                <td><a href="{{ route('admin.transfers.index') }}"
                                       class="text-orange">R$ {{ $transfer->value }}</td>
                                <td><a href="{{ route('admin.transfers.index') }}"
                                       class="text-orange">{{ date('d/m/Y', strtotime($transfer->due_at)) }}</td>
                                <td>
                                    <div class="status">
                                        <label class="label">
                                            @if($transfer->status == 'unpaid')
                                                <span class="check text-orange icon-thumbs-o-down transition"
                                                      data-toggleclass="active icon-thumbs-o-up text-blue  icon-thumbs-o-down text-orange"
                                                      data-onpaid="{{ route('admin.transfers.onpaid', ['transfer'=> $transfer->id]) }}"></span>
                                            @else
                                                <span class="check text-blue icon-thumbs-o-up transition"
                                                      data-toggleclass="active icon-thumbs-o-up text-blue  icon-thumbs-o-down text-orange"
                                                      data-onpaid="{{ route('admin.transfers.onpaid', ['transfer'=> $transfer->id]) }}"></span>
                                            @endif
                                        </label>
                                    </div>
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
@section('js')
    <script>

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("[data-toggleclass]").click(function () {
                var clicked = $(this);
                var toggle = clicked.data("toggleclass");
                clicked.toggleClass(toggle);
            });

            $("[data-onpaid]").click(function (e) {
                var clicked = $(this);
                var dataset = clicked.data();

                $.post(clicked.data("onpaid"), dataset, function (response) {
                    //reload by error
                    if (response.reload) {
                        window.location.reload();
                    }
                }, "json");
            });



        });
    </script>
@endsection
