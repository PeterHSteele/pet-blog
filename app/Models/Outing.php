<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\HomerImage;

class Outing extends Model
{
    use HasFactory;

    protected $fillable = [
      'location', 'description', 'date'
    ];

    public function image(): hasOne {
      return $this->hasOne( HomerImage::class );
    }
}
