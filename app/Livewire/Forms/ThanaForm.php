<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Thana;
use App\Models\Zilla;
use Livewire\Attributes\Validate;

class ThanaForm extends Form
{
    public ?Thana $thana = null;

    public $name;
    public $zilla_id;

    protected $rules = [
        'name' => 'required|string',
        'zilla_id' => 'required|exists:zillas,id',
    ];

    public function setThana(Thana $thana)
    {
        $this->thana = $thana;
        $this->name = $thana->name;
        $this->zilla_id = $thana->zilla_id; // Set the zilla_id when editing a Thana
    }

    public function store()
    {
        $this->validate();

        Thana::create([
            'name' => $this->name,
            'zilla_id' => $this->zilla_id, // Store the selected Zilla ID
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->thana->update([
            'name' => $this->name,
            'zilla_id' => $this->zilla_id, // Update the selected Zilla ID
        ]);

        $this->reset();
    }
}
