<?php

use Illuminate\Http\Client\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;


    function yesOrNo(bool $value = null){
        if($value == true){
            return '<span class="badge badge-success">Oui</span>';
        }else{
            return '<span class="badge badge-danger">Non</span>';
        }
    }

    function checkIfEmpty($value){
          if($value == true){
            return '<span class="badge badge-primary">'. $value.'</span>';
        }else{
            return '<span class="badge badge-secondary"> Donnée manquante </span>';
        }
    }

    function checkRequired($elements = []){

        foreach ($elements as $key => $element) {
            if(empty($element) || is_null($element)){
                return response()->json(['message'=> sprintf('Paramètre requis manquant(s) | Occurrence => %s ', $key)]);
            }
        }
    }

    function checkActiveLink($route,$activeClass,$inactiveClass=""){
        $routeName = Route::currentRouteName();

        if($routeName==$route){
            $txt =  sprintf("class = %s ", $activeClass);
            return $txt;
        }else{
            $txt = sprintf("class = %s ", $inactiveClass);
            return $txt;
        }

    }

    function formatDate($date)
    {
        Carbon::setLocale('fr');
        return Carbon::parse($date)->isoFormat('LLLL');
    }

    function humain($date)
    {
        Carbon::setLocale('fr');
        return Carbon::parse($date)->diffForHumans();
    }
    
    function formatFCFA($amount)
    {
       return '<span class="badge badge-pill badge-primary">'.(int)$amount.' FCFA </span>';
    }

    function getCustomerById($id){
        $customer = \App\Models\Customer::where('id', $id)->first();

        if(!empty($customer)){
            return $customer;
        }

        return 'donnée vide';

    }
    
    function getCustomerByEmail($email){
        $customer = \App\Models\Customer::where('email', $email)->first();

        if(!empty($customer)){
            return $customer;
        }

        return 'donnée vide';

    }

    function getCustomerByPhone($phone){
        $customer = \App\Models\Customer::where('phone', $phone)->first();

        if(!empty($customer)){
            return $customer;
        }

        return 'donnée vide';

    }

    function checkContent($content){
        if($content){
            return $content;
        }else{
            return 'donnée vide';
        }
    }

    function IsEmpty_($content){
        if($content){
            return true;
        }else{
            return false;
        }
    }


    function paymentMethod(String $value){
        switch ($value) {
            case 'cash':
               return  'Paiement cash';
                break;
            case 'online':
               return  'Paiement en ligne';
                break;
            default:
                return "pas de méthode de paiement défini";
                break;
        }
        
    }



    function status($value){
        switch ($value) {
             case 'waiting':
                 return "Attente";
             break;
             case 'confirmed':
                 return "Confirmé";
             break;
             case 'edited':
                 return "Editer";
             break;
             case 'refused':
                 return "Réfuser";
             break;
             case 'delivered':
                 return "Livré";
             break;
             case 'failed':
                 return "Echoué";
             break;
             case 'canceled':
                 return "Annulée";
             break;
             case 'noted':
                 return "Noté";
             break;
             case 'reported':
                 return "Réporté";
             break;
             case 'waiting_customer_pickup':
                 return "En attente pickup";
             break;
             case 'waiting_customer_delivery':
                 return "En attente de déot";
             break;
             case 'waiting_delivery':
                 return "En attente de livraison";
             break;
             case 'customer_paid':
                 return "Payé par l'utilisateur";
             break;
             case 'has_seller_paid':
                 return "A Payé le vendeur";
             break;
             case 'seller_delivered':
                 return "livré par le vendeur";
             break;
 
            default:
                 return "Pas de status défini";
             break;
        }
     }

// function imgur(Request $request,String $filename){
//         $file = $request->file($filename);

//         if ($file) {
//             $pictures = [];
//             if ($file != null) {
//                 $imgurFile = \Imgur::upload($file);
//                 $fileLink = $imgurFile->link();
//             }
//         } else {
//             $fileLink = '';
//         }
//         $input[$filename] = $fileLink;

// }
