var demo = angular.module('demo', ['ui.sortable']);

demo.controller("SimpleDemoController", function($scope) {
    $scope.active = null
    $scope.list1 = [
        {
            _id: "5a391a79734d1d2f5954ca27",
            name: "Etoro",
            logo: "https://www.interactivecrypto.com/wp-content/uploads/brokersimg/newbrokers/etoro_2.png",
            min_depot: 100,
            crypto: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png",
            user_score: 9.7,
            review_link: "https://www.interactivecrypto.com/etero-broker-review/",
            regulation: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/FlagEtoro.png",
            button_link: "https://marketing66.go2cloud.org/aff_c?offer_id=4&aff_id=1064&url_id=466"
        },
        {
            _id: "5a391a89734d1d2f5954ca2a",
            name: "Plus500",
            logo: "https://www.interactivecrypto.com/wp-content/uploads/brokersimg/newbrokers/plus500_2.png",
            min_depot: 100,
            crypto: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png",
            user_score: 9.7,
            review_link: "https://www.interactivecrypto.com/more500-broker-review/",
            regulation: "https://www.interactivecrypto.com/wp-content/uploads/2017/12/FlagPlus500-1.png",
            button_link: "http://marketing66.go2cloud.org/aff_c?offer_id=72&aff_id=1064"
        },
        {
            _id: "5a391aa0734d1d2f5954ca31",
            name: "Trade",
            logo: "https://www.interactivecrypto.com/wp-content/uploads/brokersimg/newbrokers/trade_2-2.png",
            min_depot: 100,
            crypto: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png",
            user_score: 9.7,
            review_link: "https://www.interactivecrypto.com/trade-com-review/",
            regulation: "https://www.interactivecrypto.com/wp-content/uploads/2017/12/FlagChypre.png",
            button_link: "http://marketing66.go2cloud.org/aff_c?offer_id=84&aff_id=1064&url_id=610"
        }
    ];

    $scope.sortableOptions = {
        stop: function(e, ui) {
            console.log("finished",$scope.list1)
        }
    };


    $scope.save = function() {

            console.log("finished",$scope.list1)

    };


    $scope.delete = function(user) {

        console.log("deleting",user)

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
    $scope.cancel = function(user,index) {
        //getAllUsers();
        if(isUserEmpty(user))
        {
           deleteRow(user,index)
        }
        var temp = user.editing
       // user.editing.editMode=false
        temp.editMode=false
        copyUser(user,temp)


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

    $scope.saveUser = function(user, index) {
        user.editMode = false;
        console.log("saving",user)
    }

    $scope.addNew = function() {
         var newItem = {};
        newItem.editMode = true;


        $scope.list1.push(newItem)
        console.log( $scope.list1)
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
        $scope.list1.pop()
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
    $scope.uploadTheFiles = function (event,item) {
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
                    item.logo = "../../images/uploads/brokers/" + response
                    return true;
                })
                .error(function (data, status) {
                    console.error(data);
                    console.log(status);

                    return false;
                });
        }
    };
});

