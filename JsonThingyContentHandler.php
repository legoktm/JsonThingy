<?php
/**
 * JSON Schema Content Handler
 *
 * @file
 * @ingroup Extensions
 * @ingroup EventLogging
 *
 * @author Ori Livneh <ori@wikimedia.org>
 */

class JsonThingyContentHandler extends TextContentHandler {

	public function __construct( $modelId = 'JsonThingy' ) {
		parent::__construct( $modelId, array( CONTENT_FORMAT_JSON ) );
	}

	/**
	 * Unserializes a JsonSchemaContent object.
	 *
	 * @param string $text Serialized form of the content
	 * @param null|string $format The format used for serialization
	 *
	 * @return Content the JsonSchemaContent object wrapping $text
	 */
	public function unserializeContent( $text, $format = null ) {
		$this->checkFormat( $format );
		return new JsonThingyContent( $text );
	}

	/**
	 * Creates an empty JsonSchemaContent object.
	 *
	 * @return Content
	 */
	public function makeEmptyContent() {
		return JsonThingyContent::newEmptyContent();
	}

	/** JSON Schema is English **/
	public function getPageLanguage( Title $title, Content $content = null ) {
		return wfGetLangObj( 'en' );
	}

	/** JSON Schema is English **/
	public function getPageViewLanguage( Title $title, Content $content = null ) {
		return wfGetLangObj( 'en' );
	}
}
