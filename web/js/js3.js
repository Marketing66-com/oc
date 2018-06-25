


var demo = angular.module('demo', ['ui.sortable']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

demo.controller("SimpleDemoController", function($scope,$http) {
    $scope.active = null
    $scope.brokers
   $scope.defaults
    $scope.radio =
    {
        score: {
            by_default :  "radio_score_default",
            custom: "radio_score_custom"
        },

        link: {
            by_default :  "radio_link_default",
            custom: "radio_link_custom"
        },

        review: {
            by_default :  "radio_review_default",
            custom: "radio_review_custom"
        },

        logo: {
            by_default :  "radio_logo_default",
            custom: "radio_logo_custom"
        }
    }

    $scope.brokerProperties =
        {


            score:
                {
                    property:"score",
                    by_default:"score_default",
                    display: "score_default_value"
                },
            link:
                {
                    property:"link",
                    by_default:"link_default",
                    display: "link_default_value"
                },
            review:
                {
                    property:"review",
                    by_default:"review_default",
                    display: "review_default_value"
                },

            crypto:
                {
                    property:"crypto",
                    by_default:"crypto_default",
                    display: "crypto_default_value"
                },
            logo:
                {
                    property:"logo",
                    by_default:"logo_default",
                    display: "logo_default_value"
                },



        }
    //
    //    ,
    //     "radio_review_default",
    //     "radio_review_custom",
    //     "radio_link_default",
    //     "radio_link_custom",
    // }

    $scope.init = function(brokers,mydefault,all_with_default){


        $scope.brokers = all_with_default
        console.log("ng init ",all_with_default)
       $scope.defaults = mydefault

        for(let i=0; i<all_with_default.length;i++)
        {
            var current_broker = all_with_default[i]
            for (const key in $scope.brokerProperties) {
                var default_property = $scope.brokerProperties[key].by_default
                var display_property = $scope.brokerProperties[key].display
var property = $scope.brokerProperties[key].property
               if(current_broker[default_property] == 0 )//if the property isn't set by default
               {

                   if($scope.radio.hasOwnProperty(key))
                   {
                       console.log("not default key",key)
                       var radio_default_property = $scope.radio[key].by_default

                       current_broker[radio_default_property] = false
                       //console.log("display",display_property)
                       current_broker[display_property] = "set default value"
                       // var radio_custom_property = $scope.radio[key].custom
                       // current_broker[radio_custom_property] = true

                   }
               }
               else
               {
                   if($scope.radio.hasOwnProperty(key))
                   {
                       console.log("by default  key",key)
                       var radio_default_property = $scope.radio[key].by_default
                      // var display_property = $scope.radio[key].display
                       current_broker[radio_default_property] = true
                       //console.log("display",display_property)
                       current_broker[display_property] = current_broker[property]
                       // var radio_custom_property = $scope.radio[key].custom
                       // current_broker[radio_custom_property] = false
                   }
               }
            }
            current_broker.is_default = true
console.log(current_broker)
        }
       // $scope.$apply()

    }

    $scope.sortableOptions = {
        stop: function(e, ui) {
            console.log("finished",$scope.brokers)
        }
    };


    $scope.save = function() {

        console.log("finished",$scope.brokers)
        var temp_brokers = []
        angular.forEach($scope.brokers, function(value, key) {
            temp_brokers.push(value.name);
        });
        var array = {
            array:temp_brokers
}
console.log("saving",array)
/*
        $.ajax({
            url: "../brokerArray",
            type: "POST",
            data: array,
            dataType: "json",
            success: function (result) {
                console.log("Response",result)

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("ERROR",thrownError,xhr,ajaxOptions)
            }
        });
        */

    };


    $scope.delete = function(user) {


        console.log("deleting",user)
        $.ajax({
            url: "../deleteBrokers/" + user.id,
            type: "GET",
            success: function (result) {
                console.log("Response",result)
                var removeIndex = $scope.brokers.map(function(item) { return item.id; }).indexOf( parseInt(user.id));

                console.log(removeIndex)
                $scope.brokers.splice(removeIndex, 1);
                console.log("array after delete",$scope.brokers)
                $scope.$apply()
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("ERROR",thrownError,xhr,ajaxOptions)
            }
        });

    };

    //var lastEditedUser={};
    //edit user details
    $scope.editUser = function(user) {
        //angular.extend(lastEditedUser,user);
        user.editMode = true;
        user.editing = angular.copy(user)
        // user.a="b"
        //    user.editing.logo="c"
        console.log("editing user",user)
        //$scope.sort = undefined;
    }

    //cancel
    $scope.cancel = function(broker,index) {
        //getAllUsers();
        if(isUserEmpty(broker))
        {
            deleteRow(broker,index)
            return
        }
console.log("cancel broker",broker.radio_score_default)

        for(let i=0; i<$scope.radio.length;i++)
        {

            broker[$scope.radio[i]] = false
        }


        var temp = broker.editing
        // user.editing.editMode=false
        temp.editMode=false
        copyUser(broker,temp)


        //  console.log("user after cancel ", $scope.list1 )

    }


    // //delete user
    // $scope.deleteUser = function(user, index) {
    //     $scope.users = [];
    //     usersSvc.deleteUser(user, index)
    //         .then(function(response) {
    //             user.editMode = false;
    //             refreshUsers();
    //             notificationService.success("User deleted successfully.");
    //         }, function(response) {
    //             $scope.msg = response;
    //         });
    // }

    $scope.saveUser = function(broker, index) {
        broker.editMode = false;
        delete broker.editing;


console.log("user to add",broker)
               // formData.append("broker", user);
var broker_to_send = {}

        for (const key in $scope.brokerProperties) {

            var property = $scope.brokerProperties[key].property

                if($scope.radio.hasOwnProperty(key))
                {

                    var radio_default_property = $scope.radio[key].by_default

                    var isDefault = broker[radio_default_property]

                    if(isDefault == true) {
                       console.log("not adding the followinfg property",key)
                    }

                    else {
                        broker_to_send[key] = broker[key]
                    }
                }


            }

            console.log(" broker_to_send", broker_to_send)
        broker_to_send.id = broker.id



















        var object_to_send={user:broker_to_send}
        $.ajax({
            url: "../test/updateOrCreate",
            type: "POST",
            data: object_to_send,
            dataType: "json",
            success: function (result) {
                console.log("Response",result)
                if(!broker.hasOwnProperty("id"))
                    broker.id = result
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("ERROR",thrownError,xhr,ajaxOptions)
            }
        });

        //
        // $http({
        //     method: 'POST',
        //     url: "../test/update",
        //     headers: {
        //         'Content-Type': "application/json",
        //
        //     },
        //     data: user
        // })
        //     .success(function (response) {
        //         console.log("response",response);
        //
        //         //item.logo = response
        //
        //         return true;
        //     })
        //     .error(function (data, status) {
        //         console.error(data);
        //         console.log(status);
        //
        //         return false;
        //     });
       // console.log("saving",broker)
    }

    $scope.addNew = function() {
        var newItem = {};
        newItem.editMode = true;


        $scope.brokers.push(newItem)
        console.log( $scope.brokers)
    }

$scope.logoIsDefault = function (id,parameter)
{
  //  console.log("in",id,parameter)
    for(let i=0; i<$scope.defaults.length;i++)
    {
        if($scope.defaults[i].id == id)
        {
           // console.log("default item",parameter,$scope.defaults[i][parameter])
            if($scope.defaults[i][parameter] == null)
            {

                return true
            }

            else
            {
                return false
            }

        }

    }

    return true
}

    function isUserEmpty(user)
    {

        if(user.hasOwnProperty("name"))
            return false
        return true
    }


    function deleteRow(user,index)
    {

        console.log("deleting empty row",index)
        $scope.brokers.pop()
    }


    function copyUser(user,temp)
    {

        for (const key in temp) {
            if (temp.hasOwnProperty(key)) {
                user[key] = temp[key];

            }
        }

        delete user.editing;
    }

$scope.hello= function(a,b)
    {
        console.log("change",a,b)
    }
});


//
//
// demo.directive('demoFileModel', function ($parse) {
//     return {
//         restrict: 'A', //the directive can be used as an attribute only
//
//         /*
//          link is a function that defines functionality of directive
//          scope: scope associated with the element
//          element: element on which this directive used
//          attrs: key value pair of element attributes
//          */
//         link: function (scope, element, attrs) {
//             var model = $parse(attrs.demoFileModel),
//                 modelSetter = model.assign; //define a setter for demoFileModel
//
//             //Bind change event on the element
//             element.bind('change', function () {
//                 //Call apply on scope, it checks for value changes and reflect them on UI
//                 scope.$apply(function () {
//                     //set the model value
//                     modelSetter(scope, element[0].files[0]);
//                 });
//             });
//         }
//     };
// });
//
//
// demo.service('fileUploadService', function ($http, $q) {
// console.log("in service")
//     this.uploadFileToUrl = function (file, uploadUrl) {
//          var fd = new FormData();
// //         //Take the first selected file
//         fd.append("file", file);
//          var obj = {'sarah':'pause'}
//          var deffered = $q.defer();
// //         $http.post(uploadUrl, obj, {
// //             headers: {'Content-Type': undefined },
// //             transformRequest: angular.identity
// //         }).success(function (response) {
// // console.log("response",response)
// //
// //         }).error(function (response) {
// //             console.log("response",response)
// //         });
// //
// //
// //
// //
// // headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//         // $http({
//         //     method: 'POST',
//         //     url: uploadUrl,
//         //     data: fd, // pass in data as strings
//         //     headers: {'Content-Type': 'application/x-www-form-urlencoded'} , // set the headers so angular passing info as form data (not request payload)
//         //     processData: false
//         // })
//         //     .success(function (data) {
//         //         console.log(data);
//         //
//         //     });
//
//
//         jQuery.ajax({
//             url: uploadUrl,
//             data: fd,
//             cache: false,
//             //contentType: false,
//             processData: false,
//             enctype: 'multipart/form-data',
//             uploadMultiple: true,
//             method: 'POST',
//             type: 'POST', // For jQuery < 1.9
//             success: function(data){
//                 console.log("response from server",data);
//             }
//         });
//
//
//
//         return deffered.promise;
//     }
// });
//
//
// demo.controller('FileUploadController', function ($scope, fileUploadService) {
//
//     $scope.uploadFile = function () {
//         var file = $scope.myFile;
//         console.log("my file", file)
//         var uploadUrl = "../platform/saveImage", //Url of webservice/api/server
//         //var uploadUrl = "../upload_file2", //Url of webservice/api/server
//             promise = fileUploadService.uploadFileToUrl(file, uploadUrl);
//
//         promise.then(function (response) {
//             $scope.serverResponse = response;
//         }, function () {
//             $scope.serverResponse = 'An error has occurred';
//         })
//     };
// });


/*
   A directive to enable two way binding of file field
   */
demo.directive('ngFiles', Array('$parse', function ($parse) {
    return {
        link: function (scope, element, attrs) {
            var onChange = $parse(attrs.ngFiles);
            element.on('change', function (event) {
                onChange(scope, {$theFiles: event.target.files});
            });
        }
    };
}));

demo.controller('FileUploadController', function ($scope, $http) {
    var formData = new FormData();
    $scope.test = ""
    $scope.getTheFiles = function ($theFiles) {
        angular.forEach($theFiles, function (value, key) {
            formData.append(key, value);

        });
    };
    $scope.uploadTheFiles = function (event,item,img_type) {
        event.preventDefault();
        console.log("item",item)

        var formDataLength = 0;
        for (var key of formData.entries()) {
            formDataLength++;
        }

        if (formDataLength > 0) {
            var action = event.target.action || event.target.getAttribute('action');
            console.log("===event===",event)
            $http({
                method: 'POST',
                url: "../test/uploadfile",
                headers: {
                    'Content-Type': undefined,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: formData
            })
                .success(function (response) {
                    console.log("response",response);

                    //item.logo = response
                    // item.logo = "../../images/uploads/brokers/" + response
                    item[img_type] = "images/uploads/brokers/" + response

                    return true;
                })
                .error(function (data, status) {
                    //console.error(data);
                    console.log("ERROR",data,status);

                    return false;
                });
        }
    };
});

demo.controller('myCtrl2', function($scope) {
    $scope.names = ["BTC", "XRP", "ETH"];
    $scope.selectedName = "BTC"

    $scope.countries = ["UK", "France", "US"];
    $scope.selectedCountry = "UK"

    $scope.generate_table = function () {

        console.log("generating ",$scope.selectedName,$scope.selectedCountry)

    }

});