<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Units extends Component
{
    use WithPagination;
    public $search, $paginate = 10;
    public $unit_id, $nama_unit, $isOpen;
    public $openModalDelete = false, $confirm_id, $confirm_name;

    public function render()
    {
        $data  = Unit::when($this->search, function ($query) {
            $query->where('nama_unit', 'like', '%' . $this->search . '%');
        })->orderBy('created_at', 'desc')
        ->paginate($this->paginate);

        return view('livewire.master.units',compact('data'));
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
    public function resetFields()
    {
        $this->unit_id = null;
        $this->nama_unit = null;
    }

    public function store()
    {
        $this->validate([
            'nama_unit' => 'required|unique:unit,nama_unit,'.$this->unit_id.',id'
        ]);
        $save = Unit::updateOrCreate(['id' => $this->unit_id], [
            'nama_unit' => $this->nama_unit
        ]);

        $this->alertSuccess('Unit Kerja berhasil diperbaharui');
        $this->closeModal();
        $this->resetFields();
    }

    public function confirmDelete($id, $nama_unit)
    {
        $this->confirm_id = $id;
        $this->confirm_name = $nama_unit;
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
        $data = Unit::find($id);
        $this->unit_id = $id;
        $this->nama_unit = $data->nama_unit;
        $this->openModal();
    }
    public function delete()
    {
        $data = Unit::find($this->confirm_id);
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
