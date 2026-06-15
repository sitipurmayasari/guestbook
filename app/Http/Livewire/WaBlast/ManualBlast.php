<?php

namespace App\Http\Livewire\WaBlast;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WaBlast\WaBlastContact;

class ManualBlast extends Component
{
    use WithPagination;

    public $category     = '';
    public $filterActive = '1';   // '1' = aktif, '0' = nonaktif, '' = semua
    public $search       = '';
    public $paginate     = 10;
    public $messageTitle = 'Informasi Layanan BBPOM Banjarbaru';
    public $message      = 'Halo {nama}, kami dari BBPOM Banjarbaru ingin menginformasikan kepada Anda terkait layanan kami. Terima kasih.';
    public $selected     = [];
    public $selectAll    = false;
    public $pageIds      = [];
    public $messageHistory = [];

    protected $queryString = ['category', 'filterActive', 'search'];

    public function mount()
    {
        if (auth()->user()->role != 1) {
            return redirect()->route('dashboard');
        }
    }

    public function updatingCategory()    { $this->resetPage(); $this->resetSelection(); }
    public function updatingFilterActive() { $this->resetPage(); $this->resetSelection(); }
    public function updatingSearch()       { $this->resetPage(); $this->resetSelection(); }
    public function updatingPaginate()     { $this->resetPage(); }

    private function resetSelection(): void
    {
        $this->selected  = [];
        $this->selectAll = false;
    }

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

        if (str_starts_with($number, '62')) {
            return $number;
        }
        if (str_starts_with($number, '08')) {
            return '62' . substr($number, 1);
        }
        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }
        return '62' . $number;
    }

    public function sendBlast()
    {
        if (empty($this->selected)) {
            $this->dispatchBrowserEvent('alert', [
                'type'    => 'warning',
                'title'   => 'Perhatian',
                'message' => 'Pilih minimal satu kontak terlebih dahulu.',
            ]);
            return;
        }

        $contacts = WaBlastContact::whereIn('id', $this->selected)
            ->where('is_active', 1)
            ->whereNotNull('telp')
            ->where('telp', '!=', '')
            ->get(['id', 'name', 'telp']);

        if ($contacts->isEmpty()) {
            $this->dispatchBrowserEvent('alert', [
                'type'    => 'warning',
                'title'   => 'Perhatian',
                'message' => 'Tidak ada nomor telepon yang valid dari kontak yang dipilih.',
            ]);
            return;
        }

        $messages = $contacts->map(fn ($c) => [
            'to'    => $this->formatWaNumber($c->telp),
            'body'  => str_replace('{nama}', $c->name, $this->message),
            'delay' => 15,
        ])->values()->toArray();

        $deviceId = (int) config('services.blast.device_id');
        if ($deviceId === 0) {
            $this->dispatchBrowserEvent('alert', [
                'type'    => 'error',
                'title'   => 'Konfigurasi',
                'message' => 'DEVICE_BLAST_ID belum diatur di .env.',
            ]);
            return;
        }

        $devices = [['device_id' => $deviceId, 'limit' => 100]];
        $result   = sendWaBlast($messages, $devices);
        $response = json_decode($result, true);

        array_unshift($this->messageHistory, [
            'date'       => now()->format('Y-m-d'),
            'title'      => $this->messageTitle,
            'recipients' => $contacts->count(),
        ]);

        $success = is_array($response) && ($response['success'] ?? false) === true;

        $this->dispatchBrowserEvent('alert', [
            'type'    => $success ? 'success' : 'error',
            'title'   => $success ? 'Berhasil' : 'Gagal',
            'message' => $success
                ? 'WA Blast berhasil dikirim ke ' . $contacts->count() . ' kontak.'
                : 'Gagal mengirim WA Blast. ' . ($response['message'] ?? 'Periksa konfigurasi API.'),
        ]);
    }

    public function render()
    {
        $contacts = WaBlastContact::latest()
            ->when($this->filterActive !== '', fn ($q) => $q->where('is_active', (int) $this->filterActive))
            ->when($this->category !== '', fn ($q) => $q->where('category', (int) $this->category))
            ->when($this->search, fn ($q) => $q->where(function ($q2) {
                $q2->where('name',   'like', '%' . $this->search . '%')
                   ->orWhere('telp',   'like', '%' . $this->search . '%')
                   ->orWhere('origin', 'like', '%' . $this->search . '%');
            }))
            ->paginate($this->paginate);

        $this->pageIds  = $contacts->pluck('id')->toArray();
        $selectedStr    = array_map('strval', $this->selected);

        return view('livewire.wa-blast.manual-blast', compact('contacts', 'selectedStr'));
    }
}

