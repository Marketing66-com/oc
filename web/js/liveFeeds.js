


var demo = angular.module('LiveFeedsApp',[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

demo.controller("LiveFeedsController", function($scope,$http) {

$scope.all =[]
    $scope.init = function(api){
        console.log("api", api)
        $.ajax({
            url: api,
            type: "GET",
            success: function (result) {

                $scope.all = result
                console.log("Response",  $scope.all)
                $scope.$apply()
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("ERROR",thrownError,xhr,ajaxOptions)
            }
        });



    }




    var socket = io.connect("https://xosignals.herokuapp.com/", {
        path: "/socket/xosignals/livefeed"
    })
    socket.on("onUpdate", function (response) {
//console.log(response)
        var item73 = $scope.all.find(function(element) {
            return element.name == response.symbol;
        });

        console.log(item73)
if(typeof item73 != typeof undefined)
{
    for (const key in response.data) {
        if (response.data.hasOwnProperty(key)) {
            item73[key] = response.data[key];
           $scope.$apply()
        }
    }
}


        /*
        FORMAT
        data
:
ask
:
1.17818
bid
:
1.17818
high
:
1.18207
low
:
1.17783
price
:
1.17818
__proto__
:
Object
symbol
:
"EURUSD"
        */


    } )








});

