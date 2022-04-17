@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('releases.index') }}">Releases</a></li>
                    <li class="breadcrumb-item active">{{ $release->cat_num }}</li>
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
                    {{ $release->label->name }}
                </h1>
                <h4>
                    Release Number: {{ $release->release_num }}
                </h4>
                <h4>
                    Cat Number: {{ $release->cat_num }}
                </h4>
                @if ($release->image)
                    <a href="{{ url("{$release->image}") }}" target="_blank">
                        <img src="{{ url("{$release->image}") }}" alt="{{ $release->cat_num }}" width="250">
                    </a>
                @else
                    <img src="{{ url("images/no-image.jpg") }}" alt="{{ $release->cat_num }}" width="250">
                @endif

            </div>
        </div>
    </div>
@stop
