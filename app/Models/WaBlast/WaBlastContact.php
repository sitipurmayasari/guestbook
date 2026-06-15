<?php

namespace App\Models\WaBlast;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaBlastContact extends Model
{
    use HasFactory;

    protected $table = 'wa_blast_contact';

    protected $fillable = [
        'name',
        'origin',
        'telp',
        'category',
        'is_active',
        'note',
        'added_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'category'  => 'integer',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
