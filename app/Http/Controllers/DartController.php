<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DateTime;
use App\Models\Participnt;


class DartController extends Controller
{
    public function creat(Request $request){
    // ========= recupérer le nombre de participant ============
        $Nparticipant = $request->input('participantsNombre');
         $montant = $request->input('montants');

    // =========================================================

    //============= definir la date de départ ====================
        $currentTime = now();
        $depart =new DateTime( $currentTime);
        $beginn = $currentTime->modify('+1 month');
        $begin = new DateTime( $beginn);
    // ============================================================

   //============= definir la date de fin ======================
        $end = $depart->modify('+'.$Nparticipant.' month');
   // ============================================================


      //============= les mois de dart   ======================
        $months = [];
        for($i = $begin; $i <= $end; $i->modify('+1 month')){
                array_push($months , $i->format("F-Y"));
        };
     // ============================================================


//============= contenu de tablue   ======================
ob_start();
     for($i = 0; $i<=count($months)-1;$i++){
       echo "<tr>
       <td scope='row' '>".$months[$i]."</td>
       <td >$montant DH</td>
       <td class='row'>
       <input type='text' name='' id='".$i."' class='form-control col-lg-8 user' value=''>
       <input type='hidden' name='' value='".$months[$i]."' class='month'>
       <input type='hidden' name='' value='".$montant."' class='montant'>
       <button class='btn btn-primary form-control add col-lg-2' type='button'>ajouter</button>
       </td>
   </tr>";
         }
 // ============================================================

$response = ob_get_clean();

       return $response;

    }

    public function addPersons(Request $request ){

// ============= recuperer les donnée envoie ===============
            $nom = $request->input('name');
            $moisDeBenefice = $request->input('month');
            $montan = $request->input('mtn');
// ======================================================


// ============= inseré le participant dans la base de donné ===============
            $participant =  new Participnt();
            $participant->participant = $nom ;
            $participant->montant = $montan ;
            $participant->moisDeBenefice = $moisDeBenefice;
            $participant->save();
// ======================================================
            return true;

    }

    // ============= aficher le ruseltat ===============
    public function showRuselt(){
       $res = Participnt::all("moisDeBenefice");
       return $res;
    }
    // ======================================================

    // ============= les détial de mois  ===============
    public function showMounthDetial(Request $request){
        $month = $request->input("Month");
// ----------------------- nom de beneficier ------------------------------
      $benefitName =  Participnt::where('moisDeBenefice',$month)->get('participant')->first();
      // ----------------------- some de beneficier ------------------------------
      $benefitSum = Participnt::where('moisDeBenefice','!=',$month)->get('montant')->sum('montant');
     // -----------------------  participants nom  ------------------------------
     $participantsName = Participnt::where('moisDeBenefice','!=',$month)->get('participant');
// -----------------------  montant  ------------------------------
    $montant = Participnt::get('montant')->first();



// ----------------------  resultat   ------------------------------
         return [ $benefitName , $benefitSum , $participantsName ,   $montant ];
    }

 // ======================================================
}
