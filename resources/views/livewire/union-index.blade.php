<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <x-mary-header title="All Union">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModal()" />
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$unions" striped @row-click="$wire.edit($event.detail.id)">
        @scope('header_id', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{  $header['label'] }}
            </h2>
        @endscope

        @scope('header_name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{  $header['label'] }}
            </h2>
        @endscope

        @scope('header_thana.name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{  $header['label'] }}
            </h2>
        @endscope

        @scope('actions', $union)
            <x-mary-button icon="o-trash" wire:click="delete({{ $union->id }})" spinner class="btn-sm btn-error" />
        @endscope
    </x-mary-table>

    <!-- Modal -->
    @if($unionModal)
        <x-mary-modal wire:model="unionModal" class="backdrop-blur">
            <x-mary-form wire:submit="save">
                <x-mary-input label="Union Name" placeholder="Enter union" wire:model="form.name" />
                <x-mary-input label="Latitude" placeholder="Enter latitude" wire:model="form.latitude" />
                <x-mary-input label="Longitude" placeholder="Enter longitude" wire:model="form.longitude" />



                <!-- Thana Selection Dropdown -->
                <x-mary-select label="Thana" icon="o-user" placeholder="Select a thana" :options="$this->thanas" wire:model="form.thana_id" />

                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.set('unionModal', false)" />
                    <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>
    @endif
</div>
