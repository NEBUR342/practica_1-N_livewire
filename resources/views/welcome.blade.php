<x-app-layout>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Autor
                                </th>
                                <th scope="col" wire:click="ordenar('titulo')"
                                    class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Titulo
                                </th>
                                <th scope="col" wire:click="ordenar('descripcion')"
                                    class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Descripcion
                                </th>
                            </tr>
                        </thead>
                        @foreach ($posts as $item)
                            <tbody>
                                <tr class="bg-gray-100 border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $item->titulo }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $item->descripcion }}
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class='mt-2'>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>