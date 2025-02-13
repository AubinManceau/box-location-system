<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContractModel>
 */
class ContractModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contract = '{"time":1739442402056,"blocks":[{"id":"LRxaVvLMqs","type":"header","data":{"text":"CONTRAT DE LOCATION D’UN BOX DE STOCKAGE","level":1}},{"id":"zLJLk6EeKZ","type":"header","data":{"text":"ENTRE LES SOUSSIGNÉS :","level":2}},{"id":"ucQLQrmsft","type":"paragraph","data":{"text":"Le Bailleur :\n"}},{"id":"aTONEm7HmG","type":"list","data":{"style":"unordered","meta":{},"items":[{"content":"Nom : %user_name%","meta":{},"items":[]},{"content":"E-mail : %user_email%","meta":{},"items":[]}]}},{"id":"3qRKbqSpIH","type":"header","data":{"text":"ET","level":2}},{"id":"546xRkmEjX","type":"paragraph","data":{"text":"Le Locataire :\n"}},{"id":"ljTAMHJnSh","type":"list","data":{"style":"unordered","meta":{},"items":[{"content":"Nom : %tenant_name%","meta":{},"items":[]},{"content":"Adresse : %tenant_adress%","meta":{},"items":[]},{"content":"Téléphone : %tenant_phone%","meta":{},"items":[]},{"content":"E-mail : %tenant_email%","meta":{},"items":[]}]}},{"id":"F6g4x42Kjd","type":"header","data":{"text":"IL A ÉTÉ CONVENU CE QUI SUIT :","level":2}},{"id":"RE3Fx8nRZg","type":"header","data":{"text":"ARTICLE 1 – OBJET DU CONTRAT","level":3}},{"id":"e7QHa4YYjm","type":"paragraph","data":{"text":"Le présent contrat a pour objet la location d’un box de stockage situé à l’adresse suivante : %box_adress% et identifié sous le numéro %box_id%."}},{"id":"UFlSiiHxqg","type":"header","data":{"text":"ARTICLE 2 – DURÉE","level":3}},{"id":"If1aoPgsaz","type":"paragraph","data":{"text":"La location est conclue pour une durée de %contract_month_time% mois à compter du %contract_date% et se renouvelle tacitement."}},{"id":"HM4iPw9nOA","type":"header","data":{"text":"ARTICLE 3 – LOYER ET MODALITÉS DE PAIEMENT","level":3}},{"id":"70uLjO5jb6","type":"paragraph","data":{"text":"Le montant du loyer est fixé à %contract_rent% € par mois, par virement bancaire."}},{"id":"LMuRXuoep7","type":"header","data":{"text":"ARTICLE 4 – UTILISATION DU BOX","level":3}},{"id":"SwMcKnKSrN","type":"paragraph","data":{"text":"Le locataire s’engage à utiliser le box uniquement pour le stockage de biens licites et non dangereux. Il est interdit d’y entreposer des produits inflammables, explosifs, périssables ou prohibés par la loi."}},{"id":"oFR8y5kyAb","type":"header","data":{"text":"ARTICLE 5 – RESPONSABILITÉ","level":3}},{"id":"DAYOQ3pE1H","type":"paragraph","data":{"text":"Le locataire est responsable des biens stockés et s’engage à souscrire une assurance couvrant les risques éventuels (vol, incendie, dégâts des eaux, etc.)."}},{"id":"twBvPozcaV","type":"header","data":{"text":"ARTICLE 6 – DROIT APPLICABLE","level":3}},{"id":"nllQygBLJM","type":"paragraph","data":{"text":"Le présent contrat est soumis au droit français. En cas de litige, les parties conviennent de rechercher une solution amiable avant toute action judiciaire."}},{"id":"Dz5xF9jCva","type":"paragraph","data":{"text":"Fait à ......................., le ..../..../........ En deux exemplaires."}},{"id":"p3kAoSfPW7","type":"paragraph","data":{"text":"Le Bailleur&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Le Locataire"}},{"id":"dqkg7E9ipK","type":"paragraph","data":{"text":"[Signature]&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[Signature]"}}],"version":"2.31.0-rc.7"}';
        return [
            'name' => 'Contrat de location',
            'contract_description' => $contract,
            'user_id' => 1,
        ];
    }
}
