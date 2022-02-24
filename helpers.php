<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

function searchForId($id,array $searchKey,$array) {

    $searchedValues = [];

    foreach ($array as $key => $val) {
        if ($val[$searchKey[0]] === $id || str_contains($val[$searchKey[0]], $id)) {
            array_push($searchedValues, $array[$key]);
        }
        elseif ($val[$searchKey[1]] === $id || str_contains($val[$searchKey[1]], $id)) {
            array_push($searchedValues, $array[$key]);
        }
        elseif ($val[$searchKey[2]] === $id || str_contains($val[$searchKey[2]], $id)) {
            array_push($searchedValues, $array[$key]);
        }
    }

    if(count($searchedValues)>= 1){
        $searchedValues = array_unique($searchedValues, SORT_REGULAR);
        return $searchedValues;
    }else{
        return [];
    }

}

function getLocationByIP()
{
    $ip = \Request::ip();
    // $ip = "160.155.11.229";
    // $position = Location::get('160.155.11.229');
    $position = Location::get($ip);
    if ($position) {
        // Successfully retrieved position.
        // dd($position->countryName);
        return $position;
    } else {
        // Failed retrieving position.
        return '';
    }

}

function showAvatar(String $image)
{
    return env("API_UNISKIP") . "/documents/kyc/" . $image;
}

function getFlag()
{

}

function getSvgBySlug($slug)
{
    switch ($slug) {
        case 'commercial-preciser-son-code-parrain':
            return "svg/commercial-uniskip.svg";
            break;
        case 'bouche-a-oreille':
            return "svg/bouche-oreille.svg";
            break;
        case "pub-tv":
            return "svg/pub-tv.svg";
            break;
        case "pub-radio":
            return "svg/pub-radio.svg";
            break;
        case "notre-site-intrenet":
            return "svg/site-web.svg";
            break;
        case "pub-sur-vehicules":
            return "svg/pub-car.svg";
            break;
        case "flyer":
            return "svg/flyer.svg";
            break;
        case "article-de-presse":
            return "svg/article-presse.svg";
            break;
        case "affichage-abri-de-bus":
            return "svg/abri-de-bus.svg";
            break;
        case "affichage-dans-la-rue":
            return "svg/street.svg";
            break;

        // site-web
        // flyer

        case "collaborateur-uniskip":
            return "svg/uniskip-member.svg";
            break;
        case "collaborateur-la-poste-ci":
            return "svg/collaborateur-la-poste-ci.svg";
            break;
        case "collaborateur-adf-dat":
            return "svg/adf-dat.svg";
            break;
        case "autre-preciser":
            return "svg/autre-preciser.svg";
            break;
        case "selectionnez-une-option":
            return "svg/selectionnez-une-option.svg";
            break;
        case "code-de-parrainage":
            return "svg/code-de-parrainge.svg";
            break;

        default:
            "veuillez ajouter un svg";
            break;
    }
}

function getUserToken()
{
    $token = session()->get('api_key');

    if (!empty($token)) {
        return $token;
    } else {
        return null;
    }
}

function yesOrNo(bool $value = null)
{
    if ($value == true) {
        return '<span class="badge badge-success">Oui</span>';
    } else {
        return '<span class="badge badge-danger">Non</span>';
    }
}

function checkIfEmpty($value)
{   

    if ($value == true) {
        return '<span class="badge badge-primary">' . $value . '</span>';
    } else {
        return '<span class="badge badge-secondary"> Donnée manquante </span>';
    }
}

function checkRequired($elements = [])
{

    foreach ($elements as $key => $element) {
        if (empty($element) || is_null($element)) {
            return response()->json(['message' => sprintf('Paramètre requis manquant(s) | Occurrence => %s ', $key)]);
        }
    }
}

function checkActiveLink($route, $activeClass, $inactiveClass = "")
{

    $routeName = Route::currentRouteName();

    if ($routeName == $route) {
        $txt = sprintf("class = %s ", $activeClass);
        return $txt;
    } else {
        $txt = sprintf("class = %s ", $inactiveClass);
        return $txt;
    }

}

function formatDate($date)
{
    Carbon::setLocale('fr');
    return Carbon::parse($date)->isoFormat('LLLL');
}

function formatDateCourt($date)
{
    Carbon::setLocale('fr');
    return Carbon::parse($date)->isoFormat('L');
}

function humain($date)
{
    Carbon::setLocale('fr');
    return Carbon::parse($date)->diffForHumans();
}

function formatFCFA($amount)
{
    //    return '<span class="badge badge-pill badge-primary">'.(int)$amount.' FCFA </span>';
    return '<span class="">' . (int) $amount . ' FCFA </span>';
}

function getCustomerById($id)
{
    $customer = \App\Models\Customer::where('id', $id)->first();

    if (!empty($customer)) {
        return $customer;
    }

    return 'donnée vide';

}

function getCustomerByEmail($email)
{
    $customer = \App\Models\Customer::where('email', $email)->first();

    if (!empty($customer)) {
        return $customer;
    }

    return 'donnée vide';

}

function getCustomerByPhone($phone)
{
    $customer = \App\Models\Customer::where('phone', $phone)->first();

    if (!empty($customer)) {
        return $customer;
    }

    return 'donnée vide';

}

function checkContent($content)
{

    if ($content) {
        return $content;
    } else {
        return 'donnée vide';
    }
}

function IsEmpty_($content)
{

    if ($content) {
        return true;
    } else {
        return false;
    }
}

function paymentMethod(String $value)
{

    switch ($value) {
        case 'cash':
            return 'Paiement cash';
            break;
        case 'online':
            return 'Paiement en ligne';
            break;
        default:
            return "pas de méthode de paiement défini";
            break;
    }

}

function status($value)
{

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

function imgur(Request $request, String $filename)
{
    // $file = $request->file($filename);

    // if ($file) {
    //     $pictures = [];
    //     if ($file != null) {
    //         $imgurFile = \Imgur::upload($file);
    //         $fileLink = $imgurFile->link();
    //     }
    // } else {
    //     $fileLink = '';
    // }
    // $input[$filename] = $fileLink;

    // Intl.NumberFormat( navigator.language, { }).format(val);
    // Intl.NumberFormat( navigator.language, { }).format(val);

    /*
function color_credit(val,row){
if ((val > 0) && (row.vente_terminee == 1)) {
return '<span style="color:green;">' + Intl.NumberFormat( navigator.language, { }).format(val) + '</span>';
} else {
return Intl.NumberFormat( navigator.language, { }).format(val);
}
} */

}
