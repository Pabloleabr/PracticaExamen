<x-layout>
    @php
        $link = e("&codio=" . old('codigo') . "&origen=" . old('origen') . "&destino=" . old('destino')
        . "&compania=" . old('compania') . "&salida=" . old('salida') . "&asientos=" . old('asientos')
        . "&precio=" . old('precio'));
        $orden= '/?orden=';

        $titulos= ['codigo'=>$orden . 'codigo' . $link, 'origen'=>$orden . 'origen' . $link,
                    'destino'=>$orden . 'destino' . $link, 'compania'=>$orden . 'compania' . $link,
                    'salida'=>$orden . 'salida' . $link, 'asientos'=>$orden . 'asientos' . $link,
                    'precio'=>$orden . 'precio' . $link];
    @endphp
    <form action="/?orden={{old('orden')}}{!!$link!!}" method="get" class=" flex flex-wrap gap-2">
        @foreach (array_keys($titulos)  as $titulo)
            <div>
                <label for="{{$titulo}}">{{$titulo}}</label>
                <input type="text" name="{{$titulo}}" class="border">
            </div>
        @endforeach
        <input type="submit" value="buscar">
    </form>

    <x-tabla
    :enunciado="'Vuelos'"
    :titulos="$titulos">

    @foreach ($vuelos as $vuelo)
    <tr class="whitespace-nowrap">

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->codigo }}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->origen }}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->destino }}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->compania }}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->salida }}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->asientos }}
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ $vuelo->precio }}
            </div>
        </td>

    </tr>
    @endforeach
    </x-tabla>

    <div class="flex items-center">
        {{ $vuelos->links() }}
    </div>

   {{--  <x-tablaBasica
    :enunciado="'titulo'"
    :datos="[['titulo1'=>1,'titulo2'=>2]]">

    </x-tablaBasica> --}}
</x-layout>
