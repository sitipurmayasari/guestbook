<?php

namespace App\Http\Livewire\Visitors;

use Livewire\Component;
use App\Models\Guest\Visitor;
use Livewire\WithPagination;

class ReadVisitors extends Component
{
    use WithPagination;
    public $search,$filter_status, $paginate = 10;
    public $visitor_id;

    public function render()
    {
        $visitors = Visitor::latest()
        ->when($this->search, function($query){
            $query->where('name','like','%'.$this->search.'%');
            $query->orwhere('origin','like','%'.$this->search.'%');
            $query->orwhere('purpose','like','%'.$this->search.'%');
        })
        ->when($this->filter_status, function($query){
            $query->where('category',$this->filter_status);
        })
        ->paginate($this->paginate);

        return view('livewire.visitors.read-visitors', compact('visitors'));
    }
}
