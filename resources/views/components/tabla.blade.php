<div class="flex flex-col items-center mt-4">
    <h1 class="mb-4 text-2xl font-semibold">{{$enunciado}}</h1>
    <div class="border border-gray-200 shadow">
        <table>
            <thead class="bg-gray-50">
                <tr>
                    @foreach ($titulos as $titulo=>$href)
                    <th class="px-6 py-2 text-xs text-gray-500">
                        <a href="{!!$href!!}">
                            {{$titulo}}
                        </a>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white">
                {{ $slot }}
            </tbody>
        </table>
    </div>
    <div class="flex items-center">
        @if (isset($paginado))
        {{ $vuelos->links() }}
        @endif

    </div>
