<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes Box</h2>
                    <span
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-box')"
                        class="py-2 px-6 rounded-lg bg-gray-800 text-white uppercase cursor-pointer"
                    >{{ __('Ajouter un box') }}</span>

                    <x-modal name="create-box" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('contract.create') }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __("Créer un box et l'ajouter à votre liste") }}
                            </h2>

                            <div class="mt-4">
                                <label for="name">{{ __('Nom du box') }}</label>
                                <input id="name" class="block mt-1 w-full rounded-md" type="text" name="name" required autofocus/>

                                <label for="description" class="mt-2">{{ __('Description') }}</label>
                                <textarea id="description" class="block mt-1 w-full resize-none rounded-md h-[10rem]" name="description" required></textarea>

                                <label for="adress" class="mt-2">{{ __('Adresse') }}</label>
                                <input id="adress" class="block mt-1 w-full rounded-md" type="text" name="adress" required/>

                                <label for="price" class="mt-2">{{ __('Prix') }}</label>
                                <input id="price" class="block mt-1 w-full rounded-md" type="number" step=".01" min="0" name="price" required/>
                            </div>



                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('annuler') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Créer un box') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">
                    @foreach ($boxes as $box)
                        <div class="mb-4 border-2 border-gray-800 p-3 rounded-md">
                            <h2 class="text-2xl font-bold">{{ $box->name }}</h2>
                            <p class="text-gray-600"><span class="font-bold">Adresse : </span>{{ $box->adress }}</p>
                            <p class="text-gray-600"><span class="font-bold">Loyer mensuel : </span>{{ $box->price }} €</p>
                            <a href="{{ route('box.show', ['id' => $box->id]) }}" class="font-bold underline">Voir plus</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
