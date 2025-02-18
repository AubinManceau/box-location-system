<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Ma facture</h2>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="max-w-2xl p-6 rounded-lg">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Facture</h2>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Loueur</h3>
                            <p><strong>Nom:</strong> {{ $bill->contract->box->user->name }}</p>
                            <p><strong>Email:</strong> {{ $bill->contract->box->user->email }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Locataire</h3>
                            <p><strong>Nom:</strong> {{ $tenant->firstname . ' ' . $tenant->lastname }}</p>
                            <p><strong>Email:</strong> {{ $tenant->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $tenant->phone }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Détails de la location</h3>
                            <p><strong>Date de début:</strong> {{ $date_start < $bill->contract->date_start ? $bill->contract->date_start : $date_start->format('Y-m-d')  }}</p>
                            <p><strong>Date de fin:</strong> {{ $date_end > $bill->contract->date_end ? $bill->contract->date_end : $date_end->format('Y-m-d') }}</p>
                            <p><strong>Montant:</strong> {{ $bill->contract->price ? $bill->contract->price : $bill->contract->box->price }} €</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
