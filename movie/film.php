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
<?php
	$idp = $_GET['id']; 
?>
<script type="text/javascript">



</script>
</head>


<body ng-app="myApp" ng-controller="sort" onload="init()">

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
            <li role="presentation"><a href="repertoar.php">Repertoar</a></li>
            <li role="presentation"><a href="profil.php">Moje rezervacije</a></li>
            <li role="presentation"><a href="galerija.php">Galerija</a></li>
           
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
                         <?php
								require 'config.php';

								include 'model/Grad.php';
								include 'model/Film.php';
								include 'model/Korisnik.php';
								include 'model/Projekcija.php';

								$konekcija = new MySqli($mysql_server, $mysql_user, 
										$mysql_password, $mysql_db);

								error_reporting(0); #micemo upozorenja
								$filmovi = new Film($konekcija);

								if (isset($_GET['id'])){
									$id = $_GET['id'];
									$film = $filmovi->findById($konekcija,$id);				
								}
						?>
                            <div class="row well">
                            	 
                            		<h2 class="text-primary"><?php echo "".$film->naziv."";  ?> </h2><br>
                            		<div class="row">                           				
                    					<video width="100%"  controls poster="img/filmovi/<?php echo $id; ?>/top.jpg" id="videoImg" class="center-block img-responsive" >
											  <source src="video/<?php echo $id; ?>.mp4" type="video/mp4">
											  Your browser does not support HTML5 video.
										</video>                           				
                            		</div>


									<hr class="table table-bordered">
									<div class="row">
										<div class="col-md-4">
											<h4 class="text-primary">Zanr:</h4>
											<h4 class="text-primary">Reditelj:</h4>
											<h4 class="text-primary">Duzina trajanja filma:</h4>
											<h4 class="text-primary">Glumci:</h4>
										</div>
										<div class="col-md-8">
											<h4><?php echo "".$film->zanr.""; ?>  </h4>
											<h4><?php echo "".$film->reditelj.""; ?>  </h4>
											<h4><?php echo "".$film->trajanje.""; ?> minuta </h4>
											<h4><?php echo "".$film->glumci.""; ?>  </h4>
										</div>

										 

									</div>
									<hr class="table table-bordered">
                  <div class="row">
                     <div class="col-md-12">
                      
                      <p><?php echo "".$film->opis.""; ?>  </p>
                    </div>
                  </div>
                  <hr class="table table-bordered">

									<div class="row">
										<div class="col-md-12" >
											<h4 >Vremenski raspored projekcija</h4><br>
                      <script type="text/javascript">var filmid = <?php echo $idp;  ?>; </script>
												                <div class="form-group row" >
			                                        <div class="col-md-4">
			                                        	
			                                        		<select class="form-control" ng-init="grad.grad.id = gradovi[0]" ng-model="grad.grad.id" ng-change="prikaziDatume(grad.grad.id)" ng-options="grad.grad.id as grad.grad.naziv for grad in gradovi"  >
                                                   
			                                        		
      			                                        
                                                  </select>
			                                         </div>
                                        </div>

			                                    <div class="row" id="datumi" >
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-8">
                                               <table class="table-hover">
                                                
                                                    <tr ng-repeat="x in datumi" <?php 
                                                    if(isset($_SESSION['ime'])){

                                                      echo "data-target='#rezervisiModal'";
                                                    }
                                                    else {
                                                      echo "data-target='#loginModalRezer'";
                                                    } 

                                                    ?> ng-click="setProjekcija(x)" data-toggle="modal"    >
                                                     
                                                      <td >
                                                     {{x.datum | date: 'dd-MM-yyyy'}}, &nbsp
                                                      </td>
                                                      <td>
                                                      {{ x.datum | date:'EEEE'  }}, &nbsp
                                                      </td>
                                                       <td>
                                                      {{ x.cena }}&nbsp dinara &nbsp<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                                                      </td>
                                                      
                                                  </tr>
                                                  
                                                </table>
                                            </div>
			                                    </div>
										</div>
									</div>


									<hr class="table table-bordered">
                            		<div class="row" id="galerija">
                            			<div class="col-md-12">
                            			<h4>Galerija</h4>
                            			   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								                    <!-- Indicators -->
								                    <ol class="carousel-indicators">
								                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
								                      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
								                      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
								                    </ol>

								                    <!-- Wrapper for slides -->
								                    <div class="carousel-inner" role="listbox">
								                      <div class="item active" >
								                        <img src="img/filmovi/<?php echo $id; ?>/1.jpg" alt="..."  >
								                      </div>
								                      <div class="item">
								                        <img src="img/filmovi/<?php echo $id; ?>/2.jpg" alt="..." >
								                        
								                      </div>
								                      <div class="item" >
								                        <img src="img/filmovi/<?php echo $id; ?>/3.jpg" alt="..."  >
								                        
								                      </div>
								                    </div>

								                    <!-- Controls -->
								                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
								                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								                      <span class="sr-only">Previous</span>
								                    </a>
								                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
								                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								                      <span class="sr-only">Next</span>
								                    </a>
								                  </div>
                            		</div></div>
                            	
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

<div class="modal fade" id="loginModalRezer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        
          <div class='alert alert-danger' role='alert'>Morate bili ulogovani da biste izvrsili rezervaciju karata<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
        
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
