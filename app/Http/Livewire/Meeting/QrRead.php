<?php

namespace App\Http\Livewire\Meeting;

use App\Models\Meeting\Program;
use Livewire\Component;

class QrRead extends Component
{
    public $link;
    public function mount($slug){
        $this->link = Route('partisipan',$slug);
    }
    
    public function render()
    {
        return view('livewire.meeting.qr-read');
    }
}
