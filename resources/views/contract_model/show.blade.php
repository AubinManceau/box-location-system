<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>  
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <form action="{{ route('contract_model.update', ['id' => $contract_model->id]) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du modèle</label>
                            <input type="text" name="name" id="name" value="{{ $contract_model->name }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <div id="editorjs" class="mt-1 border border-gray-300 rounded-md w-full"></div>
                            <input type="hidden" name="contract_description" id="contract_description" value="{{ $contract_model->contract_description }}">
                        </div>

                        <a href="{{ route('contract_model.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">retour</a>

                        <x-primary-button class="mt-4">
                            {{ __('Modifier le modèle') }}
                        </x-primary-button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">
    document.addEventListener("DOMContentLoaded", function () {      
        const existingContent = document.getElementById("contract_description").value;
        
        let editor = new EditorJS({
            holder: "editorjs",
            tools: { 
                header: Header, 
                list: EditorjsList 
            },
            onChange: () => {
                saveEditorData();
            },
            data: existingContent ? JSON.parse(existingContent) : {}
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
