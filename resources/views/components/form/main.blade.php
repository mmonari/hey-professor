@props([
    'action' => null,
    'put' => null,
    'patch' => null,
    'delete' => null,
    'verb' => null,
])
<form method="POST" action="{{ $action }}">

    @csrf

    @if($verb)
        @method($verb)
    @else
        @if ($put)
            @method('PUT')
        @elseif ($patch)
            @method('PATCH')
        @elseif ($delete)
            @method('DELETE')
        @endif
    @endif

    

    {{ $slot }}
    
</form>