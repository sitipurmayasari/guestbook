<?php

namespace App\Models\Meeting;

use App\Models\Master\UnitKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = "participant";
    protected $fillable = ["program_id","dates","origin","participant_name","unit","instansi","position","gender","type","sign"];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

