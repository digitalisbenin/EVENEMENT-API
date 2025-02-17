<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
    <div class="flex items-center justify-between pb-4">
        <!-- Boutons pour filtrer les statuts -->
        <div class="flex space-x-4">
            <button wire:click="filterStatus('all')" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Tous
            </button>
            <button wire:click="filterStatus('valider')" class="ml-4 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800" style="background-color: green;">
                Valider
            </button>
            <button wire:click="filterStatus('En attente')" class="ml-4 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800" style="background-color: rgb(190, 166, 7);">
                En Attente
            </button>
            <button wire:click="filterStatus('rejeter')" class="ml-4 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                Rejeter
            </button>
        </div>
    
        <div>
            <a href="/show-create-demande" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-[14px] h-[14px] text-white dark:text-white mt-1 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 1v16M1 9h16" />
                </svg>
                Ajouter
            </a>
        </div>
    </div>
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-1 py-3">
                 Vue
                </th>
                <th scope="col" class="px-2 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3">
                    Prix
                </th>
                <th scope="col" class="px-6 py-3">
                    Date debuit
                </th>
                {{-- <th scope="col" class="px-6 py-3">
                    Date fin
                </th> --}}
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($demandes->when($statusFilter, function ($query) use ($statusFilter) {
                return $query->where('status', $statusFilter);
            })->sortByDesc('created_at') as $demande)
                
                @if ($demande->status === 'rejeter')
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" style="background-color: rgb(244, 102, 102);">
                    <th scope="row" class="px-1 font-medium  whitespace-nowrap text-white">
                        {{ $demande->vue->count() }}
                    </th>
                    <th scope="row" class="px-2 py-4 font-medium whitespace-nowrap dark:text-white">
                        <span class="text-gray-900">{{ $demande->status }}</span>
                    </th>
    
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $demande->name }}
                    </th>
    
                    <td class="px-6 py-4">
                        {{ $demande->montant }}
                    </td>
    
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $demande->date_debuit }}
                    </th>
    
                    
    
                    <td class="flex items-center px-6 py-4 space-x-3">
                        <a href="#" wire:click="valide({{ $demande }})" wire:loading.attr="disabled" class="font-medium text-green-600 dark:text-green-500 hover:underline">
                            Valider
                        </a>
    
                        <div class="flex items-center">
                            <input type="checkbox" wire:click="editune({{ $demande }})" wire:loading.attr="disabled"
                                class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out"
                                @if ($demande->priorite == 1) checked @endif>
                            <label for="edit-{{ $demande->id }}" class="ml-2 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                A la une
                            </label>
                        </div>
    
                        <a href="#" wire:click="editrej({{ $demande }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-green-500 hover:underline">Rejeter</a>
    
                            <a href="/show-demande-update/{{ $demande->id }}" 
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
    
                        <a href="#" wire:click="delete({{ $demande }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                    </td>
                </tr>
                @endif
                @if ($demande->status === 'valider')
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" style="background-color: rgb(89, 244, 59);">
                    <th scope="row" class="px-1 font-medium  whitespace-nowrap text-white">
                        {{ $demande->vue->count() }}
                    </th>
                    <th scope="row" class="px-2 py-4 font-medium whitespace-nowrap dark:text-white">
                        <span class="text-gray-900">{{ $demande->status }}</span>
                    </th>
                   
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $demande->name }}
                    </th>
    
                    <td class="px-6 py-4">
                        {{ $demande->montant }}
                    </td>
    
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $demande->date_debuit }}
                    </th>
    
                    
    
                    <td class="flex items-center px-6 py-4 space-x-3">
                        <a href="#" wire:click="valide({{ $demande }})" wire:loading.attr="disabled" class="font-medium text-green-600 dark:text-green-500 hover:underline">
                            Valider
                        </a>
    
                        <div class="flex items-center">
                            <input type="checkbox" wire:click="editune({{ $demande }})" wire:loading.attr="disabled"
                                class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out"
                                @if ($demande->priorite == 1) checked @endif>
                            <label for="edit-{{ $demande->id }}" class="ml-2 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                A la une
                            </label>
                        </div>
    
                        <a href="#" wire:click="editrej({{ $demande }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-green-500 hover:underline">Rejeter</a>
    
                            <a href="/show-demande-update/{{ $demande->id }}" 
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
    
                        <a href="#" wire:click="delete({{ $demande }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                    </td>
                </tr>
                @endif
                @if ($demande->status === 'En attente')
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" style="background-color: rgb(247, 227, 51);">
                    <th scope="row" class="px-1 font-medium  whitespace-nowrap text-white">
                        {{ $demande->vue->count() }}
                    </th>
                    <th scope="row" class="px-2 py-4 font-medium whitespace-nowrap dark:text-white">
                        <span class="text-gray-900">{{ $demande->status }}</span>
                    </th>
    
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $demande->name }}
                    </th>
    
                    <td class="px-6 py-4">
                        {{ $demande->montant }}
                    </td>
    
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $demande->date_debuit }}
                    </th>
    
                    
    
                    <td class="flex items-center px-6 py-4 space-x-3">
                        <a href="#" wire:click="valide({{ $demande }})" wire:loading.attr="disabled" class="font-medium text-green-600 dark:text-green-500 hover:underline">
                            Valider
                        </a>
    
                        <div class="flex items-center">
                            <input type="checkbox" wire:click="editune({{ $demande }})" wire:loading.attr="disabled"
                                class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out"
                                @if ($demande->priorite == 1) checked @endif>
                            <label for="edit-{{ $demande->id }}" class="ml-2 font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                A la une
                            </label>
                        </div>
    
                        <a href="#" wire:click="editrej({{ $demande }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-green-500 hover:underline">Rejeter</a>
    
                        <a href="/show-demande-update/{{ $demande->id }}" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
    
                        <a href="#" wire:click="delete({{ $demande }})" wire:loading.attr="disabled"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                    </td>
                </tr>
                @endif
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
                <svg class="mx-auto mb-4 text-gray-400 w-6 h-6 dark:text-gray-200" aria-hidden="true"
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
    <x-dialog-modal wire:model="showValideteModal" maxWidth="2xl">
        <x-slot name="title">
            {{ $action }}
        </x-slot>

        <x-slot name="content">




            <div class="mt-4">
                <label for="editing.status"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="editing.status" wire:model.defer="editing.status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="valider" selected>Valider</option>
                    <option value="En attente">En attente</option>

                </select>

                <x-input-error for="editing.status" class="mt-2" />
            </div>



        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showValideteModal', false)" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Enregistrer') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    <x-dialog-modal wire:model="showEditModalRejeter" maxWidth="2xl">
        <x-slot name="title">
            {{ $action }}
        </x-slot>

        <x-slot name="content">




            <div class="mt-4">
                <label for="editing.status"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="editing.status" wire:model.defer="editing.status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="rejeter" selected>Rejeter</option>
                    <option value="En attente">En attente</option>

                </select>

                <x-input-error for="editing.status" class="mt-2" />
            </div>



        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModalRejeter', false)" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Enregistrer') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    <x-dialog-modal wire:model="showEditModalUne" maxWidth="2xl">
        <x-slot name="title">
            {{ $action }}
        </x-slot>

        <x-slot name="content">



            <div class="mt-4">
                <label for="media-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    A la une
                </label>

                <div id="media-type" class="flex flex-col space-y-2">
                    <!-- Checkbox for Image -->
                    <div class="flex items-center">
                        <input type="radio" id="media-image" name="media-type" value="0"
                            wire:model.defer="editing.priorite"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
                        <label for="media-image" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Non
                        </label>
                    </div>

                    <!-- Checkbox for Video -->
                    <div class="flex items-center">
                        <input type="radio" id="media-video" name="media-type" value="1"
                            wire:model.defer="editing.priorite"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
                        <label for="media-video" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Oui
                        </label>
                    </div>
                </div>

                <x-input-error for="editing.is_correct" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModalUne', false)" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3 bg-green-500" wire:click="save" wire:loading.attr="disabled">
                {{ __('Enregistrer') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    {{-- <x-dialog-modal wire:model="showEditModal" maxWidth="2xl">
        <x-slot name="title">
            {{ $action }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Nom') }}" x-ref="editing.name"
                    wire:model.defer="editing.name"  />
        
                <x-input-error for="editing.name" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Description') }}" x-ref="editing.description"
                    wire:model.defer="editing.description"  />
        
                <x-input-error for="editing.description" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Telephone') }}" x-ref="editing.telephone"
                    wire:model.defer="editing.telephone"  />
        
                <x-input-error for="editing.telephone" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="number" class="mt-1 block w-full" placeholder="{{ __('Prix') }}" x-ref="editing.montant"
                    wire:model.defer="editing.montant"  />
        
                <x-input-error for="editing.montant" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('Date debuit') }}" x-ref="editing.date_debuit"
                    wire:model.defer="editing.date_debuit"  />
        
                <x-input-error for="editing.date_debuit" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('Date fin') }}" x-ref="editing.date_fin"
                    wire:model.defer="editing.date_fin"  />
        
                <x-input-error for="editing.date_fin" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Lieux') }}" x-ref="editing.lieu"
                    wire:model.defer="editing.lieu"  />
        
                <x-input-error for="editing.lieu" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input type="text" class="mt-1 block w-full" placeholder="{{ __('Ticket') }}" x-ref="editing.nombre_jour"
                    wire:model.defer="editing.nombre_jour"  />
        
                <x-input-error for="editing.nombre_jour" class="mt-2" />
            </div>
            <div class="mt-4">
                <label for="editing.image_url" class="block mb-2 text-sm font-medium text-gray-900 ">Image_url</label>
               
                <input wire:model="file" type="file" id="file" name="file" class="mt-1 block w-full border border-gray-600" >
        
                <x-input-error for="editing.image_url" class="mt-2" />
            </div>
            <div class="mt-4">
                <label for="editing.video" class="block mb-2 text-sm font-medium text-gray-900 ">Video</label>
                <input wire:model="video" type="file" id="video" name="video" class="mt-1 block w-full border border-gray-600">
                <x-input-error for="video" class="mt-2" />
            </div>
            <div class="mt-4">

                <label for="editing.is_correct"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type media à afficher</label>
                <select id="editing.is_correct" wire:model.defer="editing.is_correct"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">selectionnez le media</option>
                    <option value="0">Image</option>
                    <option value="1">Video</option>
                </select>
        
        
                <x-input-error for="editing.is_correct" class="mt-2" />
            </div>
            <div class="mt-4">

                <label for="editing.type_demande_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catecories</label>
                <select id="editing.type_demande_id" wire:model.defer="editing.type_demande_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Selectionnez le type</option>
                    @foreach ($tupedemandes as $tupedemande)
                    <option value="{{ $tupedemande->id }}">{{ $tupedemande->name }}</option>
                    @endforeach
                </select>
        
        
                <x-input-error for="editing.type_demande_id" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModal', false)" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="saves" wire:loading.attr="disabled">
                {{ __('Enregistrer') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal> --}}
</div>
