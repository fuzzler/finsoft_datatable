<?php
// require 'vendor/autoload.php';
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
$editor = Editor::inst( $db, 'cities' )
    ->fields(
        // Campo ID automaticamente gestito dal DB
        Field::inst( 'cities.id' )->set( false ),
            // ->validator( Validate::numeric() ),
        Field::inst( 'cities.name' )
            ->validator( Validate::notEmpty( 
                ValidateOptions::inst()->message( 'Nome città richiesto' )	
            ) ),
        Field::inst( 'cities.province' )
            ->options( Options::inst()
                ->table( 'provinces' )
                ->value( 'id' )
                ->label( 'name' )
            )
            ->validator( Validate::dbValues(),Validate::notEmpty( 
                ValidateOptions::inst()->message( 'Procincia richiesta' )	
            ) ),
        Field::inst( 'cities.description' ), // puo essere null            
            
        // campo join
        Field::inst( 'provinces.name' )
    )
    ->leftJoin( 'provinces', 'provinces.id', '=', 'cities.province' )
    ->process($_POST)
    ->json();
   