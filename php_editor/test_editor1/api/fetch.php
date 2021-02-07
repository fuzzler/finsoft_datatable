<?php
// require 'vendor/autoload.php';
include( "../vendor/datatables.net/editor-php/DataTables.php" );

use
    DataTables\Database,
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;
 


// Editor tabella staff_newyork
$editor = Editor::inst( $db, 'users' )
    ->fields(
        Field::inst( 'users.id' ),
            // ->validator( Validate::notEmpty( ValidateOptions::inst()
            //     ->message( 'ID richiesto' )	
            // ) ),
        Field::inst( 'users.username' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Username richiesto' )	
            ) ),
        Field::inst( 'users.name' )
            ->validator( Validate::notEmpty( 
                ValidateOptions::inst()->allowEmpty( false )	
            ) ),
        Field::inst( 'users.email' )
            ->validator( Validate::notEmpty( 
                ValidateOptions::inst()->allowEmpty( false )	
            ) ),
        Field::inst( 'users.city' )
            ->validator( Validate::numeric( 
                ValidateOptions::inst()->allowEmpty( false )
                ->message( 'Città richiesto' )	
            ) ),
        // campo join
        Field::inst( 'cities.name' )
    )
    ->leftJoin( 'cities', 'cities.id', '=', 'users.city' )
    ->process($_POST)
    ->json();
   