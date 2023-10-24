<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Outing;

class HomerImage extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','mimeType','size'];

    public function outing(): BelongsTo {
      return $this->belongsTo( Outing::class );
    }
}
