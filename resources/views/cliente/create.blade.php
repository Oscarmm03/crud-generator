@extends('layouts.app')

@section('template_title') <!--  Esta sección define el título específico de esta página, que se insertará en la sección 'template_title' de la plantilla principal.-->
    {{ __('Create') }} Cliente
@endsection

@section('content') <!-- Esta sección define el contenido específico de esta página, que se insertará en la sección 'content' de la plantilla principal. -->
    <section class="content container-fluid"> <!-- El contenido de la página está contenido en una sección con una clase de estilo 
                                            'content container-fluid', que generalmente se utiliza para organizar el diseño. -->
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default"> <!-- Se crea una tarjeta con una clase de estilo 'card-default' para contener el formulario de creación. -->
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Cliente</span> <!-- encabezado de la tarjeta con el nombre de cliente -->
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('clientes.store') }}"  role="form" enctype="multipart/form-data"> <!-- Formulario html que utiliza un metodo POST
                                                                                                                                para enviar datos al saervidor, ruta de cliente.store
                                                                                                                            para crear un nuevo cliente.Incluimos el formulario del cliente
                                                                                                                        porque lo tenemos en otro archivo llamado form.blade.php -->
                            @csrf

                            @include('cliente.form') <!-- form.blade.php -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
