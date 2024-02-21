<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class Kategoris extends Component
{
    use WithPagination;
    public $search, $paginate = 10;
    public $kategori_id, $nama,$keterangan, $isOpen;
    public $openModalDelete = false, $confirm_id, $confirm_name;
    
    public function render()
    {
        $kategoris  = Kategori::when($this->search, function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })->orderBy('created_at', 'desc')
        ->paginate($this->paginate);

        return view('livewire.master.kategoris',compact('kategoris'));
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
        $this->kategori_id = null;
        $this->nama = null;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|unique:kategori,nama,'.$this->kategori_id.',id',
            'keterangan' => 'required'
        ]);
        $save = Kategori::updateOrCreate(['id' => $this->kategori_id], [
            'nama' => $this->nama,
            'keterangan' => $this->keterangan
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
        $bidangs = Kategori::find($id);
        $this->kategori_id = $id;
        $this->nama = $bidangs->nama;
        $this->keterangan = $bidangs->keterangan;
        $this->openModal();
    }
    public function delete()
    {
        $data = Kategori::find($this->confirm_id);
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
