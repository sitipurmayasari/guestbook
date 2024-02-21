<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Guest\Visitor;

class Dashboards extends Component
{
    public $role,$user;
    public function mount()
    {
        $this->user = auth()->user();
        $this->role = auth()->user()->role;
    }

    public function render()
    {
        $nowthn = (Carbon::now()->year);
        return view('livewire.dashboard.dashboards',[
            'visitCount' => Visitor::whereYear('created_at',$nowthn)
                                    ->where('category',4)
                                    ->count(),
            'labCount' => Visitor::whereYear('created_at',$nowthn)
                                    ->where('category',2)
                                    ->count(),
            'informationCount' => Visitor::whereYear('created_at',$nowthn)
                                    ->where('category',3)
                                    ->count(),
        ]);
           
    }
}
