<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Périodes
 * @copyright  2019
 * @author     Rainer
 * @licence    GNU/GPL v3
 * @package    SPIP\Periodes\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function periodes_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['periodes'] = 'periodes';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function periodes_declarer_tables_objets_sql($tables) {

	$tables['spip_periodes'] = array(
		'type' => 'periode',
		'principale' => 'oui',
		'field'=> array(
			'id_periode'         => 'bigint(21) NOT NULL',
			'titre'              => 'varchar(255) NOT NULL DEFAULT ""',
			'descriptif'         => 'text NOT NULL',
			'type'               => 'varchar(20) NOT NULL DEFAULT ""',
			'criteres'           => 'varchar(10) NOT NULL DEFAULT ""',
			'operateur'          => 'varchar(3) NOT NULL DEFAULT ""',
			'operateur_2'        => 'varchar(3) NOT NULL DEFAULT ""',
			'date_debut'         => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'date_fin'           => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'jour_debut'         => 'int(1) NOT NULL DEFAULT "0"',
			'jour_fin'           => 'int(1) NOT NULL DEFAULT "0"',
			'jour_nombre'        => 'int(11) NOT NULL DEFAULT "0"',
			'jour'               => 'varchar(2) NOT NULL DEFAULT ""',
			'mois'               => 'varchar(2) NOT NULL DEFAULT ""',
			'annee'              => 'varchar(4) NOT NULL DEFAULT ""',
			'date'               => 'datetime NOT NULL DEFAULT "0000-00-00 00:00:00"',
			'maj'                => 'TIMESTAMP'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id_periode',
		),
		'titre' => 'titre AS titre, "" AS lang',
		'date' => 'date',
		'champs_editables'  => array('jour', 'mois', 'annee'),
		'champs_versionnes' => array('jour', 'mois', 'annee'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),


	);

	return $tables;
}
