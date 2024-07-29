<?php

namespace App\Http\Livewire;

use App\Models\Commentaire;
use Livewire\Component;

class ShowCommentaires extends Component
{
    public Commentaire $deleting;
    public Commentaire $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;

    public function rules()
    {
        return [
            'editing.content' => 'required|min:2',
            'editing.repas_id' => 'required',
            
        ];
    }

    public function delete(Commentaire $commentaires)
    {
        $this->deleting = $commentaires;
        $this->action = 'Supprimer un commentaire';
        $this->showDeleteModal = true;
    }

    public function edit(Commentaire $commentaires)
    {
        $this->editing = $commentaires;
        $this->action = 'Modifier un commentaire';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Commentaire();
        $this->action = 'Ajouter un commentaire';
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        $this->notify('Vous avez supprimé un commentaire');
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->notify('Enregistrement effectué avec succès');
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.show-commentaires',[
            'commentaires'=> Commentaire::all(),
        ]);
    }
}
