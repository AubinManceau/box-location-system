<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">{{ $box->name }}</h2>
                    <div class="flex gap-2">
                        <span
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create-box')"
                            class="py-2 px-6 rounded-lg bg-gray-800 text-xs text-white uppercase cursor-pointer"
                        >{{ __('Modifier le box') }}</span>

                        <x-modal name="create-box" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('box.update', ['id' => $box->id]) }}" class="p-6">
                                @csrf
                                @method('put')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __("Modifier votre box") }}
                                </h2>

                                <div class="mt-4">
                                    <label for="name">{{ __('Nom du box') }}</label>
                                    <input id="name" class="block mt-1 w-full rounded-md" type="text" name="name" required autofocus value='{{ $box -> name }}' />

                                    <label for="description" class="mt-2">{{ __('Description') }}</label>
                                    <textarea id="description" class="block mt-1 w-full resize-none rounded-md h-[15rem]" name="description" required>{{ $box -> description }}</textarea>
                                    
                                    <label for="adress" class="mt-2">{{ __('Adresse') }}</label>
                                    <input id="adress" class="block mt-1 w-full rounded-md" type="text" name="adress" required value='{{ $box -> adress }}'/>

                                    <label for="price" class="mt-2">{{ __('Prix') }}</label>
                                    <input id="price" class="block mt-1 w-full rounded-md" type="number" step=".01" min="0" name="price" required value='{{ $box -> price }}'/>
                                </div>



                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('annuler') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ms-3">
                                        {{ __('Modifier le box') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </x-modal>
                        <form action="{{ route('box.destroy', ['id' => $box->id]) }}" method="post">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="id" value="{{ $box->id }}">
                            <x-danger-button class="ms-3">
                                {{ __('Supprimer un box') }}
                            </x-danger-button>
                        </form>
                    </div>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="mb-4 p-3">
                        <p class="text-gray-600"><span class="font-bold">Description : </span>{{ $box->description }}</p>
                        <p class="text-gray-600"><span class="font-bold">Adresse : </span>{{ $box->adress }}</p>
                        <p class="text-gray-600 mb-2"><span class="font-bold">Loyer mensuel : </span>{{ $box->price }} €</p>
                        <a href="{{ route('contract.index', ['id' => $box->id]) }}" class="py-2 px-4 rounded-md bg-blue-800 text-white uppercase cursor-pointer text-xs">Historique de location</a>
                    </div>
                    <h3 class="text-xl font-bold">Locataire actuel</h3> 
                    <div class="mb-4 p-3">
                        @if ($contract)
                            <p class="text-gray-600"><span class="font-bold">Nom : </span>{{ $contract->tenant->firstname . ' ' . $contract->tenant->lastname }}</p>
                            <p class="text-gray-600"><span class="font-bold">Date de début de contrat : </span>{{ $contract->date_start }}</p>
                            <p class="text-gray-600"><span class="font-bold">Date de fin du contrat : </span>{{ $contract->date_end }}</p>
                            <p class="text-gray-600"><span class="font-bold">Prix : </span>{{ $contract->price == null ? $box->price : $contract->price }}€ / mois</p>
                            <div class="mt-4 flex gap-2 items-center">
                                <p class="text-gray-600 font-bold">Contrat :</p>

                                <span
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'assign-tenant')"
                                    class="py-2 px-6 rounded-md bg-gray-800 text-white uppercase cursor-pointer text-xs"
                                >{{ __('Modifier le contrat') }}</span>

                                <x-modal name="assign-tenant" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                    <form method="post" action="{{ route('contract.update', ['id' => $contract->id]) }}" class="p-6">
                                        @csrf
                                        @method('put')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __("Modifier le contrat") }}
                                        </h2>

                                        <div class="mt-4">

                                            <input type="hidden" name="box_id" value="{{ $box->id }}">

                                            <label for="date_start">{{ __('Date de début du contrat') }}</label>
                                            <input id="date_start" class="block mt-1 w-full rounded-md" type="date" name="date_start" value="{{ $contract->date_start }}" required autofocus/>

                                            <label for="date_end" class="mt-2">{{ __('Date de fin du contrat') }}</label>
                                            <input id="date_end" class="block mt-1 w-full rounded-md" type="date" name="date_end" value="{{ $contract->date_end }}" required></input>

                                            <label for="price" class="mt-2">{{ __('Prix') }}</label>
                                            <input id="price" class="block mt-1 w-full rounded-md" type="number" step=".01" min="0" name="price" value="{{ $contract->price == null ? $box->price : $contract->price }}"/>

                                            <label for="tenant_id" class="mt-2">{{ __('Locataire') }}</label>
                                            <select id="tenant_id" class="block mt-1 w-full rounded-md" name="tenant_id" required>
                                                @foreach ($tenants as $tenant)
                                                    <option value="{{ $tenant->id }}" {{ $tenant->id === $contract->tenant_id ? 'selected' : '' }}>{{ $tenant->firstname . ' ' . $tenant->lastname }}</option>
                                                @endforeach
                                            </select>

                                            <label for="contract_model_id" class="mt-2">{{ __('Modèle de contrat') }}</label>
                                            <select id="contract_model_id" class="block mt-1 w-full rounded-md" name="contract_model_id" required>
                                                @foreach ($contractModels as $contractModel)
                                                    <option value="{{ $contractModel->id }}" {{ $contractModel->id === $contract->contract_model_id ? 'selected' : '' }}>{{ $contractModel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('annuler') }}
                                            </x-secondary-button>

                                            <x-primary-button class="ms-3">
                                                {{ __('Générer le contrat') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>

                                <form action="{{ route('contract.destroy', ['id' => $box->id]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <input type="hidden" name="contract_id" value="{{ $contract->id }}">
                                    <x-danger-button>
                                        {{ __('Supprimer le contrat') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        @else
                            <p class="text-gray-600 mb-4">Pas de locataire</p>
                            <span
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'assign-tenant')"
                                class="py-2 px-6 rounded-lg bg-gray-800 text-white uppercase cursor-pointer"
                            >{{ __('Ajouter un locataire') }}</span>

                            <x-modal name="assign-tenant" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('contract.create') }}" class="p-6">
                                    @csrf

                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __("Assigner un locataire à ce box") }}
                                    </h2>

                                    <div class="mt-4">

                                        <input type="hidden" name="box_id" value="{{ $box->id }}">

                                        <label for="date_start">{{ __('Date de début du contrat') }}</label>
                                        <input id="date_start" class="block mt-1 w-full rounded-md" type="date" name="date_start" required autofocus/>

                                        <label for="date_end" class="mt-2">{{ __('Date de fin du contrat') }}</label>
                                        <input id="date_end" class="block mt-1 w-full rounded-md" type="date" name="date_end" required></input>

                                        <label for="price" class="mt-2">{{ __('Prix') }}</label>
                                        <input id="price" class="block mt-1 w-full rounded-md" type="number" step=".01" min="0" name="price"/>

                                        <label for="tenant_id" class="mt-2">{{ __('Locataire') }}</label>
                                        <select id="tenant_id" class="block mt-1 w-full rounded-md" name="tenant_id" required>
                                            @foreach ($tenants as $tenant)
                                                <option value="{{ $tenant->id }}">{{ $tenant->firstname . ' ' . $tenant->lastname }}</option>
                                            @endforeach
                                        </select>

                                        <label for="contract_model_id" class="mt-2">{{ __('Modèle de contrat') }}</label>
                                        <select id="contract_model_id" class="block mt-1 w-full rounded-md" name="contract_model_id" required>
                                            @foreach ($contractModels as $contractModel)
                                                <option value="{{ $contractModel->id }}">{{ $contractModel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('annuler') }}
                                        </x-secondary-button>

                                        <x-primary-button class="ms-3">
                                            {{ __('Générer le contrat') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </x-modal>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
