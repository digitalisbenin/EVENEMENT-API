<?php

namespace App\Http\Livewire;

use App\Models\Type_demande;
use Livewire\Component;

class ShowSpecialite extends Component
{
    public Type_demande $deleting;
    public Type_demande $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;

    public function rules()
    {
        return [
            'editing.name' => 'required|min:2',
            'editing.prix' => 'nullable',
            
        ];
    }

    public function delete(Type_demande $specialites)
    {
        $this->deleting = $specialites;
        $this->action = 'Supprimer un Specialité';
        $this->showDeleteModal = true;
    }

    public function edit(Type_demande $specialites)
    {
        $this->editing = $specialites;
        $this->action = 'Modifier un Specialité';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Type_demande();
        $this->action = 'Ajouter un Specialité';
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        //$this->notify('Vous avez supprimé un Specialité');
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        //$this->notify('Enregistrement effectué avec succès');
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.show-specialite',[
            'specialites'=> Type_demande::all(), 
        ]);
    }
}
