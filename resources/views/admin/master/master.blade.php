<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>
    <link rel="icon" type="image/png" href="{{ url(asset('backend/assets/images/favicon.png')) }}"/>

    @hasSection('css')
        @yield('css')
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UpAdmin - Site Control</title>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

@php
    if(!empty(\Illuminate\Support\Facades\Auth::user()->cover) &&
    \Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . \Illuminate\Support\Facades\Auth::user()->cover)){
        $cover = \Illuminate\Support\Facades\Auth::user()->url_cover;
    } else {
        $cover = url(asset('backend/assets/images/avatar.jpg'));
    }
@endphp


<div class="dash">
    <aside class="dash_sidebar">
        <article class="dash_sidebar_user">
            <img class="dash_sidebar_user_thumb" src="{{ $cover }}" alt="" title=""/>

            <h1 class="dash_sidebar_user_name">
                <a href="{{ route('admin.users.edit', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
            </h1>
        </article>

        <ul class="dash_sidebar_nav">
            <li class="dash_sidebar_nav_item {{ isActive('admin.home') }}">
                <a class="icon-tachometer" href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.rents')}} {{ isActive('admin.transfers')}}">
                <a class="icon-calendar-check-o">Gestão</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.rents.index') }}"><a href="{{ route('admin.rents.index') }}">Mensalidades</a>
                    </li>
                    <li class="{{ isActive('admin.transfers.index') }}"><a href="{{ route('admin.transfers.index') }}">Repasses</a>
                    </li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.customers') }}">
                <a class="icon-users">Clientes</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.customers.index') }}"><a href="{{ route('admin.customers.index') }}">Ver
                            Todos</a></li>
                    <li class="{{ isActive('admin.customers.create') }}"><a
                            href="{{ route('admin.customers.create') }}">Criar Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.owners') }}">
                <a class="icon-user-plus">Proprietários</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.owners.index') }}"><a href="{{ route('admin.owners.index') }}">Ver
                            Todos</a></li>
                    <li class="{{ isActive('admin.owners.create') }}"><a href="{{ route('admin.owners.create') }}">Criar
                            Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.properties') }}"><a class="icon-home">Imóveis</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.properties.index') }}"><a
                            href="{{ route('admin.properties.index') }}">Ver Todos</a></li>
                    <li class="{{ isActive('admin.properties.create') }}"><a
                            href="{{ route('admin.properties.create') }}">Criar Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.contracts') }}"><a class="icon-file-text">Contratos</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.contracts.index') }}"><a href="{{ route('admin.contracts.index') }}">Ver
                            Todos</a></li>
                    <li class="{{ isActive('admin.contracts.create') }}"><a
                            href="{{ route('admin.contracts.create') }}">Criar Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.users') }}">
                <a class="icon-user-times">Usuários</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.users.index') }}"><a href="{{ route('admin.users.index') }}">Ver
                            Todos</a></li>
                    <li class="{{ isActive('admin.users.create') }}"><a href="{{ route('admin.users.create') }}">Criar
                            Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item"><a class="icon-sign-out on_mobile" href="{{ route('admin.logout') }}"
                                                 target="_blank">Sair</a></li>
        </ul>

    </aside>

    <section class="dash_content">

        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <h1 class="transition">
                        <i class="icon-imob text-orange"></i><a href="">S A <b>Imóveis - Gestão de Alugueis</b></a>
                    </h1>
                    <div class="dash_userbar_box_bar no_mobile">
                        <a class="text-red icon-sign-out" href="{{ route('admin.logout') }}">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash_content_box">
            @yield('content')
        </div>
    </section>
</div>


<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/libs.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/scripts.js')) }}"></script>

@hasSection('js')
    @yield('js')
@endif

</body>
</html>
