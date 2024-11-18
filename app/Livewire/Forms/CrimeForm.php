<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Crime;
use Livewire\Attributes\Validate;

class CrimeForm extends Form
{
    public ?Crime $crime = null;

    public $name;
    public $details; // New 'details' field
    public $zilla_id;
    public $thana_id;
    public $union_id;
    public $date;

    protected $rules = [
        'name' => 'required|string',
        'details' => 'required|string', // Adding validation for the 'details' field
        'zilla_id' => 'required|exists:zillas,id',
        'thana_id' => 'required|exists:thanas,id',
        'union_id' => 'required|exists:unions,id',
        'date' => 'required|date',
    ];

    public function setCrime(Crime $crime)
    {
        $this->crime = $crime;
        $this->name = $crime->name;
        $this->details = $crime->details;
        $this->zilla_id = $crime->zilla_id;
        $this->thana_id = $crime->thana_id;
        $this->union_id = $crime->union_id;
        $this->date = $crime->date;
    }

    public function store()
    {
        $this->validate();

        Crime::create([
            'name' => $this->name,
            'details' => $this->details,
            'zilla_id' => $this->zilla_id,
            'thana_id' => $this->thana_id,
            'union_id' => $this->union_id,
            'date' => $this->date,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->crime->update([
            'name' => $this->name,
            'details' => $this->details,
            'zilla_id' => $this->zilla_id,
            'thana_id' => $this->thana_id,
            'union_id' => $this->union_id,
            'date' => $this->date,
        ]);

        $this->reset();
    }
}
