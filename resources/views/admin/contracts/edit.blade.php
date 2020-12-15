@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-file-text">Editar Contrato</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.contracts.index') }}">Contratos</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.contracts.create') }}" class="text-orange">Cadastrar Contrato</a>
                        </li>
                    </ul>
                </nav>

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
            <div class="nav">
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#parts" class="nav_tabs_item_link active">Dados do Contrato</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#month_pay" class="nav_tabs_item_link">Mensalidades</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#transfer" class="nav_tabs_item_link">Repasses</a>
                    </li>
                </ul>

                <div class="nav_tabs_content">
                    <div id="parts">
                        <form action="{{ route('admin.contracts.update', ['contract' => $contract->id]) }}"
                              method="post" class="app_form">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="property_persist"
                                   value="{{ old('property') ?? $contract->property }}">

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Proprietário:</span>
                                    <select class="select2" name="owner"
                                            data-action="{{ route('admin.contracts.getDataOwner') }}">
                                        <option value="">Informe o Locatário</option>
                                        @foreach($owners as $owner)
                                            <option value="{{ $owner->id }}"
                                                {{ (old('owner') == $owner->id ? 'selected' : ($contract->owner == $owner->id ? 'selected' : '')) }}>
                                                {{ $owner->name }} ({{ $owner->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="label">
                                    <span class="legend">Locatário:</span>
                                    <select name="customer" class="select2">
                                        <option value="" selected>Informe o Locador</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ (old('customer') == $customer->id ? 'selected' : ($contract->customer == $customer->id ? 'selected' : '')) }}>
                                                {{ $customer->name }}
                                                ({{ $customer->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">Imóvel:</span>
                                <select name="property" class="select2"
                                        data-action="{{ route('admin.contracts.getDataProperty') }}">
                                    <option value="">Não informado</option>
                                </select>
                            </label>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Valor de Locação:</span>
                                    <input type="text" name="rent_price" class="mask-money"
                                           placeholder="Valor de Locação"
                                           value="{{ old('rent_price') ?? $contract->rent_price }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Taxa de Administração:</span>
                                    <input type="tel" name="adm_fee" class="mask-money"
                                           placeholder="Valor da taxa de Administração"
                                           value="{{ old('adm_fee') ?? $contract->adm_fee }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">IPTU:</span>
                                    <input type="text" name="tribute" class="mask-money" placeholder="IPTU"
                                           value="{{ old('tribute') ?? $contract->tribute }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Condomínio:</span>
                                    <input type="text" name="condominium" class="mask-money"
                                           placeholder="Valor do Condomínio"
                                           value="{{ old('condominium') ?? $contract->condominium }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Data de Início:</span>
                                    <input type="date" name="start_at"
                                           placeholder="Data de Início"
                                           value="{{ old('start_at') ?? $contract->start_at }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Data de Fim:</span>
                                    <input type="date" name="end_at" placeholder="Data de Fim"
                                           value="{{ old('end_at') ?? $contract->end_at }}"/>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">Status do Contrato:</span>
                                <select name="status" class="select2">
                                    <option
                                        value="pending" {{ (old('status') === 'pending' ? 'selected' : ($contract->status === 'pending' ? 'selected' : '')) }}>
                                        Pendente
                                    </option>
                                    <option
                                        value="active" {{ (old('status') === 'active' ? 'selected' : ($contract->status === 'active' ? 'selected' : '')) }}>
                                        Ativo
                                    </option>
                                    <option
                                        value="canceled" {{ (old('status') === 'canceled' ? 'selected' : ($contract->status === 'canceled' ? 'selected' : '')) }}>
                                        Cancelado
                                    </option>
                                </select>
                            </label>

                            <div class="text-right mt-2">
                                <button class="btn btn-large btn-green icon-check-square-o">Salvar Contrato</button>
                            </div>
                        </form>
                    </div>
                    <div id="month_pay" class="d-none">
                        <table id="dataTable2" class="nowrap stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Parcela</th>
                                <th>Locador</th>
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
                                           class="text-orange">R$ {{ $rent->value }}</td>
                                    <td><a href="{{ route('admin.rents.index') }}"
                                           class="text-orange">{{ date('d/m/Y', strtotime($rent->due_at)) }}</td>
                                    <td>
                                        <div id="content">
                                            <label class="label">
                                                <form action="{{ route('admin.rents.update', ['rent'=> $rent->id]) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    @if($rent->status == 'unpaid')
                                                        <input class="status status-orange" type="submit" value=""
                                                               data-toggleclass="status-green status-orange">
                                                    @else
                                                        <input class="status status-green" type="submit" value=""
                                                               data-toggleclass="status-green status-orange">
                                                    @endif
                                                </form>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="transfer" class="d-none">
                        <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Parcela</th>
                                <th>Locatário</th>
                                <th>Valor</th>
                                <th>Data do Repasse</th>
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
                                           class="text-orange">R$ {{ $transfer->value }}</td>
                                    <td><a href="{{ route('admin.transfers.index') }}"
                                           class="text-orange">{{ date('d/m/Y', strtotime($transfer->due_at)) }}</td>
                                    <td>
                                        <div id="content">
                                            <label class="label">
                                                <form action="{{ route('admin.transfers.update', ['transfer'=> $transfer->id]) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    @if($transfer->status == 'unpaid')
                                                        <input class="status status-orange" type="submit" value=""
                                                               data-toggleclass="status-green status-orange">
                                                    @else
                                                        <input class="status status-green" type="submit" value=""
                                                               data-toggleclass="status-green status-orange">
                                                    @endif
                                                </form>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('js')
    <script>

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function setFieldOwner(response) {
                // Properties
                $('select[name="property"]').html('');
                if (response.properties != null && response.properties.length) {
                    $('select[name="property"]').append($('<option>', {
                        value: 0,
                        text: 'Não informar'
                    }));

                    $.each(response.properties, function (key, value) {
                        $('select[name="property"]').append($('<option>', {
                            value: value.id,
                            text: value.description,
                            selected: ($('input[name="property_persist"]').val() != 0 && $('input[name="property_persist"]').val() == value.id ? 'selected' : false)
                        }));
                    });

                } else {
                    $('select[name="property"]').append($('<option>', {
                        value: 0,
                        text: 'Não informado'
                    }));
                }
            }


            $('select[name="owner"]').change(function () {
                var owner = $(this);
                $.post(owner.data('action'), {owner: owner.val()}, function (response) {
                    setFieldOwner(response);
                }, 'json');
            });

            if ($('select[name="owner"]').val() != 0) {
                var owner = $('select[name="owner"]');
                $.post(owner.data('action'), {owner: owner.val()}, function (response) {
                    setFieldOwner(response);
                }, 'json');
            }


            $('select[name="property"]').change(function () {
                var property = $(this);
                $.post(property.data('action'), {property: property.val()}, function (response) {
                    setFieldProperty(response);
                }, 'json');
            });

            $("form:not('.ajax_off')").submit(function (e) {
                e.preventDefault();
                var form = $(this);


                form.ajaxSubmit({
                    url: form.attr("action"),
                    type: "POST",
                    success: function () {

                    },

                });
            });

            $("[data-toggleclass]").click(function () {
                var clicked = $(this);
                var toggle = clicked.data("toggleclass");
                clicked.toggleClass(toggle);
            });


        });
    </script>
@endsection
