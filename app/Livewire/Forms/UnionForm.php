<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Union;
use Livewire\Attributes\Validate;

class UnionForm extends Form
{
    public ?Union $union = null;

    public $name;
    public $bn_name;
    public $thana_id;

    protected $rules = [
        'name' => 'required|string',
        'bn_name' => 'required|string',
        'thana_id' => 'required|exists:thanas,id',
    ];

    public function setUnion(Union $union)
    {
        $this->union = $union;
        $this->name = $union->name;
        $this->bn_name = $union->bn_name;
        $this->thana_id = $union->thana_id;
    }

    public function store()
    {
        $this->validate();

        Union::create([
            'name' => $this->name,
            'thana_id' => $this->thana_id,
            'bn_name' => $this->bn_name,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->union->update([
            'name' => $this->name,
            'thana_id' => $this->thana_id,
            'bn_name' => $this->bn_name,
        ]);

        $this->reset();
    }
}

