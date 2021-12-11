

<x-tabla
:enunciado="$enunciado"
:titulos="array_keys($datos[0])">

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
