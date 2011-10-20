<?php

$image_name = './' . $_GET[ 'image_name' ];

$output_width = $_GET[ 'width' ];
$output_height = $_GET[ 'height' ];

$types = array(
	'jpeg' => 'image/jpeg',
	'gif' => 'image/gif',
	'png' => 'image/png',
);

if( preg_match( "~.*\.(gif|jpg|jpeg|png)~Ui", $image_name, $matches ) ){

	$format = $matches[ 1 ];
	if( $format == 'jpg' ){
		$format = 'jpeg';
	}
	switch( $format ){
		case 'gif':{
			$image = imagecreatefromgif( $image_name );
			break;
		}
		case 'jpeg':{
			$image = imagecreatefromjpeg( $image_name );
			break;
		}
		case 'png':{
			$image = imagecreatefrompng( $image_name );
			break;
		}
	}

	// obtain source image dimensions
	list( $width, $height, $type ) = getimagesize( $image_name );

	// By default, w/h are the same as the requested output size
	$new_height = $output_height;
	$new_width = $output_width;

	// Do we have to shrink it horizontally or vertically?
	$ratio_current = $width / $height;
	$ratio_output = $output_width / $output_height;
	if( $ratio_current > $ratio_output ){
		// New ratio is wider/shorter than old
		$new_height = $height / ( $width / $output_width );
	} elseif ( $ratio_current < $ratio_output ) {
		// New ratio is taller/thinner than old
		$new_width = $width / ( $height / $output_height );
	}

	// Create a blank image
	$target = imagecreatetruecolor
	(
		$new_width,
		$new_height
	);

	// Copy resized image into blank image
	imagecopyresampled( $target, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

	// Clean up in-memory objects
	imagedestroy( $image );

	header("Content-Type: " . $types[ $format ]);

	imagejpeg($target);
}
?>