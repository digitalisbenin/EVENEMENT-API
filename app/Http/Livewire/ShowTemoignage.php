<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Temoinage;
use Livewire\Component;

class ShowTemoignage extends Component
{
    public Temoinage $deleting;
    public Temoinage $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;

    public function rules()
    {
        return [
            'editing.title' => 'required|min:2',
            'editing.content' => 'required',
            'editing.status' => 'required',
            'editing.user_id' => 'required',
            
        ];
    }

    public function delete(Temoinage $temoignages)
    {
        $this->deleting = $temoignages;
        $this->action = 'Supprimer un Temoignage';
        $this->showDeleteModal = true;
    }

    public function edit(Temoinage $temoignages)
    {
        $this->editing = $temoignages;
        $this->action = 'Modifier un Temoignage';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Temoinage();
        $this->action = 'Ajouter un Temoignage';
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        //$this->notify('Vous avez supprimé un Temoignage');
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
        return view('livewire.show-temoignage',[
            'temoignages'=> Temoinage::all(), 
            'users'=> User::all(),
        ]);
    }
}
