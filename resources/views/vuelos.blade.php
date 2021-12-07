<x-layout>
    <div class="flex flex-col items-center mt-4">
        <h1 class="mb-4 text-2xl font-semibold">Vuelos</h1>
        <div class="border border-gray-200 shadow">
            <table>
                <thead class="bg-gray-50">
                    <tr>

                        <th class="px-6 py-2 text-xs text-gray-500">
                            <a href="">
                                Codigo del vuelo
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            <a href="">
                                origen
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                                destino
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                                compañia
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            salida
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                                llegada
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            asientos
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            precio
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            reserva
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
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
                                    {{ $vuelo->llegada }}
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
                            @php
                                //cambiar para que use el pmetodo de la clase reservar asientosOcupados($id)
                                $reservado = App\Http\Controllers\ReservasController::asientosOcupados($vuelo->id);

                            @endphp
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <form action="vuelos/{{$vuelo->id}}" method="POST">
                                        @csrf
                                        <label for="asiento">nº asiento</label>
                                        <select name="asiento" id="asiento">
                                            @for ($x = 1;$x <= $vuelo->asientos;$x++)
                                                @if (!in_array($x, $reservado))
                                                    <option value="{{$x}}">{{$x}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        <input type="submit" value="Reservar">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center">
            {{ $vuelos->links() }}

        </div>
</x-layout>
