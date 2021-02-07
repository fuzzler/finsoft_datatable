<?php
include( "../lib/DataTables.php" );

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
$editor = Editor::inst( $db, 'staff_newyork' )
    ->fields(
        Field::inst( 'id' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'ID richiesto' )	
            ) ),
        Field::inst( 'first_name' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Nome richiesto' )	
            ) ),
        Field::inst( 'last_name' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Cognome richiesto' )	
            ) ),
        Field::inst( 'phone' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Telefono richiesto' )	
            ) ),
        Field::inst( 'city' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Città richiesta' )	
            ) )
        
    )
    ->process( $_POST )
    ->debug(true)
    ->json(); // stampa il json della tabella