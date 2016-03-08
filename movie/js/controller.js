var app = angular.module('myApp', []);




app.controller('sort', function($scope, $http, $window) {
    $scope.date1 = new Date();
    $scope.date2 = new Date();
    $scope.date2.setDate($scope.date2.getDate() + 1);
    $scope.date3 = new Date();
    $scope.date3.setDate($scope.date3.getDate() + 2);
    $scope.date4 = new Date();
    $scope.date4.setDate($scope.date4.getDate() + 3);
    $scope.date5 = new Date();
    $scope.date5.setDate($scope.date5.getDate() + 4);

$scope.f = $window.filmid;
    $http.get("http://localhost/movie/controller.php?podaci=gradovibyfilm&film="+$scope.f+"").then(function(response) {
        
        $scope.gradovi = response.data;

    });


    $http.get("http://localhost/movie/controller.php?podaci=topten").then(function(response) {
        
        $scope.topten = response.data;

    });

    $scope.brKarata = 0;

    $scope.setProjekcija = function (projekcija){
        $scope.idProjekcije = projekcija.id;
        $scope.izabraniDatum = projekcija.datum;
        $scope.izabranaCena = projekcija.cena;
        $scope.preostaloMesta = projekcija.ukupno_mesta - projekcija.prodato_mesta;
    }

    $scope.rezervisi = function (){
        $scope.idKorisnika=$window.userid;

    }

   $scope.prikaziDatume = function(gradid){
    $scope.f = $window.filmid;
    
         $http.get("http://localhost/movie/controller.php/?podaci=datumi&film="+$scope.f+"&grad="+gradid+"").then(function(response) {
        $scope.datumi = response.data;
        });

         $http.get("http://localhost/movie/controller.php/?podaci=gradbyid&id="+gradid+"").then(function(response) {
        $scope.izabraniGrad = response.data;
        });
     }
    


});




app.directive('myDirective', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attr, mCtrl) {
            function myValidation(value) {
                if (value.length < 6) {
                    mCtrl.$setValidity('charE', false);
                } else {
                    mCtrl.$setValidity('charE', true);
                }
                return value;
            }
            mCtrl.$parsers.push(myValidation);
        }
    };
});


