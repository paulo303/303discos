@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

{{-- Default Content Wrapper --}}
<div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">

    {{-- Content Header --}}
    @hasSection('content_header')
        <div class="content-header">
            <div class="text-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ url('images/logo.png') }}" width="250px" alt="">
                </a>
            </div>

            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                @yield('content_header')
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="content">
        <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @if ($errors->any() || session()->has('message_error'))
                @include('admin/includes/alerts/error')
            @endif

            @if(session()->has('message_info'))
                @include('admin/includes/alerts/info')
            @endif

            @if(session()->has('message_warning'))
                @include('admin/includes/alerts/warning')
            @endif

            @if(session()->has('message_success'))
                @include('admin/includes/alerts/success')
            @endif



            @yield('content')
        </div>
    </div>

</div>
