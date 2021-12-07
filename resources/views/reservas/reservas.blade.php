<x-layout>
    <div class="flex flex-col items-center mt-4">
    <h1 class="mb-4 text-2xl font-semibold">Reservas</h1>
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
                                asiento
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                                salida
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            precio
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Más información
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            borrar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($reservas as $reserva)
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $reserva->codigo }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $reserva->asiento }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $reserva->salida }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $reserva->precio }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <form action="reservas/{{ $reserva->v_id }}" method="GET">
                                    <input type="hidden" name="asiento" value="{{$reserva->asiento}}">
                                    <input type="submit" value="-->">
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <form action="reservas/{{$reserva->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="BORRAR">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-layout>
