<x-app-layout>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Info
                                </th>
                                <th scope="col" wire:click="ordenar('titulo')"
                                    class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Titulo
                                </th>
                                <th scope="col" wire:click="ordenar('descripcion')"
                                    class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Descripcion
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        @foreach ($posts as $item)
                            <tbody>
                                <tr class="bg-gray-100 border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <button
                                            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4
                                        border border-blue-500 hover:border-transparent rounded"
                                            wire:click="detalle({{ $item }})">
                                            INFO
                                        </button>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $item->titulo }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $item->descripcion }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $item->estado }}
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>