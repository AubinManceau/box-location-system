<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes factures</h2>
                </div>
                <div class="p-6 text-gray-900">
                    <table class="w-full table-auto text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 border">Box</th>
                                <th class="p-2 border">Locataire</th>
                                <th class="p-2 border">Montant</th>
                                <th class="p-2 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($contracts as $contract)
                            <tr class="border-b">
                                <td class="p-2 border">{{ $contract->box->name }}</td>
                                <td class="p-2 border">{{ $contract->tenant->firstname . ' ' .  $contract->tenant->lastname }}</td>
                                <td class="p-2 border">{{ $contract->price ? $contract->price : $contract->box->price }} €</td>
                                <td class="p-2 border">
                                    @if (!\App\Models\Bill::where('contract_id', $contract->id)->whereBetween('created_at', [$date_start->copy()->addMonth(), $date_end->copy()->addMonth()])->exists())
                                    <span
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'generate_bill_{{ $contract->id }}')"
                                        class="py-2 px-4 rounded-md bg-blue-800 text-white uppercase cursor-pointer text-xs"
                                    >{{ __('Générer la facture') }}</span>

                                    <x-modal name="generate_bill_{{ $contract->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                        <form method="post" action="{{ route('bill.create')}}" class="p-6 text-left">
                                            @csrf

                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __("Générer la facture") }}
                                            </h2>

                                            <div class="mt-4">

                                                <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                                                <label for="date_start">{{ __('Date de début de la facture') }}</label>
                                                <input id="date_start" class="block mt-1 w-full rounded-md" type="date" name="date_start" 
                                                value="{{ $date_start < $contract->date_start ? $contract->date_start : $date_start->format('Y-m-d') }}" readonly/>

                                                <label for="date_end" class="mt-2">{{ __('Date de fin de la facture') }}</label>
                                                <input id="date_end" class="block mt-1 w-full rounded-md" type="date" name="date_end" value="{{ $date_end > $contract->date_end ? $contract->date_end : $date_end->format('Y-m-d') }}" readonly></input>

                                                <label for="payment_amount" class="mt-2">{{ __('Montant') }}</label>
                                                <input id="payment_amount" class="block mt-1 w-full rounded-md" type="number" step=".01" min="0" name="payment_amount" value="{{ $contract->price ? $contract->price : $contract->box->price }}" required/>

                                                <label for="period_number" class="mt-2">{{ __('Nombre de mois depuis le début de la location') }}</label>
                                                <input id="period_number" class="block mt-1 w-full rounded-md" type="number" min="1" name="period_number" value="{{ $contract->bills->count() + 1 }}" readonly/>

                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('annuler') }}
                                                </x-secondary-button>

                                                <x-primary-button class="ms-3">
                                                    {{ __('Générer la facture') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                    @else
                                    @php
                                        $bill = \App\Models\Bill::where('contract_id', $contract->id)->whereBetween('created_at', [$date_start->copy()->addMonth(), $date_end->copy()->addMonth()])->first();
                                    @endphp
                                    <a href="{{ route('bill.show', ['id' => $bill->id]) }}" class="py-2 px-7 rounded-md bg-blue-400 text-white uppercase cursor-pointer text-xs">{{ __('Voir la facture') }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
