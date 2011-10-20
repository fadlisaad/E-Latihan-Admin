<?php

$directory = getcwd();

$directories = array();
getListOfDirectories( $directories, $directory );

// Max width of image thumbnail
$max_width = 150;
// Max height of image thumbnail
$max_height = 150;
// Max number of images per row of the table
$images_per_row = 4;

$directories = array_flip($directories);
foreach( $directories as $directory => $foo){
	$directories[ $directory ] = array();
	$directory_reader = dir($directory);
	// Get a list of images
	while (false !== ($filename = $directory_reader->read())) {
		if( preg_match( "~.*\.(gif|jpg|jpeg|png)~Ui", $filename, $matches ) ){
			$directories[ $directory ][] = $filename;
		}
	}
	$directory_reader->close();
}

function getListOfDirectories( &$directories, $current_directory ){
	$directories[] = $current_directory;
	$directory_reader = dir($current_directory);
	while (false !== ($filename = $directory_reader->read())) {
		if( is_dir( $current_directory . '/' . $filename ) && $filename[0] != '.'){
			getListOfDirectories( $directories, $current_directory . '/' . $filename );
		}
	}
}
?> 

<html>
	<body>
		<table border="1">
<?php

// Render the images in their rows
foreach( $directories as $directory => $images ){
	$directory = substr( $directory, strlen( getcwd() ) + 1 );
	echo (
		str_replace
		(
			array(
				'[[images_per_row]]',
				'[[directory_name]]',
			),
			array(
				$images_per_row,
				($directory)?$directory:'[[current]]'
			),
			'<tr><td colspan="[[images_per_row]]"><b>[[directory_name]]</b></td></tr>' 
		)
	);
	$rows = ceil(count($images)/$images_per_row);
	for( $y = 0; $y < $rows; $y++ ){
		echo( '<tr>' );
			for( $x = 0; $x < $images_per_row; $x++ ){
				$index = $x + ( $y * $images_per_row );
				if( $index < count( $images ) ){
					echo
					( 
						str_replace
						(
							array( 
								'[[path]]',
								'[[image_name]]',
								'[[width]]',
								'[[height]]'
							),
							array(
								(($directory)?$directory.'/':''),
								$images[ $index ],
								$max_width,
								$max_height
							),
							'<td><a href="[[path]][[image_name]]"><img border="0" src="get_image.php?image_name=[[path]][[image_name]]&width=[[width]]&height=[[height]]"><br>[[image_name]]</a></td>'
						)
					);
				}
			}
			echo( '</tr>' );
	}
}
?>
		</table>
	</body>
</html>