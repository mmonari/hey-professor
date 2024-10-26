@props([
    'action' => null,
    'put' => null,
    'patch' => null,
    'delete' => null,
])
<form method="POST" action="{{ $action }}">

    @csrf

    @if ($put)
        @method('PUT')
    @elseif ($patch)
        @method('PATCH')
    @elseif ($delete)
        @method('DELETE')
    @endif

    {{ $slot }}
    
</form>