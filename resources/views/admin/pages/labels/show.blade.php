@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('labels.index') }}">Selos</a></li>
                    <li class="breadcrumb-item active">{{ $label->name }}</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-md-6 col-lg-6 col-xl-4 text-center">
                <h1>
                    {{ $label->name }}
                </h1>
                @if ($label->logo)
                    <p>
                        <a href="{{ url("storage/{$label->logo}") }}" target="_blank">
                            <img src="{{ url("storage/{$label->logo}") }}" alt="{{ $label->name }}" width="250">
                        </a>
                    </p>
                @else
                    <p>
                        <img src="{{ url('images/no-image.jpg') }}" alt="{{ $label->name }}" width="250">
                    </p>
                @endif

                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <b>Releases cadastrados</b> <a class="float-right">{{ $label->releases->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Pedidos feitos</b> <a class="float-right">0</a>
                    </li>
                </ul>
                <a href="{{ route('labels.edit', $label->url) }}" class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
        </div>
    </div>
@stop
