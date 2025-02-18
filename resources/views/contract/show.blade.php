<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex gap-4 p-6 items-center">
                    <a href="{{ route('box.show', ['id' => $box->id]) }}">Retour</a>
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Contrats</h2>
                </div>
                <div class="p-6 text-gray-900">
                    @if($contracts->isEmpty())
                        <p class="text-center">Aucun contrat disponible.</p>
                    @else
                        <table class="w-full table-auto text-center">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2 border">Statut</th>
                                    <th class="p-2 border">Locataire</th>
                                    <th class="p-2 border">Prix mensuel</th>
                                    <th class="p-2 border">Date de début</th>
                                    <th class="p-2 border">Date de fin</th>
                                    <th class="p-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($contracts as $contract)
                                <tr class="border-b">
                                    <td class="p-2 border">{{ $contract->date_end < now()->format('Y-m-d') ? 'Terminé' : 'En cours' }}</td>
                                    <td class="p-2 border">{{ $contract->tenant->firstname . ' ' . $contract->tenant->lastname }}</td>
                                    <td class="p-2 border">{{ $contract->price == null ? $contract->box->price : $contract->price }} €</td>
                                    <td class="p-2 border">{{ $contract->date_start }}</td>
                                    <td class="p-2 border">{{ $contract->date_end }}</td>
                                    <td class="p-2 border flex gap-2 justify-center">
                                        <form action="{{ route('contract.destroy', ['id' => $contract->box_id]) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <input type="hidden" name="contract_id" value="{{ $contract->id }}">
                                            <x-danger-button>
                                                {{ __('Supprimer') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
