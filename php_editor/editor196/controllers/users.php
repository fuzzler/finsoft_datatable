<?php

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;


$update = "Y-m-d";
$registered = "Y-m-d";

// if ( ! isset($_POST['site']) || ! is_numeric($_POST['site']) ) {
//     echo json_encode( [ "data" => [] ] );
// }
// else {
    $editor = Editor::inst( $db, 'users' )
        ->field(
            Field::inst( 'users.id' )
                ->validator( Validate::notEmpty( ValidateOptions::inst()
                    ->message( 'ID richiesto' )	
                ) ),
            Field::inst( 'users.title' )
                ->validator( Validate::notEmpty( ValidateOptions::inst()
                    ->message( 'ID richiesto' )	
                ) ),
            Field::inst( 'users.first_name' )
                ->validator( Validate::notEmpty( ValidateOptions::inst()
                    ->message( 'Nome richiesto' )	
                ) ),
            Field::inst( 'users.last_name' )
                ->validator( Validate::notEmpty( ValidateOptions::inst()
                    ->message( 'Cognome richiesto' )	
                ) ),
            Field::inst( 'users.phone' )
                ->validator( Validate::notEmpty( ValidateOptions::inst()
                    ->message( 'Telefono richiesto' )	
                ) ),
            Field::inst( 'users.updated_date' )
                ->validator( Validate::dateFormat(
                    $update,
                    ValidateOptions::inst()
                        ->allowEmpty( false )
                ) )
                ->getFormatter( Format::dateSqlToFormat( $update ) )
                ->setFormatter( Format::dateFormatToSql( $update ) ),
            Field::inst( 'users.registered_date' )
                ->validator( Validate::dateFormat( $registered ) )
                ->getFormatter( Format::dateSqlToFormat( $registered ) )
                ->setFormatter( Format::dateFormatToSql( $registered ) ),
            // Field::inst( 'users.site' ),
                // ->options( 'sites', 'id', 'name' ),
            //     ->validator( 'Validate::dbValues' ),
            // campo join
            Field::inst( 'sites.name' )
        )
        ->leftJoin( 'sites', 'sites.id', '=', 'users.site' )
        // ->where( 'site', 'users.site' ) // $_POST['site']
        ->process($_POST)
        ->json();
// }

// var_dump($editor);
