<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Img extends Model
{
    use HasFactory;

    protected $table = 'imgs';
    protected $fillable = [
        'imageId',
        'image'
        // 'result'
    ];

    public function setImageAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $path = $value->store('images', 'public');
            $this->attributes['image'] = asset('storage/' . $path);
        }
    }

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }


}
