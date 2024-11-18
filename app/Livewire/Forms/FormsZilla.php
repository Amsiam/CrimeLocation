<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Zilla;
use Livewire\Attributes\Validate;

class FormsZilla extends Form
{
    public ?Zilla $zilla;

    public $name;
    public $latitude;
    public $longitude;

    protected $rules = [
        'name' => 'required|string',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ];

    public function setZilla(Zilla $zilla)
    {
        $this->zilla = $zilla;
        $this->name = $zilla->name;
        $this->latitude = $zilla->latitude;
        $this->longitude = $zilla->longitude;
    }

    public function store()
    {
        $this->validate();

        Zilla :: create([
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->zilla->update([
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->reset();
    }
}
