<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-6">
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Mes modèles de contrat</h2>
                    <span
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-contract')"
                        class="py-2 px-6 rounded-lg bg-gray-800 text-white uppercase cursor-pointer"
                    >{{ __('Ajouter un modèle') }}</span>

                    <x-modal name="create-contract" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('contract_model.create') }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __("Ajouter un modèle de contrat à votre liste") }}
                            </h2>

                            <div class="mt-4 mb-4">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du modèle</label>
                                    <input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                                </div>

                                <div class="mb-4">
                                    <div id="editorjs" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></div>
                                    <input type="hidden" name="contract_description" id="contract_description" required>
                                </div>
                            </div>



                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('annuler') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Ajouter un modèle') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
                <div class="p-6 text-gray-900">
                    @foreach ($contract_models as $contract_model)
                        <div class="mb-4 border-2 border-gray-800 p-3 rounded-md flex justify-between">
                            <h2 class="text-2xl font-bold">{{ $contract_model->name }}</h2>
                            <div class="flex">
                                <a href="{{ route('contract_model.show', ['id' => $contract_model->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"> Voir plus </a>
                                <form action="{{ route('contract_model.destroy', ['id' => $contract_model->id]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <input type="hidden" name="id" value="{{ $contract_model->id }}">
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

<script>
    document.addEventListener("DOMContentLoaded", function () {      
        let editor = new EditorJS({
            holder: "editorjs",
            onChange: () => {
                saveEditorData();
            }
        });

        function saveEditorData() {
            editor.save().then((outputData) => {
                document.getElementById("contract_description").value = JSON.stringify(outputData);
            }).catch((error) => {
                console.error("Erreur lors de la sauvegarde de l'éditeur :", error);
            });
        }

        document.querySelector("form").addEventListener("submit", function (event) {
            event.preventDefault();
            editor.save().then((outputData) => {
                document.getElementById("contract_description").value = JSON.stringify(outputData);
                this.submit();
            }).catch((error) => {
                console.error("Erreur lors de la récupération des données :", error);
            });
        });
    });
</script>