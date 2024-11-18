<?php

namespace App\Livewire;
// Assuming you have FormsThana class for the Thana form
use App\Livewire\Forms\ThanaForm;
use Livewire\Component;
use App\Models\Thana;
use App\Models\Zilla; // For selecting the associated Zilla

class ThanaIndex extends Component
{
    public ThanaForm $form;

    public bool $thanaModal = false;

    public bool $editMode = false;

    public function openThanaModal()
    {
        $this->thanaModal = true;
    }

    public function closeThanaModal()
    {
        $this->thanaModal = false;
    }

    public function showModal()
    {
        $this->form->reset();
        $this->thanaModal = true;
    }

    public function edit($id)
    {
        // Find the thana by ID
        $thana = Thana::find($id);

        // Check if $thana is null before setting it
        if (!$thana) {
            session()->flash('error', 'Thana not found.');
            return;
        }

        // Set the thana if it exists
        $this->form->setThana($thana);
        $this->editMode = true;
        $this->thanaModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->form->update();
            session()->flash('message', 'Police Station updated successfully.');
            $this->editMode = false;
        } else {
            $this->form->store();
            session()->flash('message', 'Police Station Added successfully.');
        }
        $this->thanaModal = false;
    }

    public function delete($id)
    {
         Thana::find($id)->delete();
         session()->flash('message', 'Police Station Deleted Successfully.');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Thana Name'],
            ['key' => 'zilla.name', 'label' => 'Zilla Name'] // Showing related Zilla name
        ];

        // Fetch all Zillas to populate the dropdown
        $zillas = Zilla::select('id', 'name')->get();
        // dd($zillas->toArray());

        return view('livewire.thana-index', [
            'thanas' => Thana::with('zilla')->get(), // Fetch thanas with related zillas
            'zillas' => $zillas, // Pass the zilla data to the view
            'headers' => $headers,
        ]);
    }
}
