<?php
/**
 * Gestion du formulaire de d'édition de periode
 *
 * @plugin     Périodes
 * @copyright  2019
 * @author     Rainer
 * @licence    GNU/GPL v3
 * @package    SPIP\Periodes\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/actions');
include_spip('inc/editer');

function formulaires_editer_periode_saisies_dist() {

	// Les jours de la semaine
	$jours_semaines = array();
	for ($i = 0; $i < 7; $i++) {
		$jour = $i + 1;
		$jours_semaines[] = _T('spip:date_jour_' . $jour);
	}

	// Les jours de mois.
	$jours = [];
	for ($i = 1; $i <= 31; $i++) {
		$jours[] = $i;
	}

	// Les mopis d'une année.
	$mois = [];
	for ($i = 1; $i <= 12; $i++) {
		$mois[] = $i;
	}


	$operateurs = array(
		htmlspecialchars('==') => '==',
		htmlspecialchars('!=') => '!=',
		htmlspecialchars('<') => '<',
		htmlspecialchars('<=') => '<=',
		htmlspecialchars('>') => '>',
		htmlspecialchars('>=') => '>=',
	);

	return array(
		array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'titre',
				'obligatoire' => 'oui',
				'datas' => $statuts,
				'cacher_option_intro' => 'on',
				'label' => _T('ecrire:info_titre'),
			)
		),
		array(
			'saisie' => 'textarea',
			'options' => array(
				'nom' => 'descriptif',
				'label' => _T('ecrire:info_descriptif'),
				'conteneur_class' => 'pleine_largeur',
				'class' => 'inserer_barre_edition',
				'rows' => 4
			)
		),
		array(
			'saisie' => 'radio',
			'options' => array(
				'obligatoire' => 'oui',
				'nom' => 'type',
				'label' => _T('periode:champ_type_label'),
				'data' => array(
					'date' => _T('periode:type_date'),
					'jour_semaine' => _T('periode:type_jour_semaine'),
					//'jour_nombre' => _T('po_periode:type_jour_nombre'),
				)
			),
		),
		array(
			'saisie' => 'selection',
			'options' => array(
				'nom' => 'criteres',
				'label' => _T('periode:champ_criteres_label'),
				'obligatoire' => 'oui',
				'data' => array(
					'coincide' => _T('periode:choix_coincide_label'),
					'exclu' => _T('periode:choix_exclu_label'),
					//'specifique' => _T('po_periode:choix_specifique_label'),
				),
				'afficher_si' => '@type@ == "date" || @type@ == "jour_semaine"',
			)
		),
		/*array(
			'saisie' => 'selection',
			'options' => array(
				'nom' => 'operateur',
				'label' => _T('po_periode:champ_operateur_label'),
				'data' => $operateurs,
				'afficher_si' => '(@type@ == "date" || @type@ == "jour_nombre") && @criteres@ == "specifique"',
			)
		),*/
		array(
			'saisie' => 'oui_non',
			'options' => array(
				'obligatoire' => 'oui',
				'nom' => 'date_complete',
				'label' => _T('periode:champ_date_complete_label'),
				'explication' => _T('periode:explication_date_complete_label'),
				'afficher_si' => '@type@ == "date"',
				'defaut' => 'on',
			),
		),
		array(
			'saisie' => 'date',
			'options' => array(
				'nom' => 'date_debut',
				'label' => _T('dates_outils:champ_date_debut_label'),
				'afficher_si' => '@type@ == "date" && @date_complete@ == "on"',
			)
		),
		/*array(
			'saisie' => 'selection',
			'options' => array(
				'nom' => 'operateur_2',
				'label' => _T('po_periode:champ_operateur_label'),
				'data' => $operateurs,
				'afficher_si' => '@type@ == "date" && @criteres@ == "specifique"',
			)
		),*/
		array(
			'saisie' => 'date',
			'options' => array(
				'nom' => 'date_fin',
				'label' => _T('dates_outils:champ_date_fin_label'),
				'afficher_si' => '@type@ == "date" && @date_complete@ == "on"',
			)
		),
		[
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'date_debut_selection',
				'label' => _T('dates_outils:champ_date_debut_label'),
				'afficher_si' => '@type@ == "date" && @date_complete@ == ""',

			),
			'saisies' => [
				[
					'saisie' => 'selection',
					'options' => [
						'nom' => 'date_debut_jour',
						'label' => _T('periode:champ_jour_label'),
						'data' => $jours,
						'option_intro' => '*',
					]
				],
				[
					'saisie' => 'selection',
					'options' => [
						'nom' => 'date_debut_mois',
						'label' => _T('periode:champ_mois_label'),
						'data' => $mois,
						'option_intro' => '*',
					]
				],
				[
					'saisie' => 'input',
					'options' => [
						'nom' => 'date_debut_annee',
						'label' => _T('periode:champ_annee_label'),
					]
				],
			],
		],
		[
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'date_fin_selection',
				'label' => _T('dates_outils:champ_date_fin_label'),
				'afficher_si' => '@type@ == "date" && @date_complete@ == ""',
			),
			'saisies' => [
				[
					'saisie' => 'selection',
					'options' => [
						'nom' => 'date_fin_jour',
						'label' => _T('periode:champ_jour_label'),
						'data' => $jours,
						'option_intro' => '*',
					]
				],
				[
					'saisie' => 'selection',
					'options' => [
						'nom' => 'date_fin_mois',
						'label' => _T('periode:champ_mois_label'),
						'data' => $mois,
						'option_intro' => '*',
					]
				],
				[
					'saisie' => 'input',
					'options' => [
						'nom' => 'date_fin_annee',
						'label' => _T('periode:champ_annee_label'),
					]
				],
			],
		],
		array(
			'saisie' => 'selection',
			'options' => array(
				'nom' => 'jour_debut',
				'label' => _T('periode:champ_jour_debut_label'),
				'data' => $jours_semaines,
				'afficher_si' => '@type@ == "jour_semaine"',
			)
		),
		array(
			'saisie' => 'selection',
			'options' => array(
				'nom' => 'jour_fin',
				'label' => _T('periode:champ_jour_fin_label'),
				'data' => $jours_semaines,
				'afficher_si' => '@type@ == "jour_semaine"',
			)
		),
		array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'jour_nombre',
				'label' => _T('periode:champ_jour_nombre_label'),
				'afficher_si' => '@type@ == "jour_nombre"',
			)
		),
	);
}


/**
 * Identifier le formulaire en faisant abstraction des paramètres qui ne représentent pas l'objet edité
 *
 * @param int|string $id_periode
 *     Identifiant du periode. 'new' pour un nouveau periode.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un periode source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du periode, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_periode_identifier_dist($id_periode = 'new', $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	return serialize(array(intval($id_periode)));
}

/**
 * Chargement du formulaire d'édition de periode
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @uses formulaires_editer_objet_charger()
 *
 * @param int|string $id_periode
 *     Identifiant du periode. 'new' pour un nouveau periode.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un periode source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du periode, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_periode_charger_dist($id_periode = 'new', $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$valeurs = formulaires_editer_objet_charger('periode', $id_periode, '', $lier_trad, $retour, $config_fonc, $row, $hidden);

	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de periode
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @uses formulaires_editer_objet_verifier()
 *
 * @param int|string $id_periode
 *     Identifiant du periode. 'new' pour un nouveau periode.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un periode source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du periode, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_periode_verifier_dist($id_periode = 'new', $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$erreurs = array();

	$verifier = charger_fonction('verifier', 'inc');

	foreach (array('date_debut', 'date_fin') AS $champ) {
		$normaliser = null;
		if ($erreur = $verifier(_request($champ), 'date', array('normaliser'=>'datetime'), $normaliser)) {
			$erreurs[$champ] = $erreur;
		// si une valeur de normalisation a ete transmis, la prendre.
		} elseif (!is_null($normaliser)) {
			set_request($champ, $normaliser);
		// si pas de normalisation ET pas de date soumise, il ne faut pas tenter d'enregistrer ''
		} else {
			set_request($champ, null);
		}
	}

	$erreurs += formulaires_editer_objet_verifier(
		'periode', $id_periode,
		array('titre', 'type', 'criteres')
	);

	return $erreurs;
}

/**
 * Traitement du formulaire d'édition de periode
 *
 * Traiter les champs postés
 *
 * @uses formulaires_editer_objet_traiter()
 *
 * @param int|string $id_periode
 *     Identifiant du periode. 'new' pour un nouveau periode.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un periode source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du periode, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_periode_traiter_dist($id_periode = 'new', $retour = '', $lier_trad = 0, $config_fonc = '', $row = array(), $hidden = '') {
	$retours = formulaires_editer_objet_traiter('periode', $id_periode, '', $lier_trad, $retour, $config_fonc, $row, $hidden);
	return $retours;
}
