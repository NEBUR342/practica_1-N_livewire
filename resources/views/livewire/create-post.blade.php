<div>
    <button
        class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        wire:click="$set('openCrear',true)">
        Nuevo
    </button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear post
        </x-slot>
        <x-slot name="content">
            @wire('defer')
                <x-form-input name="titulo" label="Titulo" />
                <x-form-textarea name="descripcion" label="Descripcion" placeholder="Pon una descripcion" />
                <x-form-select name="categoria" :options="$categorias" label="Categoria" />
                <x-form-group name="estado" label="Estado del post" inline>
                    <x-form-radio name="estado" value="Borrador" label="Borrador" />
                    <x-form-radio name="estado" value="Publicado" label="Publicado" />
                </x-form-group>
                <x-form-input name="precio" label="Precio" placeholder="Pon un precio" />
            @endwire
            <div class="mt-2 relative">
                @if ($imagen)
                    <button wire:click="$set('imagen')"
                        class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cambiar Imagen</button>
                    <img class="object-center object-cover border-lg" src="{{ $imagen->temporaryUrl() }}" />
                @else
                    <div class="flex h-32 rounded-xl px-2 py-4 justify-center items-center bg-gray-200">
                        <label for="imgCrear"
                            class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Imagen</label>
                    </div>
                @endif
                <input id="imgCrear" type="file" name="imagen" wire:model="imagen" accept="image/*"
                    class="hidden" />
                    @error('imagen')
                    <p class="text-xs text-red-500 mt-2 italic">{{$message}}</p>
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
                wire:click="guardar">
                Aceptar
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
