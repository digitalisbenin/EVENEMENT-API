<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
    <div class="mt-4">
        <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Nom') }}" 
            wire:model.defer="editing.name" />
        <x-input-error for="editing.name" class="mt-2" />
    </div>

    {{-- <div class="mt-4">
        <select class="block p-2.5 w-full text-lg text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
            wire:model.defer="editing.description">
            <option value="1">Ligne 1</option>
            <option value="2">Ligne 2</option>
        </select>
        <x-input-error for="editing.description" class="mt-2" />
    </div> --}}
    <div class="mt-4">
        <label for="editing.status"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
        <select id="editing.status" wire:model.defer="editing.status"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Selectionnez la ligne</option>
            <option value="valider">Ligne 1</option>
            <option value="terminer">Ligne 2</option>

        </select>

        <x-input-error for="editing.status" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('Date début') }}" 
            wire:model.defer="editing.date_debuit"  />
        <x-input-error for="editing.date_debuit" class="mt-2" />
    </div>

    

    <div class="mt-4">
        <label for="file" class="block mb-2 text-sm font-medium text-gray-900">Image URL</label>
        <input wire:model="file" type="file" id="file" class="mt-1 block w-full border border-gray-600">
        <x-input-error for="editing.image_url" class="mt-2" />
    </div>

  

    <div class="mt-4">
        <x-input type="number" class="mt-1 block w-full" placeholder="{{ __('Nombre de jour') }}" 
            wire:model.defer="editing.nombre_jour" wire:change="updateDateFin" />
        <x-input-error for="editing.nombre_jour" class="mt-2" />
    </div>
    <div class="modal-footer mt-4">
        <button style="background-color: red;"
        class=" text-black font-bold py-2 px-3 w-lg:w-full w-80 rounded focus:outline-none focus:shadow-outline"
        wire:click="$set('showEditModal', false)" wire:loading.attr="disabled">{{ __('Annuler') }}</button>
        <button 
                style="background-color: green;"
        class=" hover:bg-blue-700 text-white font-bold py-2 px-3 w-lg:w-full w-80 rounded focus:outline-none focus:shadow-outline"
        wire:click="save" wire:loading.attr="disabled">{{ __('Enregistrer') }}</button>
    </div>
</div>
