<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addImages($source, $id) {
        return $this->images()->create([
            'source' => $source,
            'gallery_id' => $id
        ]);
    }

    public static function search($name="") {
        return self::where("name", "LIKE", "%$name%");
    }
}
