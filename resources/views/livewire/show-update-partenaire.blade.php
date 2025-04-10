<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
    <div class="mt-4">
        <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Site_url') }}" x-ref="editing.name"
            wire:model.defer="editing.name"  />

        <x-input-error for="editing.name" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Sigle') }}" x-ref="editing.sigle"
            wire:model.defer="editing.sigle"  />

        <x-input-error for="editing.sigle" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Contact') }}" x-ref="editing.contact"
            wire:model.defer="editing.contact"  />

        <x-input-error for="editing.contact" class="mt-2" />
    </div>
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
    <div class="mt-4">
        <label for="editing.image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image_url</label>
       
        <input wire:model="file" type="file" id="file" name="file" class="mt-1 block w-full border border-gray-600" >

        <x-input-error for="editing.image_url" class="mt-2" />
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
