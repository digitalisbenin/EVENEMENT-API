<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{
    public User $deleting;
    public User $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;

    public function rules()
    {
        return [
            'editing.name' => 'required|min:2',
            'editing.email' => 'required',
            'editing.password' => 'required',
            'editing.role_id' => 'required',
            
            
        ];
    }

    public function delete(User $users)
    {
        $this->deleting = $users;
        $this->action = 'Supprimer un user';
        $this->showDeleteModal = true;
    }

    public function edit(User $users)
    {
        $this->editing = $users;
        $this->action = 'Modifier un user';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new User();
        $this->action = 'Ajouter un user';
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        $this->notify('Vous avez supprimé un user');
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
        return view('livewire.show-users',[
            'users'=> User::all(), 
            'roles'=> Role::all(), 
        ]);
    }
}
