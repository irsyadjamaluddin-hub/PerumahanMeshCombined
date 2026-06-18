<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSystem extends Model
{
    use HasFactory;

    protected $table = 'fsm_file_storage';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'ic_no', 'folder', 'shared_with'];

     // Cast the 'shared_with' attribute to string
     protected $casts = [
        'shared_with' => 'string',
    ];

   // Convert the 'shared_with' column to an array when accessing it
    public function getSharedWithAttribute($value)
    {
        if (is_array($value)) {
            return implode(',', $value);
        }
        return $value;
    }


   // Convert the 'shared_with' attribute to a string before saving it to the database
    public function setSharedWithAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['shared_with'] = implode(',', $value);
        } elseif (is_string($value)) {
            $this->attributes['shared_with'] = $value;
        } else {
            // Handle other types if necessary
            $this->attributes['shared_with'] = '';
        }
    }


    // Accessor for formatted created_at attribute
    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    // Accessor for formatted updated_at attribute
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    // Relationship with files
    public function files()
    {
        return $this->hasMany(Filefsm::class, 'folder_id');
    }

    // Method to store files
    public function storeFiles($files)
    {
        foreach ($files as $file) {
            $this->storeFile($file);
        }
    }

    // Method to store a single file
    private function storeFile($file)
    {
        $filename = $file->getClientOriginalName();
        $path = $file->store('public/fsm/' . $this->ic_no);

        $this->files()->create([
            'filename' => $filename,
            'file_path' => $path,
        ]);
    }
}
