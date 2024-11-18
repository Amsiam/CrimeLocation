<?php

namespace App\Livewire;

use App\Models\Crime;
use App\Models\Union;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public $startDate;
    public $endDate;

    public $selectedUnion;
    public $selectedUnionDetails;

    public function mount(){
        $this->startDate = now()->subDays(30)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    #[Computed()]
    public function crimes(){
        return Crime::whereBetween('date', [$this->startDate, $this->endDate])
        ->when($this->selectedUnion, function($query){
            $query->where('union_id', $this->selectedUnion);
        })
        ->get();
    }

    #[Computed()]
    public function unions(){
        return Union::all();
    }

    public function selectUnion($id=null){

        if($id){
            $this->selectedUnion = $id;
            $this->selectedUnionDetails = Union::find($id);
        }else{
            $this->selectedUnion = null;
            $this->selectedUnionDetails = null;
        }


    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
