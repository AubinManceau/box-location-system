<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes locataires</h2>
                    <span
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-tenant')"
                        class="py-2 px-6 rounded-lg bg-gray-800 text-white uppercase cursor-pointer"
                    >{{ __('Ajouter un locataire') }}</span>

                    <x-modal name="create-tenant" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('tenant.create') }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __("Ajouter un locataire à votre liste") }}
                            </h2>

                            <div class="mt-4 mb-4">
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

                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                                    <input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                                    <input type="tel" name="phone" id="phone" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                                </div>

                                <div class="mb-4">
                                    <label for="adress" class="block text-sm font-medium text-gray-700">Adresse</label>
                                    <input type="text" name="adress" id="adress" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                                </div>

                                <div class="mb-4">
                                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                                    <input type="text" name="city" id="city" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                                </div>

                                <div class="mb-4">
                                    <label for="zip_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                                    <input type="text" name="zip_code" id="zip_code" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
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
                <div class="p-6 text-gray-900">
                    @foreach ($tenants as $tenant)
                        <div class="mb-4 border-2 border-gray-800 p-3 rounded-md flex justify-between">
                            <h2 class="text-2xl font-bold">{{ $tenant->firstname .' '. $tenant->lastname }}</h2>
                            <div class="flex">
                                <a href="{{ route('tenant.show', ['id' => $tenant->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"> Voir plus </a>
                                <form action="{{ route('tenant.destroy', ['id' => $tenant->id]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <input type="hidden" name="id" value="{{ $tenant->id }}">
                                    <x-danger-button class="ms-3">
                                        {{ __('Supprimer') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>