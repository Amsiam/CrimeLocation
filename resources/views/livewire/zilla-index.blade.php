<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
<x-mary-header title="All Zilla">
    <x-slot:middle class="!justify-end">
        <x-mary-input icon="o-bolt" placeholder="Search..." />
    </x-slot:middle>
    <x-slot:actions>
    <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModal()" />
    </x-slot:actions>
</x-mary-header>
<x-mary-table :headers="$headers" :rows="$zilla" striped @row-click="$wire.edit($event.detail.id)">
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
    @scope('actions', $zilla)
        <x-mary-button icon="o-trash" wire:click="delete({{ $zilla->id }})" spinner class="btn-sm btn-error" />
    @endscope
</x-mary-table>
<!-- Modal -->
@if($zillamodal)
    <x-mary-modal wire:model="zillamodal" class="backdrop-blur">
        <x-mary-form wire:submit="save">
            <x-mary-input label="Zilla Name" placeholder="Enter zilla" wire:model="form.name" />
            <x-mary-input label="Latitude" wire:model="form.latitude" placeholder="Enter latitude" />
            <x-mary-input label="Longitude" wire:model="form.longitude" placeholder="Enter longitude" />


            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.set('zillamodal', false)" />
                <x-mary-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
@endif
</div>
