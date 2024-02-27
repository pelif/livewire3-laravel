<?php

use Livewire\Volt\Component;
use App\Models\Employee;

new class extends Component
{
    public $employees;

    public ?Employee $editing = null;

    public function mount(): void
    {
        $this->getEmployees();
    }

    #[On('employee-created')]
    public function getEmployees(): void
    {
        $this->employees = Employee::latest()->get();
    }

    public function edit(Employee $employee): void
    {
        $this->editing = $employee;
        $this->getEmployees();
    }

    #[On('employee-edit-canceled')]
    #[On('employee-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getEmployees();
    }

    public function delete(Employee $employee): void
    {
        $this->authorize('delete', $employee);
        $employee->delete();
        $this->getEmployees();
    }

};

?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ( $employees as $employee)
            <div class="p-6 flex space-x-2" wire:key="{{ $employee->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    {{  $employee->name }} - {{ $employee->email }} - {{ $employee->phone }}

                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link wire:click="edit({{ $employee->id }})">
                                {{ __('Edit') }}
                            </x-dropdown-link>
                            <x-dropdown-link wire:click="delete({{ $employee->id }})" wire:confirm="Are you sure to delete this Employee?">
                                {{ __('Delete') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                </div>

                @if ($employee->is($editing))
                    <livewire:employees.edit :employee="$employee" :key="$employee->id" />
                @else
                    <p class="mt-4 text-lg text-gray-900">{{ $employee->name }}</p>
                @endif
            </div>

        @endforeach
    </div>
</div>
