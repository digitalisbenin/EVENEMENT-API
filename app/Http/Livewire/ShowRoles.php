<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class ShowRoles extends Component
{

    public Role $deleting;
    public Role $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;

    public function rules()
    {
        return [
            'editing.name' => 'required|min:2',
            'editing.description' => 'required',
            
        ];
    }

    public function delete(Role $roles)
    {
        $this->deleting = $roles;
        $this->action = 'Supprimer un role';
        $this->showDeleteModal = true;
    }

    public function edit(Role $roles)
    {
        $this->editing = $roles;
        $this->action = 'Modifier un role';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Role();
        $this->action = 'Ajouter un role';
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        $this->notify('Vous avez supprimé un role');
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
        return view('livewire.show-roles',[
            'roles'=> Role::all(), 
        ]);
    }
}
