<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

  <!-- Latest compiled and minified CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="../css/css.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
<script src="../js/controller.js"></script>

<script type="text/javascript">
   function pretrazi(){
      

   }
</script>

</head>
<body ng-app="myApp" >

<div id="all">
  <div id="header" class="row well">
       <div class="col-md-2"></div>
       <div class="col-md-8">
           


          <img src="../img/logo1.png" class="img-responsive" alt="Responsive image" id="logoImg">
          <div id="searchDiv" class="navbar-form navbar-right">
                  <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" id="searchBox" onclick="pretrazi()">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
                 <br>
                 
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
            <li role="presentation"><a href="../index.php">Pocetna</a></li>
            <li role="presentation"><a href="../repertoar.php">Repertoar</a></li>
            <li role="presentation"><a href="../profil.php">Moje rezervacije</a></li>
              <li role="presentation" ><a href="../galerija.php">Galerija</a></li>
          
             <li role="presentation"><a href="../contact.php">Kontakt</a></li>
             <li role="presentation"  class="active"><a href="index.php">ADMIN </a></li>
          </ul>
        </div>
    </div>
     <div class="col-md-2 ">
        
      </div>

  </div>
  <br>

      <div class="row" id="slider">
         <div class="col-md-2 ">
        
        </div>
         <div class="col-md-8 ">
                         


          </div>

          <div class="col-md-2">
          </div>
                          
      </div>

      <div class="row">
         <div class="col-md-2">
          </div>
           <div class="col-md-8">
            <br>
                <div class="row">
                        <div class="row well">
                            <h3>Dodaj film</h3>
                           <hr class="table table-bordered">
                            <div id="film">
                              <form name="filmForm" action="../controller.php" method="POST">
                                <input type="hidden" name="podaci" value="film">
                                
                                   
                                    <div class="form-group col-md-6">
                                      <label for="naziv">Naziv filma:</label>
                                      <input type="text" class="form-control" id="naziv" placeholder="naziv" name="naziv" required>
                                    </div>
                                     <div class="form-group col-md-6">
                                      <label for="opis">Opis filma:</label>
                                      <textarea class="form-control" name="opis" placeholder="opis" required></textarea>
                                    </div>
                                     <div class="form-group col-md-6">
                                      Zanr:
                                      <select class="form-control" name="zanr">
                                        <option value="Naucna Fantastika">Naucna Fantastika</option>
                                        <option value="Drama">Drama</option>
                                        <option value="Komedija">Komedija</option>
                                        <option value="Triler">Triler</option>
                                        <option value="Akcija">Akcija</option>
                                      </select>
                                    </div>
                                     <div class="form-group col-md-6">
                                      Trajanje: <input type="text" class="form-control" placeholder="trajanje" name="trajanje" required>
                                    </div>
                                     <div class="form-group col-md-6">
                                      Reditelj: <input type="text" class="form-control" placeholder="reditelj" name="reditelj" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                      Glumci: <input type="text" class="form-control" placeholder="glumci" name="glumci" required>
                                    </div>
                                   
                                
                                 <button type="submit"  class="btn btn-primary" >Sacuvaj</button>
                                
                              </form>

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
