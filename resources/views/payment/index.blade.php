<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes paiments en attente</h2>
                </div>
                <div class="p-6 text-gray-900">
                    @if ($bills->isEmpty())
                        <p class="text-center">Vous n'avez aucun paiement en attente</p>
                    @else
                        <table class="w-full table-auto text-center">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2 border">Facture</th>
                                    <th class="p-2 border">Box</th>
                                    <th class="p-2 border">Locataire</th>
                                    <th class="p-2 border">Montant</th>
                                    <th class="p-2 border">Date de paiement</th>
                                    <th class="p-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bills as $bill)
                                <form action="{{ route('payment.update', ['id' => $bill->id]) }}" method="post">
                                @csrf
                                @method('put')
                                    <tr class="border-b">
                                        <td class="p-2 border underline"><a href="{{ route('bill.show', ['id' => $bill->id]) }}">{{ ($bill->created_at)->format('d-m-Y') }}</a></td>
                                        <td class="p-2 border">{{ $bill->contract->box->name }}</td>
                                        <td class="p-2 border">{{ $bill->contract->tenant->firstname . ' ' . $bill->contract->tenant->lastname }}</td>
                                        <td class="p-2 border">{{ $bill->payment_amount }} €</td>
                                        <td class="p-2 border">
                                            <input type="date" class="border-none" name="payment_date" required>
                                        </td>
                                        <td class="p-2 border">
                                            <button type="submit" class="py-2 px-4 rounded-md bg-blue-800 text-white uppercase cursor-pointer text-xs">
                                                Enregistrer le paiement
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
