<?php

namespace App\Http\Livewire;

use App\Models\Partenaire;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ShowPartenaires extends Component
{

    use WithFileUploads;
    public Partenaire $deleting;
    public Partenaire $editing;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $action = '';
    public $search;
    public $file;

    
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
            
            'editing.image' => 'nullable',
            'editing.sigle' => 'nullable',
            'editing.contact' => 'nullable',
            'editing.status' => 'nullable',
            
            
            
        ];
    }

    public function delete(Partenaire $partenaires)
    {
        $this->deleting = $partenaires;
        $this->action = 'Supprimer un partenaire';
        $this->showDeleteModal = true;
    }

    public function edit(Partenaire $partenaires)
    {
        $this->editing = $partenaires;
        $this->action = 'Modifier un partenaire';
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->editing = new Partenaire();
        $this->action = 'Ajouter un partenaire';
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
        $this->validate([
            'file' => 'required|mimetypes:image/jpeg,image/png,image/jpg,video/webm,video/mp4,video/3gpp,audio/mpeg,audio/mp3,audio/wav|max:2048',
        ]);


        $file = $this->file;
        $name = time() . $file->getClientOriginalName();
        $fileType = $this->getFileType($file);
        $path = '';
        switch ($fileType) {
            case 'image':
                $path = 'images';
                break;
            case 'audio':
                $path = 'audios';
                break;
            case 'video':
                $path = 'videos';
                break;
            case 'pdf':
                $path = 'pdfs';
                break;
            default:
                $path = 'images';
                break;
        }
        $url = $this->file->storePubliclyAs($path, $name, 's3');
        $url = "https://bucetwadounou.s3.us-east-1.amazonaws.com/$url";
        Partenaire::create([
            'name' => $this->editing->name,
            'sigle' => $this->editing->sigle,
            'contact' => $this->editing->contact,
            'status' => $this->editing->status,
            'image' => $url,
           
        ]);
        //$this->notify('Enregistrement effectué avec succès');
        $this->showEditModal = false;
    }
    
    public function render()
    {
        return view('livewire.show-partenaires',[
            'partenaires'=> Partenaire::all(),
           
        ]);
    }
}
