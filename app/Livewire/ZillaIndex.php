<?php

namespace App\Livewire;

use App\Livewire\Forms\FormsZilla;
use Livewire\Component;
use App\Models\Zilla;

class ZillaIndex extends Component
{
    public FormsZilla $form;

    public bool $zillamodal = false;

    public bool $editMode = false;

    public function openZillaModal()
    {
        $this->zillamodal = true;
    }

    public function closeZillaModal()
    {
        $this->zillamodal = false;
    }

    public function showModal()
    {
        $this->form->reset();
        $this->zillamodal = true;
    }

    public function edit($id)
    {
        $zilla = Zilla::find($id);
        // Check if $thana is null before setting it
        if (!$zilla) {
            session()->flash('error', 'Thana not found.');
            return;
        }
        $this->form->setZilla($zilla);
        $this->editMode = true;
        $this->zillamodal = true;
    }

    public function save()
    {
        if($this->editMode){
            $this->form->update();
            session()->flash('message', 'Zilla Updated successfully.');
            $this->editMode = false;
        }else{
            $this->form->store();
            session()->flash('message', 'Zilla Added successfully.');
        }
        $this->zillamodal = false;
    }

    public function delete($id)
    {
        Zilla::find($id)->delete();
        session()->flash('message', 'Zilla Deleted successfully.');
    }

    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Zilla Name']
    ];
        return view('livewire.zilla-index', [
            'zilla' => Zilla::all(),
            'headers' => $headers

        ]);
    }
}
