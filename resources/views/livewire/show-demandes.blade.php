
<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
    <div class="flex">
    <div class="mt-4 w-1/3">
        <label for="payement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Type d'évenement

        </label>
        
        <div id="payement" class="flex  ">
            <!-- Checkbox for Image -->
            <div class="flex items-center">
                <input 
                    type="radio" 
                    id="media-payent" 
                    name="payement" 
                    value="0" 
                    wire:model.defer="editing.payement"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                />
                <label for="media-image" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Libre
                </label>
            </div>
    
            <!-- Checkbox for Video -->
            <div class="flex items-center ml-2">
                <input 
                    type="radio" 
                    id="media-payents" 
                    name="payement" 
                    value="" 
                    wire:model.defer="editing.payement"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                />
                <label for="media-payents" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Payant
                </label>
            </div>
            
            <div class="flex items-center ml-2">
                <input 
                    type="radio" 
                    id="payement-video" 
                    name="payement" 
                    value="1" 
                    wire:model.defer="editing.payement"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                />
                <label for="media-video" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Payant_unique
                </label>
            </div>
        </div>
    
        <x-input-error for="editing.is_correct" class="mt-2" />
    </div>
    <div class="mt-4 w-full ml-4 mt-4">
        <x-input 
            type="number" 
            class="mt-2 block w-full" 
            placeholder="{{ __('Prix') }}" 
            x-ref="editing.montant" 
            wire:model.defer="editing.montant" 
        />
        <x-input-error for="editing.montant" class="mt-2" />
    </div>
    
    </div>
    <div class="mt-4">
        <label for="media-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            A la une
        </label>
        
        <div id="media-type" class="flex  ">
            <!-- Checkbox for Image -->
            <div class="flex items-center">
                <input 
                    type="radio" 
                    id="media-image" 
                    name="media-type" 
                    value="0" 
                    wire:model.defer="editing.priorite"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                />
                <label for="media-image" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Non
                </label>
            </div>
    
            <!-- Checkbox for Video -->
            <div class="flex items-center ml-2">
                <input 
                    type="radio" 
                    id="media-video" 
                    name="media-type" 
                    value="1" 
                    wire:model.defer="editing.priorite"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                />
                <label for="media-video" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Oui
                </label>
            </div>
        </div>
    
        <x-input-error for="editing.is_correct" class="mt-2" />
    </div>
   
    <div class="mt-4">

        <label for="editing.type_demande_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
        <select id="editing.type_demande_id" wire:model.defer="editing.type_demande_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Selectionnez la categorie</option>
            @foreach ($tupedemandes as $tupedemande)
            <option value="{{ $tupedemande->id }}">{{ $tupedemande->name }}</option>
            @endforeach
        </select>


        <x-input-error for="editing.type_demande_id" class="mt-2" />
    </div>
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
        <x-input type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('Date debut') }}" x-ref="editing.date_debuit"
            wire:model.defer="editing.date_debuit"  />

        <x-input-error for="editing.date_debuit" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input type="datetime-local" class="mt-1 block w-full" placeholder="{{ __('Date fin') }}" x-ref="editing.date_fin"
            wire:model.defer="editing.date_fin"  />

        <x-input-error for="editing.date_fin" class="mt-2" />
    </div>
    <div class="mt-4">
        <label for="editing.jours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jour de la semaine (uniquement pour les événements à répétition)</label>
        <select id="editing.jours" wire:model.defer="editing.jours" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Selectionnez un jour</option>
            <option value="Lundi">Lundi</option>
            <option value="Mardi">Mardi</option>
            <option value="Mercredi">Mercredi</option>
            <option value="Jeudi">Jeudi</option>
            <option value="Vendredi">Vendredi</option>
            <option value="Samedi">Samedi</option>
            <option value="Dimanche">Dimanche</option>
        </select>
    
        <x-input-error for="editing.jours" class="mt-2" />
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

        <label for="editing.status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
        <select id="editing.status" wire:model.defer="editing.status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Selectionnez le status</option>
            <option value="En attente">En attente</option>
            <option value="valider">Valider</option>
            <option value="terminer">Terminer</option>
            
        </select>


        <x-input-error for="editing.status" class="mt-2" />
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
        <!-- Champ masqué -->
        <input 
            type="hidden" 
            id="editing.user_id" 
            wire:model.defer="editing.user_id" 
            value="{{ Auth::user()->id }}"
        >
    
        <!-- Affichage du nom de l'utilisateur (si nécessaire) -->
        {{-- <label for="editing.user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ Auth::user()->name }}
        </label> --}}
    
        <x-input-error for="editing.user_id" class="mt-2" />
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