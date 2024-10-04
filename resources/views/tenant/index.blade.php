<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes locataires</h2>
                    <span
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-box')"
                        class="py-2 px-6 rounded-lg bg-gray-800 text-white uppercase cursor-pointer"
                    >{{ __('Ajouter un locataire') }}</span>

                    <x-modal name="create-box" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('tenant.create') }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __("Ajouter un locataire à votre liste") }}
                            </h2>

                            <div class="mt-4">
                                <div class="grid grid-cols-2 gap-x-2">
                                    <div>
                                        <label for="firstname">{{ __('Prénom du locataire') }}</label>
                                        <input id="firstname" class="block mt-1 w-full rounded-md" type="text" name="firstname" required autofocus/>
                                    </div>
                                    <div>
                                        <label for="lastname" class="mt-2">{{ __('Nom du locataire') }}</label>
                                        <input id="lastname" class="block mt-1 w-full rounded-md" type="text" name="lastname" required/>
                                    </div>
                                </div>
                            </div>



                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('annuler') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Ajouter un locataire') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                    @foreach ($tenants as $tenant)
                        <div class="mb-4 border-2 border-gray-800 p-3 rounded-md">
                            <h2 class="text-2xl font-bold">{{ $tenant->firstname }}</h2>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>