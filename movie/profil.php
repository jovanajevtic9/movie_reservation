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
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
<script src="js/controller.js"></script>

<script src="js/jasny/js/jasny-bootstrap.min.js"></script>
<link rel="stylesheet" href="js/jasny/css/jasny-bootstrap.min.css" >


<script type="text/javascript">
     $.get( "controller.php", { podaci: "korisnik"} )
                .done( function( data ) {

                    var profil = ""; 
                    var podaci = JSON.parse(data);


                    profil+="<h5>" + podaci.ime + " " + podaci.prezime +"</h5><h5>" + podaci.email +"</h5><h5>"+podaci.password+"</h5>" ;

                    $('#nalog').html(profil);
            }); 

        $.get( "controller.php", { podaci: "rezervacija"} )
                .done( function( data ) {

                    var profil = "<tr> <td><b>FILM</b></td><td><b>GRAD</b></td> <td><b>DATUM</b></td><td><b>BROJ KARATA</b></td></tr>"; 
                    var podaci = JSON.parse(data);

                     for (var i = 0; i < podaci.length; i++) {
                        //profil+=podaci[i].projekcija.grad.naziv;

                       profil +="<tr><td>"+podaci[i].projekcija.film.naziv+"</td><td>"+podaci[i].projekcija.grad.naziv+"</td><td>"+podaci[i].projekcija.datum+"</td><td>"+podaci[i].br_karata+"</td></tr>";
                    };

                    $('#rez').html(profil);
            }); 
</script>




</head>
<?php



?>


<body ng-app="myApp" ng-controller="sort" >

<div id="all" >
  <div id="header" class="row well">
       <div class="col-md-2"></div>
       <div class="col-md-8">
           


          <img src="img/logo1.png" class="img-responsive" alt="Responsive image" id="logoImg">
          <div id="searchDiv" class="navbar-form navbar-right">
                  <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" id="searchBox" onclick="pretrazi()">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
                 <br>
                  <div class="btn-group" role="group" aria-label="" style="float:right">
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
            <li role="presentation"><a href="index.php">Pocetna</a></li>
            <li role="presentation"><a href="repertoar.php">Repertoar</a></li>
            <li role="presentation"  class="active"><a href="profil.php">Moje rezervacije</a></li>
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
                        <div class="col-md-9 well" <?php  if (isset($_SESSION['ime'])){ echo "style='display:none'"; }?>>
                         <div class="row">
                          <div class="col-md-6">
                           <br>
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
                            </div>
                        </div>
                        <div class="col-md-9" <?php  if (!isset($_SESSION['ime'])){ echo "style='display:none'"; }?>>
                          <div class="row well">
                            <h3>Osnovni podaci</h3>
                            <hr class="table table-bordered">
                            <div class="row">
                                 <div class="col-md-4">
                                  <form action="controller.php" method="post">
                                    <input type="hidden" name="podaci" value="slika">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                          <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="userImg"></span>
                                            
                                            <button type="submit" class="btn btn-default fileinput-exists" >Save</button>
                                          </div>
                                        </div>
                                    </form>
                                    
                                 </div>
                                 <div class="col-md-4">
                                    <h5><b>Ime i prezime:</b></h5>
                                    <h5><b>E-mail:</b></h5>
                                    <h5><b>Sifra:</b></h5>
                                 </div>
                                 <div class="col-md-4" id="nalog">
                                    
                                 </div>
                            </div>

                          </div>
                            <div class="row well">
                                <h3>Moje rezervacije</h3>
                                <hr class="table table-bordered">
                                  <table class="table table-striped" id="rez">
                                     
                                     
                                    </table>
                            </div>

                        </div>

                        <div class="col-md-3 well">
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
 <!-- Modal -->
<div class="modal fade" id="rezervisiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-primary" id="myModalLabel" >Rezervisi karte</h4>
      </div>
      <div class="modal-body">
              <form name="userReserve" action="controller.php" method="post">
                    <input type="hidden" name="podaci" value="rezervacija">
                    <input type="hidden" name="idProj" value="{{idProjekcije}}">
                  <div class="row">
                    <div class="col-md-3">
                        <h5><b>Ime i prezime:</b></h5>
                        <h5><b>Naziv filma:</b></h5>
                        <h5><b>Grad:</b></h5>
                        <h5><b>Cena:</b></h5>
                        <h5><b>Datum:</b></h5>
                        <h5><b>Preostalo mesta:</b></h5>
                        <h5><b>Broj karata:</b></h5><br>
                    </div>
                      
                    <div class="col-md-9">
                            <h5 ><?php 
                          if (isset($_SESSION['ime']) && isset($_SESSION['prezime']) )
                          {
                            echo "".$_SESSION['ime']." ".$_SESSION['prezime']."";

                          }
                            ?></h5>
                          <h5>
                              <?php 
                                echo "".$film->naziv."";
                              ?>
                          </h5>   
                          <h5 >    {{izabraniGrad.naziv}}  </h5>        
                          <h5>  {{izabranaCena}} dinara     </h5>
                          <h5 >     {{izabraniDatum | date: "dd-MM-yyyy, EEEE"}} </h5>
                          <h5 > {{preostaloMesta}} </h5>
                        <div class="row">
                          <div class="col-md-9">
                             <input type="number" class="form-control"  id="brKarata" min="1" max="{{preostaloMesta}}"  name="brKarata" ng-model="brKarata" >
                          </div>
                          <div class="col-md-3">{{izabranaCena*brKarata}} dinara</div><br>

                        </div>
                    </div>
                        
                  </div>
                    <div class="modal-footer">
                       <button type="submit"  class="btn btn-primary" >Rezervisi</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     
                    </div>
                
                
                
              </form>
      </div>
      
    </div>
  </div>
</div>




  </div>








</body>
</html>
