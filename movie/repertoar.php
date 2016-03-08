<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>

  <!-- Latest compiled and minified CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="css/css.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

<script src="js/controller.js"></script>


<script type="text/javascript">

     $.get( "controller.php", { podaci: "gradovi"} )
                .done( function( data ) {

                    var gradovi = "<option value='0'></option>"; var podaci = JSON.parse(data);


                    for (var i = 0; i < podaci.length; i++) {


                        gradovi += '<option value="'+podaci[i].id+'">'+
                            podaci[i].naziv+'</option>';
                    };

                    $('#sel1').html(gradovi);
            }); 
   

      $.get( "controller.php", { podaci: "projekcije"} )
                .done( function( data ) {
                    var filmovi = " "; 
                    var cena = 0;
                    var datumi="";
                    var gradovi="";
                    var naziv ="";
                    var reditelj="";
                    var trajanje="";
                    var glumci="";
                    var podaci = JSON.parse(data);
                    var k = 0;
                     var zanr="";
                    var zanrovi=[];
                    var z="<option value='0'></option>";
                    var film_id = [];
                    for (var i = 0; i < podaci.length; i++) {
                          if(zanrovi.includes(podaci[i].film.zanr)){

                          }
                          else {
                            zanrovi[zanrovi.length] = podaci[i].film.zanr;
                          }

                          if(film_id.includes(podaci[i].film.id)){

                          }
                          else {
                            film_id[film_id.length] = podaci[i].film.id;
                          }
                    };
                    for (var j = 0; j < zanrovi.length; j++) {
                        z+="<option value='"+zanrovi[j]+"'>"+zanrovi[j]+"</option>"
                    }

            for (var j = 0; j < film_id.length; j++) {



                    for (var i = 0; i < podaci.length; i++) {
                         if(podaci[i].film.id==film_id[j]){
                            cena = podaci[i].cena;
                            naziv = podaci[i].film.naziv;
                            trajanje = podaci[i].film.trajanje;
                            reditelj = podaci[i].film.reditelj;
                            glumci = podaci[i].film.glumci;
                            zanr = podaci[i].film.zanr;
                            break;
                         }
                    };

                     for (var i = 0; i < podaci.length; i++) {
                         if(podaci[i].film.id==film_id[j]){
                            if(podaci[i].datum<datumi || datumi==""){
                            datumi= podaci[i].datum;
                          }
                            if(gradovi.includes(podaci[i].grad.naziv)){}
                            else{gradovi+= podaci[i].grad.naziv+" ";}
                            
                         }
                    };

                    filmovi+="<div class='row well'><div class='col-md-4' ><a href='film.php?id="+film_id[j]+"'><img src='img/f"+film_id[j]+".jpg' id='slika1'></a></div><div class='col-md-8'><a href='film.php?id="+film_id[j]+"'><h3 class='text-primary'>"+naziv+"</h3></a><h5>reditelj:"+reditelj+"</h5><h5>trajanje:"+trajanje+"</h5><h5>zanr:"+zanr+"</h5><h5>prvi datum odrzavanja:"+datumi+"</h5><h5>gradovi:"+gradovi+"</h5></h5><br><h5><b>glumci:"+glumci+"</b></h5></div></div>";
                    cena=0;
                    datumi="";
                    gradovi="";
            };

                    $('#filmContainer').html(filmovi);
                    $('#sel3').html(z);
            }); 

 function pretrazi(){

 $.get( "controller.php", { podaci: "pretraga", naziv: $('#searchBox').val() })
                .done( function( data ) {

                  var podaci = JSON.parse(data);
                   var filmovi="";


                    for (var i = 0; i < podaci.length; i++) {

                    filmovi+="<div class='row well'><div class='col-md-4' ><a href='film.php?id="+podaci[i].id+"'><img src='img/f"+podaci[i].id+".jpg' id='slika1'></a></div><div class='col-md-8'><a href='film.php?id="+podaci[i].id+"'><h3 class='text-primary'>"+podaci[i].naziv+"</h3></a><h5>reditelj:"+podaci[i].reditelj+"</h5><h5>trajanje:"+podaci[i].trajanje+"</h5><h5>zanr:"+podaci[i].zanr+"</h5><br><br></h5><br><h5><b>glumci:"+podaci[i].glumci+"</b></h5></div></div>";
                    
                      
                        
                    };

                    $('#filmContainer').html(filmovi);
            }); 
 
  

     
 }
  

  function sortBy(){
    document.getElementById('searchBox').value="";
      var trazeniGrad = document.getElementById('sel1').value;
      
      var datum = document.getElementById('sel2').value;

      var trazeniZanr = document.getElementById('sel3').value;
      //alert(datum);
     // var datum = new Date(datumSve.getFullYear(),datumSve.getMonth(),datumSve.getDate());
      

      $.get( "controller.php", { podaci: "projekcije"} )
                .done( function( data ) {
                    var filmovi = " "; 
                    var cena = 0;
                    var datumi="";
                    var gradovi="";
                    var naziv ="";
                    var reditelj="";
                    var trajanje="";
                    var glumci="";
                    var zanr="";
                    var podaci = JSON.parse(data);
                    var k = 0;
                    var film_id = [];
                    var ubaciti=true;

              for (var i = 0; i < podaci.length; i++) {
                     ubaciti=true;
                      if(film_id.includes(podaci[i].film.id)){
                        ubaciti=false;
                      }
                     if(trazeniGrad!=0){
                           if(podaci[i].grad.id!=trazeniGrad){
                                 ubaciti=false;                                   
                                  }
                      }
                      if(datum!=0){
                              var lastFive=podaci[i].datum+"";
                              lastFive = lastFive.substr(lastFive.length - 2);
                            if(datum.includes(lastFive)){
                             
                           }
                           else {ubaciti=false;}                           
                      }
                      if(trazeniZanr!=0){
                        if(podaci[i].film.zanr!=trazeniZanr){
                                 ubaciti=false;                                   
                                  }
                      }

                      if(ubaciti==true){
                            film_id[film_id.length] = podaci[i].film.id;
                          }
                      

                        //    
                      

                    

                          
              };

            for (var j = 0; j < film_id.length; j++) {

                    for (var i = 0; i < podaci.length; i++) {
                         if(podaci[i].film.id==film_id[j]){
                            cena = podaci[i].cena;
                            naziv = podaci[i].film.naziv;
                            trajanje = podaci[i].film.trajanje;
                            reditelj = podaci[i].film.reditelj;
                            glumci = podaci[i].film.glumci;
                            zanr = podaci[i].film.zanr;
                            break;
                         }
                    };

                     for (var i = 0; i < podaci.length; i++) {
                         if(podaci[i].film.id==film_id[j]){
                            if(podaci[i].datum<datumi || datumi==""){
                            datumi= podaci[i].datum;
                          }
                            if(gradovi.includes(podaci[i].grad.naziv)){}
                            else{gradovi+= podaci[i].grad.naziv+" ";}
                            
                         }
                    };

                    filmovi+="<div class='row well'><div class='col-md-4' style='padding-top:5px;' ><a href='film.php?id="+film_id[j]+"'><img src='img/f"+film_id[j]+".jpg' id='slika1'></a></div><div class='col-md-8'><a href='film.php?id="+film_id[j]+"'><h3 class='text-primary'>"+naziv+"</h3></a><h5>reditelj:"+reditelj+"</h5><h5>trajanje:"+trajanje+"</h5><h5>zanr:"+zanr+"</h5><h5>prvi datum odrzavanja:"+datumi+"</h5><h5>gradovi:"+gradovi+"</h5></h5><br><h5><b>glumci:"+glumci+"</b><a href=''></a></h5></div></div>";
                    cena=0;
                    datumi="";
                    gradovi="";
            };

                    $('#filmContainer').html(filmovi);
            }); 




  }
</script>


</head>


<body ng-app="myApp" ng-controller="sort" >

<div id="all">
  <div id="header" class="row well">
       <div class="col-md-2"></div>
       <div class="col-md-8">
         
         
          <img src="img/logo1.png" class="img-responsive" alt="Responsive image" id="logoImg">
          <div id="searchDiv" class="navbar-form navbar-right">
                  <form class="navbar-form navbar-right" role="search" name="searchForm" >
              <div class="form-group">
              
                <input type="text" class="form-control" placeholder="Search" name="searchBox" id="searchBox" required>

              </div>
              <button type="button" class="btn btn-default" onclick="pretrazi()"> Search</button>
            </form>
                 <br>
                  <div class="btn-group" role="group" aria-label="..." style="float:right">
                     <button type="button" class="btn btn-default" data-toggle="modal" data-target="#loginModal" <?php if(isset($_SESSION['ime'])){echo"style='display:none'";}         ?> > Log In</button>
                    <button type="button" class="btn btn-default"  onClick="window.open('controller.php?session=0', '_self')" <?php if(!isset($_SESSION['ime'])){echo"style='display:none'";}         ?> > Log Out</button>
                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" id="register" <?php if(isset($_SESSION["ime"])){ echo "style='display:none'";}  ?>>Sign Up</button>


                  </div>
                   <div class="row navbar-right " style="padding-top:2%"><?php if(isset($_SESSION["ime"])){ echo "<p class='text-primary'>Hi, ".$_SESSION["ime"]."!&nbsp</p>";}  ?></div>
       
          </div>
       </div>
      <div class="col-md-2"></div>
  </div>


  <div id="navigation" class="row ">
      <div class="col-md-2 ">
        
      </div>
    <div class="col-md-8 " >
       <div class="row ">
          <ul class="nav nav-tabs ">
            <li role="presentation" ><a href="index.php">Pocetna</a></li>
            <li role="presentation" class="active"><a href="repertoar.php">Repertoar</a></li>
             <li role="presentation"><a href="profil.php">Moje rezervacije</a></li>
             <li role="presentation" ><a href="galerija.php">Galerija</a></li>
           
         
             <li role="presentation"><a href="contact.php">Kontakt</a></li>
          </ul>
        </div>
    </div>
     <div class="col-md-2 ">
        
      </div>

  </div>
  <br>

      

     

      <div class="row">
         <div class="col-md-2">
          </div>
           <div class="col-md-8">
            <br>
                <div class="row" >
                        <div class="col-md-9 ">
                            <div class="row well" id="sort">
                              <div class="col-md-4">
                                    <div class="form-group" >
                                         <p>Izaberite grad:</p>
                                        <select class="form-control" id="sel1" onchange="sortBy()" >
                                          
                                         
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <p>Izaberite datum:</p>
                                        <select class="form-control" id="sel2" onchange="sortBy()">
                                          <option value="0"> </option>
                                            <option value="{{date1 | date:'dd-MM-yyyy'}}">{{date1 | date:'dd-MM-yyyy, EEEE'}}</option>
                                            <option value="{{date2 | date:'dd-MM-yyyy'}}">{{date2| date:'dd-MM-yyyy, EEEE'}}</option>
                                            <option value="{{date3 | date:'dd-MM-yyyy'}}">{{date3| date:'dd-MM-yyyy, EEEE'}}</option>
                                            <option value="{{date4 | date:'dd-MM-yyyy'}}">{{date4| date:'dd-MM-yyyy, EEEE'}}</option>
                                            <option value="{{date5 | date:'dd-MM-yyyy'}}">{{date5| date:'dd-MM-yyyy, EEEE'}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                      <div class="form-group" >
                                         <p>Izaberite zanr:</p>
                                        <select class="form-control" id="sel3" onchange="sortBy()" >
                                          
                                         
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="" id="filmContainer">
                                  



                                                                  

                            </div>



                        </div>

                        <div class="col-md-3 well ">
                          <h4 class="text-center" > TOP 5</h4>
                          <div id="topten" ng-repeat="x in topten" >
                           <a href="film.php?id={{x.film.id}}"><img src="img/filmovi/{{x.film.id}}/top.jpg" class="img-responsive img-thumbnail" width="100%" ></a>
                            <h4  class="text-center"><a href="film.php?id={{x.film.id}}" >{{x.film.naziv}}</a></h4>
                            <hr class="table table-bordered">
                          </div>

                        </div>
                </div>


          </div>
           <div class="col-md-2">
          </div>
      </div>

    
   <br><br><br>

  <div id="footer" class="panel-footer">
    MovieTickets.com is a worldwide leader in advance movie ticketing and a top destination for news, celebrity interviews, movie reviews and trailers. 
    <br>You can also access theater information, check movie showtimes, view video clips, and much more.
  </div>

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registracija korisnika</h4>
      </div>
      <div class="modal-body">
              <form name="userForm" action="controller.php" method="POST">
                <input type="hidden" name="podaci" value="korisnik">
                <input type="hidden" name="success" value="">
                    <div class="form-group">
                      <label for="ime">Ime &nbsp</label><span class="glyphicon glyphicon-ok" ng-show="userForm.ime.$valid" aria-hidden="true"></span>
                      <input type="text" class="form-control" id="ime" placeholder="Ime" name="ime" ng-model="ime" required>
                    
                    </div>
                    <div class="form-group">
                      <label for="preizme">Prezime &nbsp</label><span class="glyphicon glyphicon-ok" ng-show="userForm.prezime.$valid" aria-hidden="true"></span>
                      <input type="text" class="form-control" id="prezime" placeholder="Prezime" name="prezime" ng-model="prezime" required>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address &nbsp</label><span class="glyphicon glyphicon-ok" ng-show="userForm.email.$valid" aria-hidden="true"></span>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" ng-model="email" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password &nbsp</label><span class="glyphicon glyphicon-ok" ng-show="userForm.password.$valid" aria-hidden="true"></span>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" ng-model="pass"  required my-directive>
                        <p style="font-size:12px">*minimum 6 karaktera</p>
                    </div>
                
                 <button type="submit" ng-disabled="userForm.ime.$invalid || userForm.prezime.$invalid || userForm.email.$invalid || userForm.password.$invalid" class="btn btn-primary" >Save changes</button>
                
              </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
              <form name="userLogin" action="controller.php" method="POST">
                <input type="hidden" name="podaci" value="logovanje">
                
                   
                    <div class="form-group">
                      <label for="email1">Email address &nbsp</label>
                      <input type="email" class="form-control" id="email1" placeholder="Email" name="email1" ng-model="email1" required>
                    </div>
                    <div class="form-group">
                      <label for="password1">Password &nbsp</label>
                      <input type="password" class="form-control" id="password1" placeholder="Password" name="password1" ng-model="password1"  required >
                        
                    </div>
                
                 <button type="submit"  class="btn btn-primary" >Log in</button>
                
              </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>



  </div>








</body>
</html>
