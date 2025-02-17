<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
    <div class="mt-4">
        <label for="editing.status"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
        <select id="editing.status" wire:model.defer="editing.status"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="afficher">Afficher</option>
            <option value="masquer">Masquer</option>

        </select>

        <x-input-error for="editing.status" class="mt-2" />
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
