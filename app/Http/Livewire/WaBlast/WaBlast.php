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
    public $messageTitle = 'Informasi Layanan BBPOM Banjarbaru';
    public $message   = 'Halo {nama}, kami dari BBPOM Banjarbaru ingin menginformasikan kepada Anda terkait layanan kami. Terima kasih sudah berkunjung.';
    public $selected      = [];
    public $selectAll     = false;
    public $pageIds       = [];
    public $messageHistory = [];

    protected $queryString = ['category', 'period', 'search'];

    public function mount()
    {
        if (auth()->user()->role != 1) {
            return redirect()->route('dashboard');
        }

        // Load history (dummy data for now - nanti bisa dari database)
        $this->messageHistory = [
            [
                'date' => '2026-06-09',
                'title' => 'Informasi Layanan BBPOM',
                'recipients' => 45,
            ],
            [
                'date' => '2026-06-08',
                'title' => 'Undangan Sosialisasi',
                'recipients' => 32,
            ],
            [
                'date' => '2026-06-05',
                'title' => 'Reminder Pengujian',
                'recipients' => 18,
            ],
        ];
    }

    public function updatingCategory()
    {
        $this->resetPage();
        $this->selected  = [];
        $this->selectAll = false;
    }

    public function updatingPeriod()
    {
        $this->resetPage();
        $this->selected  = [];
        $this->selectAll = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selected  = [];
        $this->selectAll = false;
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    /**
     * Toggle select-all untuk halaman saat ini
     */
    public function toggleSelectAll(): void
    {
        $strPageIds  = array_map('strval', $this->pageIds);
        $strSelected = array_map('strval', $this->selected);

        $allSelected = count($strPageIds) > 0
            && count(array_diff($strPageIds, $strSelected)) === 0;

        if ($allSelected) {
            $this->selected  = array_values(array_filter($strSelected, fn ($id) => !in_array($id, $strPageIds)));
            $this->selectAll = false;
        } else {
            $this->selected  = array_values(array_unique(array_merge($strSelected, $strPageIds)));
            $this->selectAll = true;
        }
    }

    /**
     * Toggle satu baris
     */
    public function toggleSelected(int $id): void
    {
        $strId       = (string) $id;
        $strSelected = array_map('strval', $this->selected);

        if (in_array($strId, $strSelected)) {
            $this->selected = array_values(array_filter($strSelected, fn ($s) => $s !== $strId));
        } else {
            $this->selected[] = $strId;
        }

        $strPageIds  = array_map('strval', $this->pageIds);
        $strSelected = array_map('strval', $this->selected);
        $this->selectAll = count($strPageIds) > 0
            && count(array_diff($strPageIds, $strSelected)) === 0;
    }
    public function formatWaNumber(string $telp): string
    {
        $number = preg_replace('/[^0-9]/', '', $telp);

        // Jika sudah pakai format 62xxxxxxxxxx, tetap pakai (tanpa leading 0)
        if (str_starts_with($number, '62')) {
            return $number;
        }

        // Jika diawali 08, konversi ke 62
        if (str_starts_with($number, '08')) {
            return '62' . substr($number, 1); // 08xxxx -> 62xxxx
        }

        // Jika masih diawali 0 (mis. 0xxxx), konversi menjadi 62
        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        // Jika tidak ada awalan, tambahkan 62
        return '62' . $number;
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
     * Kirim WA Blast ke semua yang tercentang via StarSender Rotator API
     */
    public function sendBlast()
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

        if ($visitors->isEmpty()) {
            $this->dispatchBrowserEvent('alert', [
                'type'    => 'warning',
                'title'   => 'Perhatian',
                'message' => 'Tidak ada nomor telepon yang valid dari tamu yang dipilih.',
            ]);
            return;
        }

        $messages = $visitors->map(fn ($v) => [
            'to'    => $this->formatWaNumber(
                $v->telp
            ),
            'body'  => str_replace('{nama}', $v->name, $this->message),
            'delay' => 15,
        ])->values()->toArray();

        $deviceId = (int) env('DEVICE_BLAST_ID', 0);
        if ($deviceId === 0) {
            $this->dispatchBrowserEvent('alert', [
                'type'    => 'error',
                'title'   => 'Konfigurasi',
                'message' => 'DEVICE_BLAST_ID belum diatur di .env.',
            ]);
            return;
        }

        $devices = [
            ['device_id' => $deviceId, 'limit' => 100],
        ];
        $result   = sendWaBlast($messages, $devices);
        $response = json_decode($result, true);

        array_unshift($this->messageHistory, [
            'date'       => now()->format('Y-m-d'),
            'title'      => $this->messageTitle,
            'recipients' => $visitors->count(),
        ]);

        $success = is_array($response) && ($response['success'] ?? false) === true;

        $this->dispatchBrowserEvent('alert', [
            'type'    => $success ? 'success' : 'error',
            'title'   => $success ? 'Berhasil' : 'Gagal',
            'message' => $success
                ? 'WA Blast berhasil dikirim ke ' . $visitors->count() . ' penerima.'
                : 'Gagal mengirim WA Blast. ' . ($response['message'] ?? 'Periksa konfigurasi API.'),
        ]);
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

        $this->pageIds = $visitors->pluck('id')->toArray();
        $selectedStr   = array_map('strval', $this->selected);

        return view('livewire.wa-blast.wa-blast', compact('visitors', 'kategoris', 'selectedStr'));
    }
}
