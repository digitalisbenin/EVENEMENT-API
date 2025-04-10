
<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
    <div class="flex items-center justify-between pb-4">

        <label for="table-search" class="sr-only">Rechercher</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search" wire:model="search"
                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Rechercher ...">
        </div>
        <div>
            <button wire:click="create" type="button"
                class="inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg
                    class="w-[14px] h-[14px] text-white dark:text-white mt-1 mr-2" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        d="M9 1v16M1 9h16" />
                </svg>Ajouter</button>
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Intitule
                </th>
                <th scope="col" class="px-6 py-3">
                    Ligne
                </th>
                
                <th scope="col" class="px-6 py-3">
                    Nombre de jour
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($publictes as $publicte)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">
                            <img 
                                src="{{ $publicte->image }}" 
                                alt="{{ $publicte->name }}" 
                                class="w-24 h-24  mr-3"
                            />

                        </div>
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $publicte->name }}
                    </th>
                    @if ($publicte->status === 'valider')
                    <td class="px-6 py-4">
                       Ligne 1
                    </td>
                    @endif
                    @if ($publicte->status === 'terminer')
                    <td class="px-6 py-4">
                       Ligne 2
                    </td>
                    @endif
                    <td class="px-6 py-4">
                        {{ $publicte->nombre_jour }}
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-3">
                        <a href="/show-publicite-update/{{ $publicte->id }}"  wire:loading.attr="disabled"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
                        <a href="#" wire:click="delete({{ $publicte }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Delete Confirmation Modal -->
    <x-dialog-modal wire:model="showDeleteModal" maxWidth="md">
        <x-slot name="title">
            {{ $action }}
        </x-slot>

        <x-slot name="content">
            <div class="p-6 text-center h-9">
                <svg class="mx-auto mb-4 text-gray-400 w-9 h-9 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ __('Êtes-vous sûr que vous souhaitez supprimer? Cette action est irréversible.') }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showDeleteModal', false)" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteSelected" wire:loading.attr="disabled">
                {{ __('Supprimer') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <div>
        <x-dialog-modal wire:model="showEditModal" maxWidth="2xl">
            <x-slot name="title">
                {{ $action }}
            </x-slot>
    
            <x-slot name="content">
                <div class="mt-4">
                    <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Nom') }}" 
                        wire:model.defer="editing.name" />
                    <x-input-error for="editing.name" class="mt-2" />
                </div>
    
                {{-- <div class="mt-4">
                    <x-input type="text" rows="4" class="block p-2.5 w-full text-lg text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="{{ __('Affichage 1 pour ligne1 et 2 pour ligne2') }}" wire:model.defer="editing.description"/>
                    <x-input-error for="editing.description" class="mt-2" />
                    
                </div> --}}
                <div class="mt-4">
                    <label for="editing.status"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ligne</label>
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
                        wire:model.defer="editing.date_debuit" wire:change="updateDateFin" />
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
            </x-slot>
    
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('showEditModal', false)" wire:loading.attr="disabled">
                    {{ __('Annuler') }}
                </x-secondary-button>
    
                <x-danger-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Enregistrer') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
    
</div>