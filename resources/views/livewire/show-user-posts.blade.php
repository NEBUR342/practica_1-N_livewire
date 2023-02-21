<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div>
                        @livewire('create-post')
                        <input placeholder="Buscar..." type="search" wire:model="buscar" />
                    </div>
                    @if ($posts->count())
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
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Acciones
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
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <button
                                            class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4
                                        border border-yellow-500 hover:border-transparent rounded"
                                            wire:click="editar({{ $item }})">
                                            EDITAR
                                        </button>
                                        <button
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4
                                        border border-red-500 hover:border-transparent rounded"
                                            wire:click="borrar({{ $item }})">
                                            BORRAR
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-2">
            {{ $posts->links() }}
        </div>
        @else
        <p>No se ha encontrado ningun post o no has creado ninguno</p>
        @endif
    </div>
    @if ($post)
        <x-dialog-modal wire:model="openDetalle">
            <x-slot name="title">
                Categoria: {{ $post->categoria }}
            </x-slot>
            <x-slot name="content">
                <div class="flex justify-center">
                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                        <a href="#!">
                            <img class="rounded-t-lg" src="{{ Storage::url($post->imagen) }}" alt="" />
                        </a>
                        <div class="p-6">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">{{ $post->titulo }}</h5>
                            <p class="text-gray-700 text-base mb-4">
                                {{ $post->descripcion }}
                            </p>
                        </div>
                        <div>
                            <p @class([
                                'text-gray-700 text-base mb-4',
                                'bg-green-400' => $post->estado == 'Publicado',
                                'bg-red-400' => $post->estado == 'Borrador',
                            ])>
                                Estado: {{ $post->estado }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-700 text-base mb-4">
                                Precio: {{ $post->precio }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-700 text-base mb-4">
                                Ultima modificacion: {{ $post->updated_at }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <button
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4
                    border border-blue-500 hover:border-transparent rounded"
                    wire:click="$set('openDetalle',false)">
                    Aceptar
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif
    <!------ Ventana modal editar -------->
    @if($post->imagen)
    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            Editar post
        </x-slot>
        <x-slot name="content">
            @wire()
                <x-form-input name="post.titulo" label="Titulo" />
                <x-form-textarea name="post.descripcion" label="Descripcion" placeholder="Pon una descripcion" />
                <x-form-select name="post.categoria" :options="$categorias" label="Categoria" />
                <x-form-group name="estado" label="Estado del post" inline>
                    <x-form-radio name="post.estado" value="Borrador" label="Borrador" />
                    <x-form-radio name="post.estado" value="Publicado" label="Publicado" />
                </x-form-group>
                <x-form-input name="post.precio" label="Precio" placeholder="Pon un precio" />
            @endwire
            <div class="mt-2 relative">
                @if ($imagen)
                    <button wire:click="$set('imagen')"
                        class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cambiar Imagen</button>
                    <img class="object-center object-cover border-lg" src="{{ $imagen->temporaryUrl() }}" />
                @else
                    <img class="object-center object-cover border-lg" src="{{ Storage::url($post->imagen) }}" />
                    <div class="flex h-32 rounded-xl px-2 py-4 justify-center items-center bg-gray-200">
                        <label for="imgEditar"
                            class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Imagen</label>
                    </div>
                @endif
                <input id="imgEditar" type="file" name="imagen" wire:model="imagen" accept="image/*"
                    class="hidden" />
                    @error('imagen')
                    <p class="text-xs text-red-500 mt-2 italic">{{ $message }}</p>
                    @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
            <button
                class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4
                    border border-red-500 hover:border-transparent rounded"
                wire:click="cancelar">
                Cancelar
            </button>
            <button
                class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4
                    border border-green-500 hover:border-transparent rounded"
                wire:click="update">
                Editar
            </button>
        </x-slot>
    </x-dialog-modal>
    @endif
</div>
