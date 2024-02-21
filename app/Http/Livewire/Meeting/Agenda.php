<?php

namespace App\Http\Livewire\Meeting;
use Illuminate\Http\Request;
use App\Models\Meeting\Participant;
use App\Models\Meeting\Program;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Agenda extends Component
{
    use WithPagination;
    public $search, $paginate = 10;
    public $program_id, $name,$datefrom, $dateto, $isOpen, $isReady;
    public $openModalDelete = false, $confirm_id, $confirm_name;

    public function render()
    {
        $data  = Program::when($this->search, function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })->orderBy('created_at', 'desc')
                        ->paginate($this->paginate);
        $now = Carbon::now();

        return view('livewire.meeting.agenda',compact('data','now'));
    }
    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function openPrint()
    {
        $this->isReady = true;
    }
    public function closePrint()
    {
        $this->isReady = false;
    }
    public function resetFields()
    {
        $this->program_id = null;
        $this->name = null;
    }

    

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'datefrom' => 'required',
            'dateto' => 'required'
        ]);
        $save = Program::updateOrCreate(['id' => $this->program_id], [
            'name' => $this->name,
            'datefrom' => $this->datefrom,
            'dateto' => $this->dateto
        ]);
        $this->alertSuccess('Kategori berhasil diperbaharui');
        $this->closeModal();
        $this->resetFields();
    }

    public function confirmDelete($id, $name)
    {
        $this->confirm_id = $id;
        $this->confirm_name = $name;
        $this->openModalDelete = true;
    }
    public function closeDelete()
    {
        $this->openModalDelete = false;
        $this->confirm_id = null;
        $this->confirm_name = null;
    }
    public function edit($id)
    {
        $data = Program::find($id);
        $this->program_id = $id;
        $this->name = $data->name;
        $this->datefrom = $data->datefrom;
        $this->dateto = $data->dateto;
        $this->openModal();
    }

    public function cetak($id)
    {
        $data = Program::find($id);
        $this->program_id = $id;
        $this->name = $data->name;
        $this->datefrom = $data->datefrom;
        $this->dateto = $data->dateto;

        $this->openPrint();
    }

    public function pdf()
    {
        return redirect()->route(
            'pdf.agenda',
            [
                'datefrom' => $this->datefrom,
                'program_id' => $this->program_id
            ]
        );
    }

    public function print(Request $request)
    {
        $data = Program::where('id',$request->program_id)->first();

        $detail = Participant::where('program_id',$request->program_id)->where('dates',$request->datefrom)->get();

        return view('livewire.meeting.cetak', [
            'data' => $data,
            'detail' => $detail,
            'tgl' =>$request->datefrom
        ]);
    }
    
    public function delete()
    {
        $data = Program::find($this->confirm_id);
        $data->delete();
        $this->openModalDelete = false;
        $this->alertSuccess($this->confirm_name . ' berhasil dihapus');
        $this->confirm_id = null;
        $this->confirm_name = null;
    }
    

    public function alertSuccess($message)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
