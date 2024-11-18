<?php

namespace App\Livewire;

use App\Models\Crime;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Zilla;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

class Stat extends Component
{

    #[Validate(['required'])]
    public $zilla_id;
    #[Validate(['required'])]
    public $thana_id;
    #[Validate(['required'])]
    public $union_id;

    public $crime_type;

    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->format("Y-m-d");
        $this->end_date = now()->format("Y-m-d");
    }

    #[Computed()]
    public function zillas()
    {
        return Zilla::all();
    }

    #[Computed()]
    public function thanas()
    {
        if (!$this->zilla_id) return [];
        return Thana::when($this->zilla_id, function ($q) {
            return $q->where("zilla_id", $this->zilla_id);
        })->get();
    }

    #[Computed()]
    public function unions()
    {
        if (!$this->thana_id) return [];
        return Union::when($this->thana_id, function ($q) {
            return $q->where("thana_id", $this->thana_id);
        })->get();
    }

    #[Computed()]
    public function crimes() {
        return Crime::with('zilla', 'thana', 'union')
            ->when($this->zilla_id, function ($q) {
                return $q->where("zilla_id", $this->zilla_id);
            })
            ->when($this->thana_id, function ($q) {
                return $q->where("thana_id", $this->thana_id);
            })
            ->when($this->union_id, function ($q) {
                return $q->where("union_id", $this->union_id);
            })
            ->when($this->start_date, function ($q) {
                return $q->where("date", ">=", $this->start_date);
            })
            ->when($this->end_date, function ($q) {
                return $q->where("date", "<=", $this->end_date);
            })
            ->paginate(10);
    }

    public function updatedZillaId($value)
    {

        $this->thana_id = "";
        $this->union_id = "";
    }

    public function updatedThanaId($value)
    {

        $this->union_id = "";
    }

    public function generate()
    {
        $this->validate();
        $this->dispatch('refresh');
        //get union by id
        $union = Union::find($this->union_id);
        //get thana by id
        $thana = Thana::find($this->thana_id);
        //get zilla by id
        $zilla = Zilla::find($this->zilla_id);

        $crimeTypeCount = Crime::where('date', '>=', $this->start_date)
            ->where('date', '<=', $this->end_date)
            ->when($this->crime_type, function ($q) {
                return $q->where("crime_type", $this->crime_type);
            })
            ->when($this->zilla_id, function ($q) {
                return $q->where("zilla_id", $this->zilla_id);
            })
            ->when($this->thana_id, function ($q) {
                return $q->where("thana_id", $this->thana_id);
            })
            ->when($this->union_id, function ($q) {
                return $q->where("union_id", $this->union_id);
            })
            ->groupBy('crime_type')
            ->selectRaw('crime_type, COUNT(*) as count')
            ->get();

        //total crime count
        $totalCrimeCount = Crime::where('date', '>=', $this->start_date)
            ->where('date', '<=', $this->end_date)
            ->when($this->crime_type, function ($q) {
                return $q->where("crime_type", $this->crime_type);
            })
            ->when($this->zilla_id, function ($q) {
                return $q->where("zilla_id", $this->zilla_id);
            })
            ->when($this->thana_id, function ($q) {
                return $q->where("thana_id", $this->thana_id);
            })
            ->when($this->union_id, function ($q) {
                return $q->where("union_id", $this->union_id);
            })
            ->count();

        $this->dispatch('refreshMap', ['union' => $union->name, 'thana' => $thana->name, 'zilla' => $zilla->name, 'crimeTypeCount' => $crimeTypeCount, 'totalCrimeCount' => $totalCrimeCount]);
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Crime Name'],
            ['key' => 'details', 'label' => 'Details'],
            ['key' => 'date', 'label' => 'Date'],
        ];
        return view('livewire.stat', [
            'headers' => $headers
        ]);
    }
}
