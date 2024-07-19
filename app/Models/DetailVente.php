<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class DetailVente extends Model
{
    use HasFactory;
    protected $table = 'detailvente';
    public function prix()
    {
        return $this->belongsTo(Prix::class, 'Id_prix', 'Id');
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class, 'Facture', 'Id');
    }
}
