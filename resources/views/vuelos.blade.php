<x-layout>
    @php
        //obtengo todos los links para el buscador atraves de las claves
        $link='';
        foreach ($vuelos[0] as $key => $value) {
            $link .= '&' . $key . '=' . old($key);
        }
        $link = e($link);
        //consigo los titulos con sus links para ordenar atraves de las claves
        $titulos= [];
        foreach ($vuelos[0] as $key => $value) {
            $titulos[$key] = '/?orden=' . $key . $link;
        }
    @endphp
    {{--Creo el formulario de busuedas con cada campo cogido de los titulos--}}
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
    {{--creo todos los datos con dos for que me sacan todos los datos de la consulta--}}
    @foreach ($vuelos as $vuelo)
    <tr class="whitespace-nowrap">
        @foreach ($vuelo as $campo)
        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{$campo}}
            </div>
        </td>
        @endforeach
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
