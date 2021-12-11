
@php
    $titulos = array_keys($datos[0]);
    $tit = [];
    foreach ($titulos as $value) {
        $tit[$value] ='#';
    }
@endphp

<x-tabla
:enunciado="$enunciado"
:titulos="$tit">

@foreach ($datos as $dato)
    <tr class="whitespace-nowrap">
        @foreach ($dato as $elemento)
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $elemento }}
            </div>
        </td>
        @endforeach
    </tr>
@endforeach

</x-tabla>
