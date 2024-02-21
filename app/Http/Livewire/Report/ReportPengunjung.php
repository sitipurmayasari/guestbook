<?php

namespace App\Http\Livewire\Report;

use App\Models\Guest\Visitor;
use Livewire\Component;
use Illuminate\Http\Request;

class ReportPengunjung extends Component
{
    public $startdate, $enddate, $category;
    public function render()
    {
        return view('livewire.report.report-pengunjung');
    }


    public function pdf()
    {
        return redirect()->route(
            'pdf.pengunjung',
            [
                'category' => $this->category,
                'startdate' => $this->startdate,
                'enddate' => $this->enddate
            ]
        );
    }

    public function print(Request $request)
    {
        $data = Visitor::orderby('created_at','asc')
            ->when($request->category, function ($query) use ($request) {
                return $query->where('category', $request->category);
            })
            ->when($request->startdate, function ($query) use ($request) {
                return $query->where('created_at', '>=', $request->startdate);
            })
            ->when($request->enddate, function ($query) use ($request) {
                return $query->where('created_at', '<=', $request->enddate);
            })
            ->get();

        return view('livewire.report.pdf.pengunjung', [
            'data' => $data
        ]);
    }
}
