<?php

use Livewire\Volt\Component;
use App\Models\Employee;
use Livewire\Attributes\Validate;

new class extends Component {

    public Employee $employee;

     #[Validate('required|string|max:255')]
     public string $name='';

    #[Validate('required|string|max:255')]
    public string $document='';

    #[Validate('required|string|max:255')]
    public string $email='';

    #[Validate('required|string|max:255')]
    public string $phone='';

    #[Validate('required|string|max:255')]
    public string $address='';

    #[Validate('required|string|max:255')]
    public string $city='';

    #[Validate('required|string|max:255')]
    public string $state='';

    public function mount(): void
    {
        $this->name = $this->employee->name;
        $this->document = $this->employee->document;
        $this->email = $this->employee->email;
        $this->phone = $this->employee->phone;
        $this->address = $this->employee->address;
        $this->city = $this->employee->city;
        $this->state = $this->employee->state;

    }

    public function update(): void
    {
        $this->authorize('update', $this->employee);
        $validated = $this->validate();
        $this->employee->update($validated);
        $this->dispatch('employee-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('employee-edit-canceled');
    }

};

?>

<div>
    <form wire:submit='update'>
        <input
            wire:model="name"
            type="text"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300  w-full">
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

        <input
            type="text"
            placeholder="{{  __('Enter with Docuemnt Number') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('document')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="email"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('email')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="phone"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('phone')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="address"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('address')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="city"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('city')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="state"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('state')" class="mt-2"></x-input-error>

        <x-primary-button class="mt-4" wire:confirm="Você confirma que alterar este funcionário ?">{{ __('Save') }}</x-primary-button>
        <button class="mt-4" wire:click.prevent="cancel">Cancel</button>
    </form>
</div>
