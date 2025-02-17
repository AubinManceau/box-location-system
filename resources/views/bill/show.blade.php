<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Ma facture</h2>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="max-w-2xl mx-auto p-6 rounded-lg">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Facture</h2>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Loueur</h3>
                            <p><strong>Nom:</strong> {{ $bill->contract->box->user->name }}</p>
                            <p><strong>Email:</strong> {{ $bill->contract->box->user->email }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Locataire</h3>
                            <p><strong>Nom:</strong> {{ $bill->contract->box->tenant->firstname . ' ' . $bill->contract->box->tenant->lastname }}</p>
                            <p><strong>Email:</strong> {{ $bill->contract->box->tenant->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $bill->contract->box->tenant->phone }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Détails de la location</h3>
                            <p><strong>Date de début:</strong> 01/03/2025</p>
                            <p><strong>Date de fin:</strong> 07/03/2025</p>
                            <p><strong>Prix:</strong> 500€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
