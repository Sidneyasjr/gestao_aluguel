@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-home">Editar cadastro do Imóvel</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.properties.index') }}">Imóveis</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.properties.create') }}" class="text-orange">Cadastrar Imóvel</a>
                        </li>
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
                </ul>

                <form action="{{ route('admin.properties.update', ['property' => $property]) }}" method="post" class="app_form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nav_tabs_content">
                        <div id="data">
                            <label class="label">
                                <span class="legend">Proprietário:</span>
                                <select name="owner" class="select2">
                                    <option value="">Selecione o proprietário</option>
                                    @foreach($owners as $owner)
                                        <option
                                            value="{{ $owner->id }}" {{ ($owner->id === $property->owner ? 'selected' : '') }}>{{ $owner->name }}
                                            ({{ $owner->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </label>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Status:</span>
                                    <select name="status" class="select">
                                        <option value="1" {{ (old('status') == '1' ? 'selected' : ($property->status == true ? 'selected' : '')) }}>Disponível</option>
                                        <option value="0" {{ (old('status') == '0' ? 'selected' : ($property->status == false ? 'selected' : '')) }}>Indisponível</option>
                                    </select>
                                </label>
                                <label class="label">
                                    <span class="legend">CEP:</span>
                                    <input type="text" name="zipcode" class="zip_code_search" placeholder="Digite o CEP"
                                           value="{{ old('zipcode') ?? $property->zipcode }}"/>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">Endereço:</span>
                                <input type="text" name="street" class="street" placeholder="Endereço Completo"
                                       value="{{ old('street') ?? $property->street }}"/>
                            </label>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Número:</span>
                                    <input type="text" name="number" placeholder="Número do Endereço"
                                           value="{{ old('number') ?? $property->number }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Complemento:</span>
                                    <input type="text" name="complement" placeholder="Completo (Opcional)"
                                           value="{{ old('complement') ?? $property->complement }}"/>
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">Bairro:</span>
                                <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro"
                                       value="{{ old('neighborhood') ?? $property->neighborhood }}"/>
                            </label>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Estado:</span>
                                    <input type="text" name="state" class="state" placeholder="Estado"
                                           value="{{ old('state') ?? $property->state }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Cidade:</span>
                                    <input type="text" name="city" class="city" placeholder="Cidade"
                                           value="{{ old('city') ?? $property->city}}"/>
                                </label>
                            </div>


                        </div>

                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o">Atualizar Imóvel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
