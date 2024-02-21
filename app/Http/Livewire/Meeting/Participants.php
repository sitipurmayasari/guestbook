<?php

namespace App\Http\Livewire\Meeting;

use Livewire\Component;
use App\Models\Master\Unit;
use App\Models\Meeting\Program;
use App\Models\Meeting\Participant;
use Livewire\WithFileUploads;

class Participants extends Component
{
    use WithFileUploads;
    public $program_id, $name,$datefrom, $dateto, $dates, $origin, $participant_name, $unit_id, $instansi, $position, $gender, $type, $sign,  $is_edit = false;

    public $option_unit = [];

    public function mount($id = null)
    {
        $this->datefrom = date('Y-m-d');
        $this->dateto = date('Y-m-d');
        $this->option_unit = \App\Models\Master\Unit::get();
        $this->option_origin = [
            ['id' => '1', 'nama' => 'Internal BPOM'],
            ['id' => '2', 'nama' => 'Eksternal BPOM'],
        ];
        if ($id) {
            $this->is_edit = true;
            $this->program_id = $id;
            $program = Program::find($id);
            $this->nama = $program->nama;
            $this->datefrom = $program->datefrom;
            $this->dateto = $program->dateto;
       }
    }

    public function render()
    {
        return view('livewire.meeting.participants');
    }
}
