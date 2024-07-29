<?php

namespace App\Http\Livewire;

use App\Models\Demande;
use App\Models\Type_demande;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ShowDemandes extends Component
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

    public function mount()
    {
        $this->editing = new Demande();
        $this->deleting = new Demande();
    }
    
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
            'editing.name' => 'required|min:2',
            'editing.description' => 'nullable',
            'editing.date_debuit' => 'required',
            'editing.date_fin' => 'required',
            'editing.lieu' => 'required',
            'editing.montant' => 'required',
            'editing.nombre_jour' => 'required',
            'editing.status' => 'required',
            'editing.telephone' => 'required',
            'editing.is_correct' => 'required',
            'editing.type_demande_id' => 'required',
        ];
    }

    public function delete(Demande $demandes)
    {
        $this->deleting = $demandes;
        $this->action = 'Supprimer une Publicité';
        $this->showDeleteModal = true;
    }

    public function edit(Demande $demandes)
    {
        $this->editing = $demandes;
        $this->action = 'Modifier une Publicité';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Demande();
        $this->action = 'Ajouter une Publicité';
        $this->showEditModal = true;
    }

    public function deleteSelected()
    {
        $this->deleting->delete();

        $this->showDeleteModal = false;

        //$this->notify('Vous avez supprimé une Publicité');
    }

    public function save()
    {
        // Validation des fichiers
        $this->validate([
            'file' => 'required|mimetypes:image/jpeg,image/png,image/jpg,video/webm,video/mp4,video/3gpp|max:20480',
            'video' => 'nullable|mimetypes:video/webm,video/mp4,video/3gpp|max:20480'
        ]);
    
        // Variables pour stocker les URLs
        $imageUrl = null;
        $videoUrl = null;
    
        // Traitement du fichier image
        if ($this->file) {
            $file = $this->file;
            $name = time() . $file->getClientOriginalName();
            $fileType = $this->getFileType($file);
            
            if ($fileType === 'image') {
                $path = 'images';
            } else {
                $path = 'videos';  // Assuming file is video if not image
            }
            
            $url = $this->file->storePubliclyAs($path, $name, 's3');
            $imageUrl = "https://bucetwadounou.s3.us-east-1.amazonaws.com/$url";
        }
    
        // Traitement du fichier vidéo
        if ($this->video) {
            $file = $this->video;
            $name = time() . $file->getClientOriginalName();
            $fileType = $this->getFileType($file);
            
            if ($fileType === 'video') {
                $path = 'videos';
                $url = $this->video->storePubliclyAs($path, $name, 's3');
                $videoUrl = "https://bucetwadounou.s3.us-east-1.amazonaws.com/$url";
            }
        }
    
        // Enregistrement de la demande avec l'URL de l'image et de la vidéo
        Demande::create([
            'name' => $this->editing->name,
            'description' => $this->editing->description,
            'date_debuit' => $this->editing->date_debuit,
            'date_fin' => $this->editing->date_fin,
            'lieu' => $this->editing->lieu,
            'montant' => $this->editing->montant,
            'telephone' => $this->editing->telephone,
            'is_correct' => $this->editing->is_correct,
            'nombre_jour' => $this->editing->nombre_jour,
            'status' => $this->editing->status,
            'image' => $imageUrl,
            'video' => $videoUrl,
            'type_demande_id' => $this->editing->type_demande_id,
        ]);
    
        // Fermeture du modal d'édition
        $this->showEditModal = false;
        return redirect('/show-demandes');
    }

    public function render()
    {
        return view('livewire.show-demandes',[
            'demandes'=> Demande::all(),
            'users'=> User::all(),
            'tupedemandes'=> Type_demande::all(), 
        ]);
    }
}

