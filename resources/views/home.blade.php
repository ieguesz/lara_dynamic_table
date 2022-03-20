@extends('layouts.template')
@section('content')
<?php
//HTML_FROM_REGISTRAR : Formulario para registrar.
//HTML_FROM_FILTRAR : Formulario para filtrar.
//HTML_FROM_ACTUALIZAR : Formulario para actualizar.
//HTML_FROM_CAMBIO_ESTADO : Formulario para cambiar estado.
//HTML_VER_DATOS : Permite ver datos x.
//HTML_LISTA_DATOS : Permite ver todos los datos.
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Principal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Principal</a></li>
                    {{-- <li class="breadcrumb-item active">Categorías</li> --}}
                </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        @if(session()->has('correcto'))
            <div class="alert alert-success">
                {{ session()->get('correcto') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header no-print">

                    </div>
                    <?php
                    //HTML_LISTA_DATOS : Permite ver todos los datos.
                    ?>
                    <div class="card-body">
                        <div class="well well-sm">

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
@endsection
