@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Novo Cliente</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.customers.index') }}">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.customers.create') }}" class="text-orange">Novo Cliente</a></li>
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

                @if(session()->exists('message'))
                    @message(['color' => session()->get('color')])
                    <p class="icon-asterisk">{{ session()->get('message') }}</p>
                    @endmessage
                @endif
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#realties" class="nav_tabs_item_link">Imóveis</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('admin.customers.update', ['customer' => $customer->id]) }}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nav_tabs_content">
                        <div id="data">
                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="name" placeholder="Nome Completo"
                                       value="{{ old('name') ?? $customer->name }}"/>
                            </label>
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*E-mail:</span>
                                    <input type="email" name="email" placeholder="Melhor e-mail"
                                           value="{{ old('email') ?? $customer->email }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Telefone:</span>
                                    <input type="tel" name="telephone" class="mask-cell"
                                           placeholder="Número do Telefonce com DDD"
                                           value="{{ old('telephone') ?? $customer->telephone }}"/>
                                </label>
                            </div>

                        </div>
                        <div id="realties" class="d-none">

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
