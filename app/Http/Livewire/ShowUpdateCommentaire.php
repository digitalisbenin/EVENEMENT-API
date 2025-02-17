<?php

namespace App\Http\Livewire;


use App\Models\Commentaire;
use Livewire\Component;

class ShowUpdateCommentaire extends Component
{

    public Commentaire $deleting;
    public Commentaire $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;
    public $commentaire_id;


    public function mount($id)
    {
        $this->commentaire_id = request('commentaire');
        $this->editing =  Commentaire::find($id);
        //$this->content_en = $this->editing->getTranslation('content', 'en') ?? ''; 
    }
    

    public function rules()
    {
        return [
            'editing.content' => 'required|min:2',
            'editing.name' => 'nullable',
            'editing.status' => 'nullable',
            'editing.demande_id' => 'nullable',
            
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
       
        $this->editing->save();
        $this->showEditModal = false;
        return redirect('/show-commentaires');
    }
    public function render()
    {
        return view('livewire.show-update-commentaire');
    }
}
