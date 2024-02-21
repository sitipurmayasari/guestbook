<?php

namespace App\Models\Guest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $table = "visitor";
    protected $fillable = ["name","category","origin","telp","email","purpose","gender","age","school","education","work","foto","sign"];

    public function foto(){
        return $this->foto ? asset('storage/guest/'.$this->foto) : asset('storage/guest/default.png');
    }
}
