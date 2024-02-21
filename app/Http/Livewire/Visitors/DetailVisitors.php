<?php

namespace App\Http\Livewire\Visitors;

use Livewire\Component;
use App\Models\Guest\Visitor;

class DetailVisitors extends Component
{
    public $name, $category=0, $origin, $telp,$email, $purpose, $gender,$tgl,
    $age, $school, $education, $work, $foto, $is_edit = false,$visitors,$visitor_id;

    public $option_category = [], $option_school = [];

    public function mount($id = null)
    {
        $this->option_category = [
            ['id' => '0', 'nama' => 'Umum'],
            ['id' => '1', 'nama' => 'Pengujian'],
            ['id' => '2', 'nama' => 'Layanan Informasi'],
        ];

        if ($id) {
            $this->is_edit = true;
            $this->visitor_id = $id;
            $visitor = Visitor::find($id);
            $this->visitors = $visitor;
            $this->name = $visitor->name;
            $this->category = $visitor->category;
            $this->origin = $visitor->origin;
            $this->telp = $visitor->telp;
            $this->email = $visitor->email;
            $this->purpose = $visitor->purpose;
            $this->gender = $visitor->gender;
            $this->age = $visitor->age;
            $this->school = $visitor->school;
            $this->education = $visitor->education;
            $this->work = $visitor->work;
            $this->tgl = date($visitor->created_at);
        }
    }

    public function render()
    {
        return view('livewire.visitors.detail-visitors');
    }
}
