@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Novo Cliente</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="" class="text-orange">Novo Cliente</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="nav">
                @if($errors->all())
                    @foreach($errors->all() as $error)
                        @message(['color' => 'orange'])
                        <p class="icon-asterisk">{{ $error }}</p>
                        @endmessage
                    @endforeach
                @endif
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#realties" class="nav_tabs_item_link">Imóveis</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('admin.customers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="nav_tabs_content">
                        <div id="data">
                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="name" placeholder="Nome Completo" value="{{ old('name') }}"/>
                            </label>
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*E-mail:</span>
                                    <input type="email" name="email" placeholder="Melhor e-mail"
                                           value="{{ old('email') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Telefone:</span>
                                    <input type="tel" name="telephone" class="mask-cell"
                                           placeholder="Número do Telefone com DDD" value="{{ old('telephone') }}"/>
                                </label>
                            </div>

                        </div>
                        <div id="realties" class="d-none">
                            <div class="app_collapse">
                                <div class="app_collapse_header collapse">
                                    <h3>Locador</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div id="realties">
                                        <div class="realty_list">
                                            <div class="realty_list_item mb-1">
                                                <div class="realty_list_item_actions_stats">
                                                    <img src="assets/images/realty.jpeg" alt="">
                                                    <ul>
                                                        <li>Venda: R$ 450.000,00</li>
                                                        <li>Aluguel: R$ 2.000,00</li>
                                                    </ul>
                                                </div>

                                                <div class="realty_list_item_content">
                                                    <h4>Casa Residencial - Campeche</h4>

                                                    <div class="realty_list_item_card">
                                                        <div class="realty_list_item_card_image">
                                                            <span class="icon-realty-location"></span>
                                                        </div>
                                                        <div class="realty_list_item_card_content">
                                                            <span
                                                                class="realty_list_item_description_title">Bairro:</span>
                                                            <span
                                                                class="realty_list_item_description_content">Campeche</span>
                                                        </div>
                                                    </div>

                                                    <div class="realty_list_item_card">
                                                        <div class="realty_list_item_card_image">
                                                            <span class="icon-realty-util-area"></span>
                                                        </div>
                                                        <div class="realty_list_item_card_content">
                                                            <span
                                                                class="realty_list_item_description_title">Área Útil:</span>
                                                            <span class="realty_list_item_description_content">150m&sup2;</span>
                                                        </div>
                                                    </div>

                                                    <div class="realty_list_item_card">
                                                        <div class="realty_list_item_card_image">
                                                            <span class="icon-realty-bed"></span>
                                                        </div>
                                                        <div class="realty_list_item_card_content">
                                                            <span
                                                                class="realty_list_item_description_title">Domitórios:</span>
                                                            <span class="realty_list_item_description_content">4 Quartos<br><span>Sendo 2 suítes</span></span>
                                                        </div>
                                                    </div>

                                                    <div class="realty_list_item_card">
                                                        <div class="realty_list_item_card_image">
                                                            <span class="icon-realty-garage"></span>
                                                        </div>
                                                        <div class="realty_list_item_card_content">
                                                            <span
                                                                class="realty_list_item_description_title">Garagem:</span>
                                                            <span
                                                                class="realty_list_item_description_content">4 Vagas<br><span>Sendo 2 cobertas</span></span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="realty_list_item_actions">
                                                    <ul>
                                                        <li class="icon-eye">1234 Visualizações</li>
                                                    </ul>
                                                    <div>
                                                        <a href="" class="btn btn-blue icon-eye">Visualizar Imóvel</a>
                                                        <a href="" class="btn btn-green icon-pencil-square-o">Editar
                                                            Imóvel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="no-content">Não foram encontrados registros!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse mt-3">
                                <div class="app_collapse_header collapse">
                                    <h3>Locatário</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div id="realties">
                                        <div class="no-content">Não foram encontrados registros!</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
