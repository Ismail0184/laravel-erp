<?php

namespace App\Providers;

use App\Models\Accounts\AccTransactions;
use App\Models\Developer\DevMainMenu;
use Illuminate\Support\ServiceProvider;
use View;
use Session;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Session::put('module_id', 'module_id');
        View::composer(['layouts.app'], function ($view) {
            $view->with('mainmenus', DevMainMenu::where('status','1')->where('module_id',\Session::get('module_id', 'module_id'))->orderBy('serial','ASC')->get());
        });

        Blade::directive('numberToWord', function ($num ='') {

            $num  = ( string ) ( ( int ) $num );

            if( ( int ) ( $num ) && ctype_digit( $num ) )
            {
                $words  = array( );

                $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

                $list1  = array('','one','two','three','four','five','six','seven',
                    'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                    'fifteen','sixteen','seventeen','eighteen','nineteen');

                $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                    'seventy','eighty','ninety','hundred');

                $list3  = array('','thousand','million','billion','trillion',
                    'quadrillion','quintillion','sextillion','septillion',
                    'octillion','nonillion','decillion','undecillion',
                    'duodecillion','tredecillion','quattuordecillion',
                    'quindecillion','sexdecillion','septendecillion',
                    'octodecillion','novemdecillion','vigintillion');

                $num_length = strlen( $num );
                $levels = ( int ) ( ( $num_length + 2 ) / 3 );
                $max_length = $levels * 3;
                $num    = substr( '00'.$num , -$max_length );
                $num_levels = str_split( $num , 3 );

                foreach( $num_levels as $num_part )
                {
                    $levels--;
                    $hundreds   = ( int ) ( $num_part / 100 );
                    $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                    $tens       = ( int ) ( $num_part % 100 );
                    $singles    = '';

                    if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }

                $words  = implode( ', ' , $words );

                $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
                if( $commas )
                {
                    $words  = str_replace( ',' , ' and' , $words );
                }
            }else if( ! ( ( int ) $num ) ){
                $words = 'Zero';
            }else{
                $words = '';
            }

            return $words;
        });
    }
}
