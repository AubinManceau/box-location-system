<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <form action="{{ route('tenant.update', ['id' => $tenant->id]) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-4">
                            <label for="firstname" class="block text-sm font-medium text-gray-700">Prénom du locataire</label>
                            <input type="text" name="firstname" id="firstname" value="{{ $tenant->firstname }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Nom du locataire</label>
                            <input type="text" name="lastname" id="lastname" value="{{ $tenant->lastname }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                            <input type="email" name="email" id="email" value="{{ $tenant->email }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                            <input type="tel" name="phone" id="phone" value="{{ $tenant->phone }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="adress" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" name="adress" id="adress" value="{{ $tenant->adress }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="city" id="city" value="{{ $tenant->city }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="zip_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ $tenant->zip_code }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <a href="{{ route('tenant.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">retour</a>

                        <x-primary-button class="mt-4">
                            {{ __('Modifier le locataire') }}
                        </x-primary-button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>