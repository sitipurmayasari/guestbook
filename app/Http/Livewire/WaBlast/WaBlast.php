<?php

namespace App\Http\Livewire\WaBlast;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guest\Visitor;
use App\Models\Master\Kategori;
class WaBlast extends Component
{
    use WithPagination;

    public $category  = '';
    public $period    = 1;
    public $search    = '';
    public $paginate  = 10;
    public $message   = 'Halo {nama}, kami dari BBPOM Banjarbaru ingin menginformasikan kepada Anda terkait layanan kami. Terima kasih sudah berkunjung.';
    public $selected  = [];

    // Form tambah penerima manual
    public $newName     = '';
    public $newOrigin   = '';
    public $newTelp     = '';
    public $newCategory = 3;

    protected $rules = [
        'newName'     => 'required|string|max:255',
        'newOrigin'   => 'nullable|string|max:255',
        'newTelp'     => 'required|string|max:20',
        'newCategory' => 'required|integer',
    ];

    protected $queryString = ['category', 'period', 'search'];

    public function mount()
    {
        if (auth()->user()->role != 1) {
            return redirect()->route('dashboard');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selected = [];
    }

    public function updatingCategory()
    {
        $this->resetPage();
        $this->selected = [];
    }

    public function updatingPeriod()
    {
        $this->resetPage();
        $this->selected = [];
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    /**
     * Format nomor HP ke format internasional WhatsApp (62xxx)
     */
    public function formatWaNumber(string $telp): string
    {
        $number = preg_replace('/[^0-9]/', '', $telp);
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        } elseif (!str_starts_with($number, '62')) {
            $number = '62' . $number;
        }
        return $number;
    }

    /**
     * Buat URL WhatsApp untuk satu penerima
     */
    public function buildWaUrl(string $telp, string $name): string
    {
        $number  = $this->formatWaNumber($telp);
        $msgText = str_replace('{nama}', $name, $this->message);
        return 'https://wa.me/' . $number . '?text=' . rawurlencode($msgText);
    }

    /**
     * Simpan penerima baru ke tabel visitor
     */
    public function addRecipient(): void
    {
        $this->validate();

        $visitor = Visitor::create([
            'name'     => $this->newName,
            'origin'   => $this->newOrigin,
            'telp'     => $this->newTelp,
            'category' => $this->newCategory,
            'purpose'  => 'Tambah manual via WA Blast',
        ]);

        $this->selected[] = $visitor->id;

        $this->newName     = '';
        $this->newOrigin   = '';
        $this->newTelp     = '';
        $this->newCategory = 3;

        $this->dispatchBrowserEvent('alert', [
            'type'    => 'success',
            'title'   => 'Berhasil',
            'message' => 'Penerima baru berhasil ditambahkan.',
        ]);
    }

    /**
     * Kirim WA Blast ke semua yang tercentang
     */
    public function sendBlast(): void
    {
        if (empty($this->selected)) {
            $this->dispatchBrowserEvent('alert', [
                'type'    => 'warning',
                'title'   => 'Perhatian',
                'message' => 'Pilih minimal satu tamu terlebih dahulu.',
            ]);
            return;
        }

        $visitors = Visitor::whereIn('id', $this->selected)
            ->whereNotNull('telp')
            ->where('telp', '!=', '')
            ->get(['id', 'name', 'telp']);

        $urls = $visitors->map(fn ($v) => $this->buildWaUrl($v->telp, $v->name))->values()->toArray();

        $this->dispatchBrowserEvent('open-wa-tabs', ['urls' => $urls]);
    }

    public function render()
    {
        $startDate = Carbon::now()->subMonths((int) $this->period)->startOfDay();

        $visitors = Visitor::latest()
            ->where('created_at', '>=', $startDate)
            ->whereNotNull('telp')
            ->where('telp', '!=', '')
            ->when($this->category !== '', function ($query) {
                $query->where('category', $this->category);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('telp',  'like', '%' . $this->search . '%')
                      ->orWhere('origin','like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->paginate);

        $kategoris = Kategori::all();

        return view('livewire.wa-blast.wa-blast', compact('visitors', 'kategoris'));
    }
}
