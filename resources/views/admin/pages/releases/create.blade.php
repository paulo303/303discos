@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('releases.index') }}">Releases</a></li>
                    <li class="breadcrumb-item active">Novo Release</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <form action="{{ route('releases.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pages.releases._partials.form')
    </form>
@stop
