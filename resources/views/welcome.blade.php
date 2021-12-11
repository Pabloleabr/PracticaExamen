<x-layout>
    @php
        $link = e("&campo1=" . old('campo1') . "&campo2=" . old('campo2'));
        $orden= '/?orden=';
    @endphp
    <x-tabla
    :enunciado="'titulo'"
    :titulos="['titulo1'=>$orden . 'campo1' . $link, 'titulo2'=>$orden . 'campo2' . $link,
    'titulo3'=>'#']">

    </x-tabla>
   {{--  <x-tablaBasica
    :enunciado="'titulo'"
    :datos="[['titulo1'=>1,'titulo2'=>2]]">

    </x-tablaBasica> --}}
</x-layout>
