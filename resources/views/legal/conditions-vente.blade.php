@extends('layout.app')

@section('title', 'Conditions de Vente - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/legal.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Conditions particulières de vente</h1>
        <nav id="titre">
            <hr />
        </nav>
        <h2>1. Inscription - Séjours packagés et séjours personnalisés</h2>
        <h3>1.1. Inscription à nos séjours packagés et séjours personnalisés</h3>
        <p>Vinotrip propose des séjours packagés ou personnalisés exclusivement via ses sites internet. Nous proposons
            des séjours assortis de prix «&nbsp;à partir de&nbsp;». Ces séjours sont une trame que vous pouvez modifier,
            en fonction de votre budget et de vos envies.<br>Quel que soit le type de séjour que vous choisissez
            (séjours packagés ou personnalisés), vous devez soumettre votre demande de devis directement sur notre site
            internet, par mail ou par téléphone auprès d'un de nos téléconseillers. Nous revenons généralement vers vous
            dans un délai de 24h, souvent par téléphone pour un premier contact, et par voie électronique par la suite
            afin de vous envoyer le devis. Les devis contiennent le programme détaillé de votre voyage et le prix
            définitif (taxes et services inclus). Concernant les séjours packagés, nous pourrons être amenés à ajuster
            les composantes du séjour (hébergement, dégustation, …) en fonction des disponibilités des prestataires aux
            dates sélectionnées&nbsp;: ces modifications vous seront indiquées dans le devis adressé.<br>Les devis ont
            une durée de validité limitée, au-delà de laquelle les différentes composantes du séjour et les tarifs
            indiqués ne pourront être maintenus. En cas de dépassement de la durée de validité de votre devis, Vinotrip
            pourra établir un nouveau devis pour votre voyage si certaines modalités, notamment tarifaires, devaient
            être modifiées.<br>Vous pourrez régler votre voyage sur notre site internet en cliquant sur le lien de
            paiement, dans le délai de validité imparti.<br>L'inscription à un voyage est considérée comme définitive à
            compter de la réception par Vinotrip de votre règlement via notre site. Les demandes de réservation ne sont
            effectivement faites qu'à réception de l'engagement financier du client.</p>
        <h3>1.2. Tarification</h3>
        <p>Le prix total et définitif sera fixé en fonction des options choisies et des dates de votre voyage, il vous
            sera communiqué lors de la réception de votre devis. <br>Seules les prestations mentionnées explicitement
            dans le descriptif du voyage font partie du forfait. Sont non compris dans le forfait (sauf stipulation
            contraire dans le descriptif du voyage) : les dépenses à caractère personnel (pourboires, téléphone, etc.),
            les excursions facultatives et d'une manière générale toute prestation non expressément incluse dans le
            descriptif du voyage. Les prestations proposées sont soumises à une réserve de disponibilité des
            Partenaires. Le cas échéant, Vinotrip se réserve le droit de proposer des prestations équivalentes.<br>Les
            démarches pour régler votre voyage sont indiquées ci-dessous.</p>
        <h3>1.3. Modalités de paiement - factures</h3>
        <p>Pour toute inscription réalisée à plus de 35 jours de la date du départ, il sera procédé à un encaissement
            par Vinotrip, d'un acompte de 30% du montant total du séjour. Pour toute inscription à moins de 35 jours de
            la date du départ, le paiement doit être effectué en une seule fois et pour la totalité du montant du
            voyage.<br>Pour régler le prix du séjour vous accédez à une plateforme de paiement sécurisé. Vous pouvez
            payer par Carte Bancaire, Visa, Carte Bleue ou Mastercard. L'inscription à l'un de nos voyages, formalisée
            par le paiement du voyage, implique l'acceptation des conditions générales et particulières de
            vente.<br>Conformément à l'article L.121-20-4 du code de la consommation, vous ne bénéficiez pas d'un délai
            de rétractation dès la commande de prestations de voyage via notre site. Votre réservation sera définitive.
            En cas de problème, nos conseillers se tiennent à votre disposition.</p>
        <h2>2. Inscription - Coffrets cadeaux et Chèques cadeaux</h2>
        <h3>2.1. Définition</h3>
        <p>Coffret(s) cadeau(x) ou Chèque(s) cadeau(x) : désigne le concept de coffret cadeau développé et exploité par
            Vinotrip.<br>Le Coffret cadeau ou Chèque cadeau est composé des éléments suivants :<br>- une présentation de
            l'offre envoyée par mail, sous format PDF&nbsp;;<br>- un carnet de route récapitulant l'ensemble des données
            nécessaires au bon déroulement du séjour (coordonnées, itinéraires, horaires…) – envoyé par mail, sous
            format PDF, une fois la date de départ fixée.<br>Partenaire&nbsp;: désigne le prestataire qui fournit la
            prestation.<br>Bénéficiaire&nbsp;: désigne la personne utilisatrice du coffret cadeau.<br>Prestation&nbsp;:
            désigne la prestation fournie par le partenaire au bénéficiaire parmi la gamme de séjours présente sur le
            site Vinotrip, sous réserve de disponibilités des partenaires aux dates choisies par le bénéficiaire.<br>
            Client&nbsp;: désigne la personne qui achète un coffret cadeau, sachant que le client peut être ou non le
            bénéficiaire de la prestation selon qu'il en fera un usage en propre ou en cadeau.<br> Il vous est proposé
            en ligne des Coffrets cadeaux et Chèques cadeaux élaborés par Vinotrip sous l'URL
            https://www.vinotrip.com/fr/11-offrir-coffret-cadeau-vin ainsi qu'en cliquant sur le bouton "Offrir ce
            séjour" sur chacune des fiches séjours sur le site internet.</p>
        <h3>2.2. Processus de passation des commandes</h3>
        <p>Vous pouvez passer vos commandes de Coffret Cadeau ou Chèque cadeau directement :<br>- soit par Internet sur
            notre site<br>- soit par téléphone : 01 85 46 00 09<br>La procédure de passation des commandes sur le site
            comporte notamment les étapes suivantes&nbsp;:<br>- pour les Coffrets Cadeaux&nbsp;: sélection d'un séjour
            via le bouton «&nbsp;Offrir ce séjour&nbsp;» ; suite à cette sélection, un récapitulatif reprenant
            l'ensemble des options choisies et le prix total du coffret, vos coordonnées et votre mode de paiement vous
            permettra de vérifier le détail de votre commande, avant l'enregistrement définitif de votre commande.<br>-
            pour les Chèques Cadeaux&nbsp;: sélection sur le site d'un montant pour le chèque à offrir, utilisable sur
            l'ensemble des séjours commercialisés en ligne sur le site Vinotrip ; suite à cette sélection, un
            récapitulatif du montant du chèque, vos coordonnées et de votre mode de paiement vous permettra de vérifier
            le détail de votre commande et ainsi d'effectuer les modifications nécessaires, avant l'enregistrement
            définitif de votre commande.<br>Dans les deux cas (Coffrets cadeaux ou Chèques cadeaux), la totalité du
            montant du cadeau sera réglée en une seule fois au moment de la commande. Pour régler le prix du séjour,
            vous accédez à une plateforme de paiement sécurisé. Vous pouvez payer par Carte Bancaire, Visa, Carte Bleue
            ou Mastercard. L'inscription à l'un de nos voyages, formalisée par le paiement du voyage, implique
            l'acceptation des conditions générales et particulières de vente.</p>
        <h3>2.3. Conditions d'utilisation des Coffrets cadeaux et Chèques cadeaux</h3>
        <p>Les coffrets cadeaux et chèques cadeaux sont activés lors de leur paiement et sont valables 18 mois à compter
            de cette date de paiement : la date de départ du séjour du bénéficiaire doit donc être antérieure à la date
            de paiement plus 18 mois.&nbsp; Ils sont valables pour ces séjours tous les jours de la semaine y compris le
            week-end, selon les disponibilités des Partenaires.<br>Les Coffrets et Chèques cadeau ne sont ni
            échangeables ni remboursables. En cas de non utilisation du Coffret cadeau ou Chèque cadeau, le Bénéficiaire
            ne pourra être remboursé ou obtenir une compensation de quelque nature que ce soit.<br>Toute demande de
            prolongation de la durée de validité d'un coffret ou d'un chèque cadeau doit avoir lieu avant la fin de
            validité de celui-ci. Dans le cas où la demande de prolongation est faite avant la fin de validité du
            coffret ou chèque cadeau, le bénéficiaire se verra remettre un avoir d'une valeur équivalente au montant
            dépensé pour l'achat de son cadeau. Cet avoir se matérialisera sous la forme d'un code promotionnel
            utilisable en ligne sur l'ensemble de nos séjours et valide pour une période complémentaire de 6 mois par
            rapport à la date de validité initialement définie. Si un différentiel existe entre le montant de l'avoir et
            le séjour choisi, aucun remboursement ne pourra être effectué. Si un complément est nécessaire, le
            bénéficiaire réglera la somme requise directement lors de sa commande. Il est à noter que le bénéficiaire
            pourra faire une demande de prolongation de la durée de validité d'un coffret ou chèque cadeau qu'une seule
            et unique fois.<br>La délivrance de la Prestation est soumise aux conditions spécifiques du Partenaire
            sélectionné, notamment en termes d'annulation ou de modification de la réservation, de limite d'âge et des
            conditions physiques du ou des Bénéficiaires. Les prestations proposées sont soumises à une réserve de
            disponibilité des Partenaires. Le cas échéant, Vinotrip se réserve le droit de proposer des prestations
            équivalentes.</p>
        <h2>3. Annulations et modifications</h2>
        <p>Si le client se trouve dans l'obligation d'annuler son voyage, il devra en informer Vinotrip, par lettre
            recommandée avec accusé de réception, dès la survenance du fait générateur de cette annulation : c'est la
            date d'envoi de cette lettre qui sera retenue comme date d'annulation pour la facturation des frais
            d'annulation.</p>
        <h3>3.1. Annulations totales demandées par le client avant le départ (hors cas particuliers 3.5)</h3>
        <p>Barème des frais d'annulation totale, sauf cas particuliers&nbsp;:<br>- plus de 61 jours avant la date de
            départ : 30% du montant total des prestations.<br>- de 60 à 31 jours avant la date de départ : 50 % du
            montant total des prestations.<br>- à partir de 30 jours avant la date de départ : 100% du montant total des
            prestations.</p>
        <h3>3.2. Annulation totale demandée par le bénéficiaire d'un coffret cadeau ou d'un chèque cadeau (hors cas
            particuliers 3.5)</h3>
        <p>Barème des frais d'annulation total, sauf cas particuliers :<br>- à partir de 30 jours avant la date de
            départ : 100% du montant du coffret / chèque cadeau. Passé ce délai de 30 jours, aucune modification ou
            annulation ne pourra être prise en compte, ni donner droit à un remboursement.<br>- plus de 31 jours avant
            la date de départ : indemnités d'annulation facturées 30€ par voyageur. Le bénéficiaire aura la possibilité
            de redéfinir une date de départ, avant la date de fin de validité de son coffret / chèque cadeau.</p>
        <h3>3.3. Annulations partielles demandées par le client ou le bénéficiaire avant le départ (hors cas
            particuliers 3.5)</h3>
        <p>Si un ou plusieurs voyageurs inscrits sur un même dossier annule(nt) leur participation à un voyage maintenu,
            le barème des frais d'annulation ci-dessus sera calculé pour le voyageur qui annule sa participation sur le
            prix des prestations nominatives et non consommées de son voyage à la date de l'annulation, à l'exclusion du
            montant total des prestations (prix total du dossier) divisé par le nombre de voyageurs ou du prix des
            prestations (hébergement, location de véhicule...) qui seront consommées et partagées par les autres
            voyageurs. En conséquence, la fraction du voyage remboursable par Vinotrip, au titre d'une annulation
            partielle, ne portera que sur des prestations individualisées et non consommées.</p>
        <h3>3.4. Modifications demandées par le client avant le départ</h3>
        <p>Toute modification ultérieure à la réservation du voyage (portant sur un itinéraire, un programme, un nom de
            client, …) sera facturée 20 € par personne.</p>
        <h3>3.5. Cas particuliers</h3>
        <p>Lorsque des hôteliers ou prestataires locaux imposent des frais d'annulation ou de modification supérieurs à
            ceux résultant des conditions de Vinotrip décrites en 3.1, 3.2, 3.3 et 3.4, ces frais sont applicables au
            client.<br>Lorsque plusieurs clients se sont inscrits sur un même dossier et que l'un d'eux annule son
            voyage, les frais d'annulation sont prélevés sur les sommes encaissées par Vinotrip pour ce dossier, quel
            que soit l'auteur du versement.<br>En cas d'annulation, pour quelque raison que ce soit, les frais
            extérieurs au voyage souscrit chez Vinotrip et engagés par le client tels que, frais de transport jusqu'au
            lieu de départ du voyage et retour au domicile, frais d'obtention des visas, documents de voyages, frais de
            vaccination ne pourront faire l'objet d'un quelconque remboursement.</p>
        <h2>4. Assurances</h2>
        <p>Aucune assurance n'est comprise dans les prestations vendues par Vinotrip. Il est recommandé au client de
            souscrire un contrat d'assurance couvrant les conséquences de certains cas d'annulation et un contrat
            d'assistance couvrant certains risques particuliers (notamment en cas d'accident ou de maladie). Il est de
            la responsabilité du client de souscrire à de tels contrats auprès de la compagnie d'assurance de son choix
            ou de son établissement bancaire.</p>
        <h2>5. Prestations terrestres et hébergements</h2>
        <h3>5.1. Prestations non utilisées ou modifiées sur place par le client</h3>
        <p>Les prestations terrestres vendues par Vinotrip qui seraient non utilisées sur place (excursions, logements,
            ...) ne donneront lieu à aucun remboursement. Les prestations volontairement modifiées sur place sont
            soumises aux conditions des prestataires locaux : les prestations supplémentaires ou de remplacement
            engendrant un surcoût devront être réglées directement aux prestataires locaux et ne pourront en aucun cas
            engager la responsabilité de Vinotrip. Elles ne donneront lieu à aucun remboursement de la partie non
            utilisée des prestations.</p>
        <h3>5.2. Photos et illustrations</h3>
        <p>Vinotrip s'efforce d'illustrer ses propositions de photos ou illustrations donnant un aperçu réaliste des
            services proposés. Il est toutefois à noter que les photos et illustrations figurant dans le descriptif
            peuvent être illustratives des services. Elles n'engagent Vinotrip que dans la mesure où elles permettent
            d'indiquer la catégorie ou le degré de standing de ces services.</p>
        <h2>6. Responsabilité</h2>
        <p>Vinotrip ne pourra être tenu pour responsable des conséquences des événements suivants :<br>Perte ou vol des
            documents de voyage.<br>Incidents ou événements imprévisibles et insurmontables d'un tiers étranger à
            Vinotrip tels que : guerres, troubles politiques, grèves extérieures à Vinotrip, incidents techniques
            extérieurs à Vinotrip, intempéries, retards (y compris les retards dans les services d'acheminement du
            courrier pour la transmission des documents de voyage), pannes, perte ou vol de bagages ou d'autres effets.
            Le ou les retards subis ayant pour origine les cas visés ci-dessus ainsi que les modifications d'itinéraire
            qui en découleraient éventuellement ne pourront entraîner aucune indemnisation à quelque titre que ce soit,
            notamment du fait de la modification de la durée du programme initialement prévu ou de retard à une
            correspondance. Les éventuels frais additionnels liés à une perturbation (taxe, hôtel, parking,...)
            resteront à la charge du client.<br>Annulation imposée par des circonstances ayant un caractère de force
            majeure et/ou pour des raisons liées à la sécurité des clients et/ou sur injonction d'une autorité
            administrative. Vinotrip se réserve le droit de modifier les dates, les horaires ou les itinéraires prévus
            s'il juge que la sécurité du voyageur ne peut être assurée et ce sans que ce dernier puisse prétendre à une
            quelconque indemnité.</p>
        <h2>7. Réclamations</h2>
        <p>Toute réclamation doit être adressée par lettre recommandée avec accusé de réception, accompagnée des pièces
            justificatives, à Vinotrip -&nbsp;9 rue Lamolinerie, Bâtiment A, 33200 Bordeaux dans les 30 jours suivant le
            retour du voyage.</p>
        <h2>8. Informatique et Libertés</h2>
        <p>Votre commande fait l'objet d'un traitement nominatif informatisé. Ces données sont destinées à Vinotrip mais
            peuvent être transmises à des tiers, en particulier aux prestataires de services, et peuvent être utilisées
            à des fins de prospection commerciale par la société Vinotrip. <br>Vous disposez d'un droit d'accès, de
            modification, de rectification et de suppression des données qui vous concernent en vous adressant par
            courrier à Vinotrip -&nbsp;9 rue Lamolinerie, Bâtiment A, 33200 Bordeaux ou par mail à contact@vinotrip.com.
        </p>
        <h2>9. Révision des conditions de vente</h2>
        <p>La version des Conditions de Vente applicables est celle en vigueur au jour de la réservation. Vinotrip se
            réserve le droit de modifier ou de mettre à jour les conditions de vente à tout moment et sans préavis (à
            noter que les conditions de vente n'ont pas d'effet rétroactif).</p>
        <p>&nbsp;<br>VINOTRIP<br>9 rue Lamolinerie 33200 Bordeaux<br>Société par Action Simplifiée au capital de
            42.033€<br>Immatriculation Atout France IM075130039<br>RCS Bordeaux 792&nbsp;620 262 - SIRET
            79262026200024<br>Garantie financière : Association Professionnelle de Solidarité du Tourisme, 15 avenue
            Carnot 75017 Paris<br>Responsabilité Civile et Professionnelle : HISCOX - contrat n°HA RCP0232580 (tous
            dommages confondus à hauteur de 1 500 000 €)</p>
        <p>Conditions particulières mises à jour le 25/07/2024</p>
    </main>
    @include('layout.footer')
@endsection
