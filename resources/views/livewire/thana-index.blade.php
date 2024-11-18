<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <x-mary-header title="All Thana">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModal()" />
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$thanas" striped @row-click="$wire.edit($event.detail.id)">
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

        @scope('header_zilla.name', $header)
            <h2 class="text-xl font-bold text-orange-700">
                {{  $header['label'] }}
            </h2>
        @endscope

        @scope('actions', $thana)
            <x-mary-button icon="o-trash" wire:click="delete({{ $thana->id }})" spinner class="btn-sm btn-error" />
        @endscope
    </x-mary-table>

    <!-- Modal -->
    @if($thanaModal)
        <x-mary-modal wire:model="thanaModal" class="backdrop-blur">
            <x-mary-form wire:submit="save">
                <x-mary-input label="Thana Name" placeholder="Enter thana" wire:model="form.name" />

                @php
                $zillas = App\Models\Zilla::all();
                @endphp

                <!-- Zilla Selection Dropdown -->
                <x-mary-select label="Zilla" icon="o-user" placeholder="Select a zilla" :options="$zillas" wire:model="form.zilla_id" />


                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.set('thanaModal', false)" />
                    <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>
    @endif
</div>
