<?php

namespace App\Http\Livewire;

use App\Models\Demande;
use App\Models\Type_demande;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ShowDemande extends Component
{
    use WithFileUploads;
    public Demande $deleting;
    public Demande $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;
    public $file;
    public $video;

    
    public function getFileType(UploadedFile $file): string
    {
        if ($file && $file->isValid()) {
            $mime = $file->getMimeType();
    
            return $this->mimeToType($mime); // Utilisez $this->mimeToType() pour appeler la méthode de la classe
        }
    
        return '';
    }
    
        function mimeToType(string $mime = null): string
        {
            if ($mime) {
                if (strstr($mime, 'image/')) {
                    return 'image';
                } elseif (strstr($mime, 'video/')) {
                    return 'video';
                } elseif (strstr($mime, 'audio/')) {
                    return 'audio';
                } elseif ($mime == 'application/pdf') {
                    return 'pdf';
                }
            }
    
            return 'file';
        }

    public function rules()
    {
        return [
            //'editing.name' => 'required|min:2',
            //'editing.description' => 'nullable',
            //'editing.date_debuit' => 'required',
            //'editing.date_fin' => 'required',
            //'editing.lieu' => 'required',
            //'editing.montant' => 'required',
            //'editing.nombre_jour' => 'required',
            'editing.status' => 'required',
            //'editing.telephone' => 'required',
            //'editing.is_correct' => 'required',
            //'editing.type_demande_id' => 'required',
            
            
        ];
    }

    public function delete(Demande $demandes)
    {
        $this->deleting = $demandes;
        $this->action = 'Supprimer un Publicité';
        $this->showDeleteModal = true;
    }

    public function edit(Demande $demandes)
    {
        $this->editing = $demandes;
        $this->action = 'Modifier un Publicité';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Demande();
        $this->action = 'Ajouter un Publicité';
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        //$this->notify('Vous avez supprimé un Publicité');
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
        return view('livewire.show-demande',[
            'demandes'=> Demande::all(),
            'users'=> User::all(),
            'tupedemandes'=> Type_demande::all(), 
        ]);
    }
}
