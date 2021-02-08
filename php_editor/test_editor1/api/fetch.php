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
        // Campo ID automaticamente gestito dal DB
        Field::inst( 'users.id' )->set( false ),
            // ->validator( Validate::numeric() ),
        Field::inst( 'users.username' )
            ->validator( Validate::notEmpty( 
                ValidateOptions::inst()->message( 'Username richiesto' )	
            ) ),
        Field::inst( 'users.name' ), // puo essere null
        Field::inst( 'users.email' )
            ->validator( Validate::email( 
                ValidateOptions::inst()
                ->message('Inserisci un indirizzo email valido!' )  
            )),
            
        Field::inst( 'users.city' )
            ->options( Options::inst()
                ->table( 'cities' )
                ->value( 'id' )
                ->label( 'name' )
            )
            ->validator( Validate::dbValues() ),

        Field::inst( 'cities.name' )
    )
    ->leftJoin( 'cities', 'cities.id', '=', 'users.city' )
    ->process($_POST)
    ->json();
   