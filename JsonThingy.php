<?php

/**
 * Just a really simple shell for creating
 * a JSON-based ContentHandler application
 *
 * Ripped out of the EventLogging extension
 *
 * You should be able to replace "Thingy" with
 * whatever you want and most things will work.
 */

define( 'NS_THINGY', 656 );  // You should probably replace these numbers
define( 'NS_THINGY_TALK', 657 );

$wgContentHandlers[ 'JsonThingy' ] = 'JsonThingyContentHandler';
$wgNamespaceContentModels[ NS_THINGY ] = 'JsonThingy';

$wgHooks[ 'CanonicalNamespaces' ][] = function ( &$namespaces ) {
	$namespaces[ NS_THINGY ] = 'Thingy';
	$namespaces[ NS_THINGY_TALK ] = 'Thingy_talk';
};
$wgHooks[ 'EditFilterMerged' ][] = 'JsonThingyHooks::onEditFilterMerged';
$wgHooks[ 'CodeEditorGetPageLanguage' ][] = 'JsonThingyHooks::onCodeEditorGetPageLanguage';

$wgAutoloadClasses += array(
	// Hooks
	'JsonThingyHooks'   => __DIR__ . '/JsonThingyHooks.php',
	// ContentHandler
	'JsonThingyContent'        => __DIR__ . '/JsonThingyContent.php',
	'JsonThingyContentHandler' => __DIR__ . '/JsonThingyContentHandler.php',
);

/**
 * Takes a string of JSON data and formats it for readability.
 * Stolen from EventLogging
 * @param string $json
 * @return string|null: Formatted JSON or null if input was invalid.
 */
if ( !function_exists( 'efBeautifyJson' ) ) {
	function efBeautifyJson( $json ) {
		$decoded = FormatJson::decode( $json, true );
		if ( !is_array( $decoded ) ) {
			return NULL;
		}
		return FormatJson::encode( $decoded, true );
	}
}

// This should probably be moved somewhere else....
class JsonThingyException extends Exception {
	public $subtype;
	// subtypes: "validate-fail", "validate-fail-null"
}
