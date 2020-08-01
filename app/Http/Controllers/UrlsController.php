<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Url;
use Illuminate\Support\Str;



class UrlsController extends Controller
{
    public function create(){

        return view('welcome');
    }

    /**Method Injection va chercher la class Request */
    public function store(Request $request){

        $url = $request->get('url');
        
        // valider l'url on va utiliser methode Validate qui extends de Controller
        $this->validate($request, ['url' => 'required|url']); // | permet de separer les differentes regles

        //Verfier si URL a déja été racourcie return url si c le cas
        $record = Url::whereUrl($url)->first();
        if($record){
            return view('result')->withShortened( $record->shortened); 
        }

        //Creer un short random
        function getUniqueShortUrl(){
            $shortened = Str::random(5);

            if(Url::whereShortened($shortened)->count() > 0){
                return getUniqueShortUrl();
            }

            return $shortened;
        }
        // Sinon si creer une nouvel short url et return shor url
        $row = Url::create([
            'url' => $url,
            'shortened' => getUniqueShortUrl()
        ]);

        if($row){
            return view('result')->withShortened( $row->shortened); 
        }else{
            return dd('error');
        }
        // Felicitation voici l'url raccourcie
    }
    


    public function show($shortened)
    {
        /**L'exception sera retourner via Handler.php function render */
        $url = Url::whereShortened($shortened)->firstOrFail(); //On utilise Eloquent pour aller chercher le premier resultat url qui sera passer  Sinon on Throw une Exception
            return redirect($url->url); //Une autre maniéere sans utiliser les facades
        
    }
}
