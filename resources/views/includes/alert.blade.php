@if(!is_null(session('alert')))

<div class="alert alert-primary rounded-0 small m-0 py-2 text-center">
    {{ session('alert') }}
</div>

@endif
@php(session()->forget('alert'))