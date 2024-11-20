<?php

namespace App\Livewire;

use App\Livewire\Forms\UnionForm;
use Livewire\Component;
use App\Models\Union;
use App\Models\Thana; // For selecting the associated Thana
use Livewire\Attributes\Computed;

class UnionIndex extends Component
{
    public UnionForm $form;

    public bool $unionModal = false;

    public bool $editMode = false;

    public function openUnionModal()
    {
        $this->unionModal = true;
    }

    public function closeUnionModal()
    {
        $this->unionModal = false;
    }

    public function showModal()
    {
        $this->form->reset();
        $this->unionModal = true;
    }

    public function edit($id)
    {
        // Find the union by ID
        $union = Union::find($id);

        // Check if $union is null before setting it
        if (!$union) {
            session()->flash('error', 'Union not found.');
            return;
        }

        // Set the union if it exists
        $this->form->setUnion($union);
        $this->editMode = true;
        $this->unionModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->form->update();
            session()->flash('message', 'Union Updated successfully.');
            $this->editMode = false;
        } else {
            $this->form->store();
            session()->flash('message', 'Union Added successfully.');
        }
        $this->unionModal = false;
    }

    public function delete($id)
    {
        Union::find($id)->delete();
        session()->flash('message', 'Union Deleted successfully.');
    }

    #[Computed()]
    public function thanas() {
        return Thana::all();
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Union Name'],
            ['key' => 'bn_name', 'label' => 'Bangla Name'],
            ['key' => 'thana.name', 'label' => 'Thana Name'] // Showing related Thana name
        ];

        // Fetch all Thanas to populate the dropdown
        $thanas = Thana::select('id', 'name')->get();
        // dd($thanas->toArray());

        return view('livewire.union-index', [
            'unions' => Union::with('thana')->get(), // Fetch unions with related thanas
            'headers' => $headers,
        ]);
    }
}
