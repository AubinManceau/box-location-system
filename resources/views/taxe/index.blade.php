<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes impôts</h2>
                </div>
                <div class="p-6 text-gray-900">
                    @if ($annualTurnover == 0)
                        <p class="text-center">Vous n'avez généré aucune facture ou reçu aucun paiement</p>
                    @else
                        <table class="w-full table-auto text-center">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2 border">Régime</th>
                                    <th class="p-2 border">Revenu {{ $year }}</th>
                                    <th class="p-2 border">Déclaration</th>
                                    <th class="p-2 border">Montant imposable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="p-2 border">{{ $annualTurnover >= 15000 ? 'réel' : 'micro-foncier' }}</td>
                                    <td class="p-2 border">{{ $annualTurnover }} €</td>
                                    <td class="p-2 border">{{ $annualTurnover >= 15000 ? 'case 4 BA déclaration n°2044' : 'case 4 BE déclaration n°2042' }}</td>
                                    <td class="p-2 border">{{ $annualTurnover >= 15000 ? $annualTurnover : $annualTurnover * 0.7 }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
