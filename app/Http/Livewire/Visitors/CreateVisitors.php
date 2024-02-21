<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Guest\Visitor;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVisitors extends Component
{
    use WithFileUploads;
    public $name, $category=0, $origin, $telp,$email, $purpose, $gender,$tgl,
    $age, $school, $education, $work, $image,$button_enable = true;

    public $is_check_in = true,$display_check="CHECK IN";

    public $option_pegawai = [];
    protected $listeners = ['imageUpload'];

    public function mount(){
      
    }
    
    public function render()
    {
        $this->tgl = date('d-m-Y');
        return view('livewire.visitors.create-visitors');
    }

    public function imageUpload($dataUri)
    {
        $this->image = $dataUri;
    }

    public function refresh(){
        return redirect()->route('visitors.create');
    }
  
    public function store(){
        $this->validate([
            'name' => 'required',
            'telp' => 'required',    
            'origin' => 'required',
            'purpose' => 'required'       
        ]);
        if ($this->image == null) {
            $this->alertError('Foto tidak boleh kosong');
            return;
        }
        $this->button_enable = false;
        if ($this->is_check_in) {

            $data = [
                'category' => $this->category,
                'gender' => $this->gender,
                'telp' => $this->telp,
                'name' => $this->name,
                'purpose' => $this->purpose,
                'origin' => $this->origin,
                'email' => $this->email,
                'age' => $this->age,
                'school' => $this->school,
                'education' => $this->education,
                'work' => $this->work,
                'foto' => $this->image, 
            ];
            $absensi = Visitor::create($data);
            $this->alertSuccess('Visitor Masuk berhasil Check In');
        }else{
            $absensi = Visitor::where('pegawai_id', $this->pegawai_id)
                                ->where('tanggal', date('Y-m-d'))->first();
            $absensi->foto_keluar = $this->image;
            $absensi->save();
            $this->alertSuccess('Visitor Keluar berhasil Check Out');
        }
       
        return redirect()->route('visitors');
    }

    public function alertSuccess($message)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }

    public function alertError($message)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'error',  'message' => $message]
        );
    }
}
