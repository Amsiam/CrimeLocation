<?php

namespace App\Livewire;

use App\Livewire\Forms\CrimeForm;
use Livewire\Component;
use App\Models\Crime;
use App\Models\Zilla;
use App\Models\Thana;
use App\Models\Union;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class CrimeIndex extends Component
{
    use WithPagination;
    public CrimeForm $form;

    public bool $crimeModal = false;
    public bool $editMode = false;
    public $crimeLocations = []; // For storing crime locations with coordinates

    public function mount()
    {
        $this->form->zilla_id = 1;
    }

    #[Computed()]
    public function loadCrimeLocations()
    {
        $crimes = Crime::with('union')->get();

        // Populate crimeLocations with latitude and longitude of each union
        foreach ($crimes as $crime) {
            if ($crime->union) {
                $this->crimeLocations[] = [
                    'name' => $crime->name,
                    'latitude' => $crime->union->latitude,
                    'longitude' => $crime->union->longitude,
                ];
            }
        }

        // Emit event to update the map on the frontend
        $this->edit('crimeLocationsUpdated', $this->crimeLocations);
    }

    public function openCrimeModal()
    {
        $this->crimeModal = true;
    }

    public function closeCrimeModal()
    {
        $this->crimeModal = false;
    }

    public function showModal()
    {
        $this->form->reset();
        $this->crimeModal = true;
    }

    public function edit($id)
    {
        $crime = Crime::find($id);

        if (!$crime) {
            session()->flash('error', 'Crime not found.');
            return;
        }

        $this->form->setCrime($crime);
        $this->editMode = true;
        $this->crimeModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->form->update();
            session()->flash('message', 'Crime updated successfully.');
            $this->editMode = false;
        } else {
            $this->form->store();
            session()->flash('message', 'Crime added successfully.');
        }

        // Reload crime locations after saving a new or updated crime
        $this->loadCrimeLocations();

        $this->crimeModal = false;
    }

    public function delete($id)
    {
        Crime::find($id)->delete();
        session()->flash('message', 'Crime deleted successfully.');
        $this->loadCrimeLocations(); // Reload crime locations after deletion
    }

    #[Computed()]
    public function zillas() {
        return Zilla::all();
    }

    #[Computed()]
    public function thanas() {
        if(!$this->form->zilla_id)return [];
        return Thana::when($this->form->zilla_id,function($q){
            return $q->where("zilla_id",$this->form->zilla_id);
        })->get();
    }

    #[Computed()]
    public function unions() {
        if(!$this->form->thana_id)return [];
        return Union::when($this->form->thana_id,function($q){
            return $q->where("thana_id",$this->form->thana_id);
        })->get();
    }

    #[Computed()]
    public function crimes() {
        return Crime::with('zilla', 'thana', 'union')->latest()->paginate(10);
    }

    public function updatedFormZillaId($value){

        $this->form->thana_id = "";
        $this->form->union_id = "";

    }

    public function updatedFormThanaId($value){

        $this->form->union_id = "";

    }



    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Crime Name'],
            ['key' => 'details', 'label' => 'Details'],
            ['key' => 'zilla.name', 'label' => 'Zilla'],
            ['key' => 'thana.name', 'label' => 'Thana'],
            ['key' => 'union.name', 'label' => 'Union'],
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'crime_type', 'label' => 'Crime Type']
        ];

        return view('livewire.crime-index', [
            'headers' => $headers,
        ]);
    }
}
