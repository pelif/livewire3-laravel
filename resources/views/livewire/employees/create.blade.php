<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use App\Models\Employee;

new class extends Component {

    #[Rule('required|string|max:255')]
    public string $name='';

    #[Rule('required|string|max:255')]
    public string $document='';

    #[Rule('required|string|max:255')]
    public string $email='';

    #[Rule('required|string|max:255')]
    public string $phone='';

    #[Rule('required|string|max:255')]
    public string $address='';

    #[Rule('required|string|max:255')]
    public string $city='';

    #[Rule('required|string|max:255')]
    public string $state='';

    public function store(): void
    {
        $validated = $this->validate();
        $save = Employee::create($validated);

        $this->name = '';
        $this->document = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';

        $this->dispatch('employee-created');
    }


};

?>

<div>
    <form wire:submit='store'>
        <input
            wire:model="name"
            placeholder="{{  __('What\'s name of Employee ?' ) }}"
            type="text"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300  w-full">
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

        <input
            type="text"
            wire:model="document"
            placeholder="{{  __('Enter with Docuemnt Number') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('document')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="email"
            placeholder="{{  __('Enter with E-mail Address') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('email')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="phone"
            placeholder="{{  __('Enter with Phone Number') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('phone')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="address"
            placeholder="{{  __('Enter with Address Of Employee') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('address')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="city"
            placeholder="{{  __('Enter with City of Employee') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('city')" class="mt-2"></x-input-error>

        <input
            type="text"
            wire:model="state"
            placeholder="{{  __('Enter with State of Employee') }}"
            class="form-input rounded-full px-4 py-3 border-gray-300 focus:border-indigo-300 w-full">
        <x-input-error :messages="$errors->get('state')" class="mt-2"></x-input-error>

        <x-primary-button class="mt-4" wire:confirm="Você confirma que vai este funcionário ?">{{ __('Save') }}</x-primary-button>
    </form>


</div>
