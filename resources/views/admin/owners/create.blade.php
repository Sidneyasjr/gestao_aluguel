@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user-plus">Novo Propriétario</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('admin.owners.index') }}">Propriétarios</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('admin.owners.create') }}" class="text-orange">Novo Propriétario</a></li>
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
            </ul>

            <form class="app_form" action="{{ route('admin.owners.store') }}" method="post" enctype="multipart/form-data">
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
                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">*Dia do Repasse:</span>
                                <input type="number" min="1" max="28" name="day_transfer" placeholder="Dia do repasse"
                                       value="{{ old('day_transfer') }}"/>
                            </label>
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
