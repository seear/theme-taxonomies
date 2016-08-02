<?php

$taxonomies = array( 'theme_color', 'theme_column', 'theme_feature', 'theme_layout', 'theme_subject', 'theme_style' );
$table = array();

foreach( $taxonomies as $taxonomy ) {
	$url = "https://public-api.wordpress.com/rest/v1.1/sites/theme.wordpress.com/taxonomies/$taxonomy/terms";
	$ch = curl_init( $url );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = json_decode( curl_exec( $ch ), true );
	curl_close( $ch );

	$slugs = array_map( function( $term ) {
		return $term['slug'];
	}, $result['terms'] );
	$table[ $taxonomy ] = $slugs;
}

print( json_encode( $table, JSON_PRETTY_PRINT ) );



  