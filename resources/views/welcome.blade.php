<!DOCTYPE html>
{{-- realisé par AYOUB LEMRACHCHAQ  --}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        {{-- bootstrap --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       {{-- vue js --}}
       <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <!-- Fonts -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
          {{--  vue script --}}
           <script src="{{asset("/js/dart.js")}}"></script>
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f7fafc;
            }
            .dart{
                color: rgb(72, 240, 72);
            }
            .mrc{
                text-align: center;
                text-decoration: underline;
                margin-bottom: 4rem;
            }
            .termine{
                margin-bottom: 10rem;
            }
            .detail{
                font-size: 2rem ;

            }
        </style>
    </head>

    <body >
           <div class="container" id="app">
               <h1 class="display-3 text-center dart">DART</h1>
               <hr style="border:3px rgb(72, 240, 72) solid;"><br><br>

           <form  v-if="showInfoInputs" method="POST" action="{{route('dart.creat')}}" class="row">
            @csrf

            <div class="form-group col-lg-4">
                <label for="">nombre de participants</label>
                <input type="text" name="nombre" id="" class="form-control" placeholder="" aria-describedby="helpId" v-model="participants">
                <small id="helpId" class="text-muted">help text</small>
              </div>

              <div class="form-group col-lg-4 ">
                <label for="">montant</label>
                <input type="text" name="montant" id="" class="form-control" placeholder="" aria-describedby="helpId" v-model="montant">
                <small id="helpId" class="text-muted">Help text</small>
              </div>

<div class="form-group col-lg-2">
    <label for="">valider</label>
    <button class="btn btn-primary form-control" type="button" v-on:click="showUsersTable">Valider</button>
</div>

           </form>
<hr><br>

 <div v-if='showTable' id="tab" class="row" id="app2" >
    <table class='table table-hover'>
        <h1 style="text-align: center"> Merci de saisir les noms de participants</h1>
        <thead>
            <tr>
                <th >mois-année</th>
                <th>montant</th>
                <th>participant</th>


            </tr>
        </thead>
        <tbody id="tabl">
                 {{-- lieu d'affiche de reponse server  --}}
                </tr>
        </tbody>

    </table>
    <button type="button" class="btn btn-primary col-lg-12 termine" v-on:click="showResulet">terminé</button>
</div>

{{-- ================== resultat final =============== --}}
<div v-if="showFinalRuselt" class="container">
    <h1 style="text-align: center" class="mrc"> click pour voir les détials</h1>
<div class="row">
    <ul class="list-group-hover col-lg-3 ">
        <li href="#" class="list-group-item  active">
           les mois
        </li>
        <li v-for="item in mois" class="list-group-item list-group-item-action"  v-on:click="showRuselt" > @{{item}}</li>
    </ul>

    <div class="list-group col-lg-6" v-if="showMonthDetial" >
        {{--           afficher le mois preciser --}}
        <h2 class="text-center" style="background: rgba(13, 211, 79, 0.452)">@{{theShaceMonth}}</h2>
        {{-- ------------------------------------- --}}
        {{--     afficher les participant  --}}
         <div   v-for="item in monthParticipants"  class="row detail">
              <div class="col-lg-4"> @{{item.participant}} </div>     <div class="col-lg-6" style="color:red;"> -@{{monthPticipSum}} </div>

         </div >
{{-- ------------------------------------------------------ --}}

{{-- ------------  aficher beneificer ------------------------ --}}
<div    class="row detail">
    <hr style="border:2px rgba(7, 7, 7, 0.616) solid " class="col-lg-12" >
    <div class="col-lg-4"> @{{beneficier}} </div>
     <div class="col-lg-8" style="color:rgba(0, 68, 255, 0.671);"> +@{{montantBinifice}} </div>
</div >


{{-- ------------------------------------------------------ --}}

        </div >
</div>
</div>


 </div>



        <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

  const app = new Vue({
    el: '#app',
    data: {
        participants : "",
        montant:"",
        mois:"",
        showTable:false,
        showFinalRuselt:false,
        showInfoInputs:true,
        showMonthDetial:false,
        monthParticipants:"",
        monthPticipSum:"",
        theShaceMonth :"",
        beneficier:"",
        montantBinifice:""

    },
    computed: {

    },
    methods: {
        // =================== afficher les mois method ===========================
        showResulet(){
            this.showTable = false;
            this.showInfoInputs = false;
            let self = this;

    axios.post('http://localhost:8000/showRuselts', {

  })
  .then(function (res) {
    self.mois = [];
    console.log(res.data.length);
    for (let index = 0; index < res.data.length; index++) {
    self.mois.push(res.data[index].moisDeBenefice);
   self.showFinalRuselt =  true ;
}
  })
   .catch(function (error) {
    alert(error);
  });

},
  // =================== afficher les input pour sisir les nom  ===========================
        showUsersTable()  {
            this.showTable = true;
            axios.post('http://localhost:8000/dartCreat', {
              participantsNombre: this.participants,
              montants: this.montant
  })
  .then(function (res) {

    document.getElementById('tabl').innerHTML = res.data;
  })
   .catch(function (error) {
    alert(error);
  });

        },
  // ============= les détial de mois  ===============
        showRuselt(event){
            this.showMonthDetial = true;
            let self = this ;
             let LeMoisChoise = event.target.innerHTML;
             this.theShaceMonth  = LeMoisChoise;
            axios.post('http://localhost:8000/showMounthDetials', {
                Month:LeMoisChoise,
  })
  .then(function (res) {
   console.log(res.data);
   self.monthParticipants = res.data[2];
   self.monthPticipSum = res.data[3].montant;
   self.beneficier = res.data[0].participant;
   self.montantBinifice = res.data[1];
  })
   .catch(function (error) {
    alert(error);
  });

        }

 // ======================================================

    }
});


//  ================================= ajouter le participant a la base de donnée  ========
$(document).on('click','.add',function(){
//    var dta = $(this).siblings("td:has(.user)");
         var nom= $(this).siblings(".user").val();
         var  mois  = $(this).siblings(".month").val();
         var montant = $(this).siblings(".montant").val();
        var btn = $(this);

$.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: "http://localhost:8000/addPerson",
      crossDomain : true,
      xhrFields: {
          withCredentials: true
      },
      data: {
        name:nom,
        month:mois,
        mtn:montant
         },
      dataType: "",
      success: function (response) {
           btn.css({"display" : "none"});
           btn.siblings("input").attr("disabled","disabled");
      },
      complete: function (param) {   },
      error:function (request,status,errorThrown) {
         alert("merci de saisire le nom");
      }
  });

});
</script>
    </body>
</html>
{{-- realisé par AYOUB LEMRACHCHAQ  --}}
