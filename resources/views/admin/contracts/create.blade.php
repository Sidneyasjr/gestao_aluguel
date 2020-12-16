@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">Cadastrar Novo Contrato</h2>

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
            <div class="nav">
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#parts" class="nav_tabs_item_link active">Dados do Contrato</a>
                    </li>
                </ul>

                <div class="nav_tabs_content">
                    <div id="parts">
                        <form action="{{ route('admin.contracts.store') }}" method="post" class="app_form">
                            @csrf

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Proprietário:</span>
                                    <select class="select2" name="owner"
                                            data-action="{{ route('admin.contracts.getDataOwner') }}">
                                        <option value="0">Informe o Locatário</option>
                                        @foreach($owners as $owner)
                                            <option value="{{ $owner->id }}" {{ (old('owner') == $owner->id ? 'selected' : '') }}>{{ $owner->name }}
                                                ({{ $owner->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="label">
                                    <span class="legend">Locatário:</span>
                                    <select name="customer" class="select2">
                                        <option value="" selected>Informe o Locador</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}
                                                ({{ $customer->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">Imóvel:</span>
                                <select name="property" class="select2" data-action="{{ route('admin.contracts.getDataProperty') }}">
                                    <option value="">Não infromado</option>
                                </select>
                            </label>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Valor de Locação:</span>
                                    <input type="text" name="rent_price" class="mask-money"
                                           placeholder="Valor de Locação" value="{{ old('rent_price') }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Taxa de Administração:</span>
                                    <input type="text" name="adm_fee"  class="mask-percent"
                                           placeholder="Taxa de Administração" value="{{ old('adm_fee') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">IPTU:</span>
                                    <input type="text" name="tribute" class="mask-money" placeholder="IPTU"
                                           value="{{ old('condominium') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Condomínio:</span>
                                    <input type="text" name="condominium" class="mask-money"
                                           placeholder="Valor do Condomínio" value="{{ old('condominium') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Data de Início:</span>
                                    <input type="date" name="start_at"
                                           placeholder="Data de Início"
                                           value="{{ old('start_at') }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Data de Fim:</span>
                                    <input type="date" name="end_at" placeholder="Data de Fim"
                                           value="{{ old('end_at') }}"/>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">Status do Contrato:</span>
                                <select name="status" class="select2">
                                    <option value="pending" {{ (old('status') === 'pending' ? 'selected' : '') }}>Pendente</option>
                                    <option value="active" {{ (old('status') === 'active' ? 'selected' : '') }}>Ativo</option>
                                    <option value="canceled" {{ (old('status') === 'canceled' ? 'selected' : '') }}>Cancelado</option>
                                </select>
                            </label>

                            <div class="text-right mt-2">
                                <button class="btn btn-large btn-green icon-check-square-o">Salvar Contrato</button>
                            </div>
                        </form>
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

            if($('select[name="owner"]').val() != 0) {
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

        });
    </script>
@endsection
