<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Union;
use Livewire\Attributes\Validate;

class UnionForm extends Form
{
    public ?Union $union = null;

    public $name;
    public $latitude;
    public $longitude;
    public $thana_id;

    protected $rules = [
        'name' => 'required|string',
        'thana_id' => 'required|exists:thanas,id',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ];

    public function setUnion(Union $union)
    {
        $this->union = $union;
        $this->name = $union->name;
        $this->thana_id = $union->thana_id;
        $this->latitude = $union->latitude;
        $this->longitude = $union->longitude;
    }

    public function store()
    {
        $this->validate();

        Union::create([
            'name' => $this->name,
            'thana_id' => $this->thana_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->union->update([
            'name' => $this->name,
            'thana_id' => $this->thana_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->reset();
    }
}

