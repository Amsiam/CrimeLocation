    <div>
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif
    <x-mary-header title="All Crimes">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModal()" />
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" with-pagination :rows="$this->crimes" striped @row-click="$wire.edit($event.detail.id)">
        @scope('header_id', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope

        @scope('header_name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope

        @scope('header_details', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope

        @scope('header_zilla.name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope

        @scope('header_thana.name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope

        @scope('header_union.name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope

        @scope('header_date', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{ $header['label'] }}
            </h2>
        @endscope



        @scope('actions', $crime)
            <x-mary-button icon="o-trash" wire:click="delete({{ $crime->id }})" spinner class="btn-sm btn-error" />
        @endscope
    </x-mary-table>

    <!-- Modal -->
    @if ($crimeModal)
        <x-mary-modal wire:model="crimeModal" class="backdrop-blur">
            <x-mary-form wire:submit="save">
                <x-mary-input label="Crime Name" placeholder="Enter crime name" wire:model="form.name" />
                <x-mary-textarea label="Details" placeholder="Enter details" wire:model="form.details" />

                <x-mary-select label="Zilla" placeholder="Select a Zilla" wire:model.live="form.zilla_id" :options="$this->zillas" />
                <x-mary-select label="Thana" placeholder="Select a Thana" wire:model.live="form.thana_id" :options="$this->thanas" />
                <x-mary-select label="Union" placeholder="Select a Union" wire:model="form.union_id" :options="$this->unions" />

                <x-mary-select label="Crime Type" placeholder="Select a Crime Type" wire:model="form.crime_type" :options="[['id'=>'red','name'=>'Red'],['id'=>'green','name'=>'Green'],['id'=>'blue','name'=>'Blue']]" />


                <!-- Date Picker -->
                <x-mary-input label="Date" type="date" wire:model="form.date" />

                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.set('crimeModal', false)" />
                    <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>
    @endif
</div>

