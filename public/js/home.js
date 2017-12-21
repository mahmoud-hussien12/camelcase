/**
 * Created by Mahmoud on 9/5/2017.
 */

var app = angular.module('app', [])
.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('((');
    $interpolateProvider.endSymbol('))');
})
.controller("controller", function ($scope, $compile){
    $scope.addToOrderCart = function (id, token, user_id) {
        $.ajax({
            type: "PUT",
            url: "/ordercarts/"+id+"?_token="+token+"&user_id="+user_id,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
                alert(data);
            },
            error: function (data, err, status) {
            },
            async: false
        });
    };
    $scope.addToWishCart = function (id, token, user_id) {
        if($("#like").checked){
            $.ajax({
                type: "PUT",
                url: "/wishcarts/"+id+"?_token="+token+"&user_id="+user_id,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                    alert(data);
                },
                error: function (data, err, status) {
                },
                async: false
            });
        }else{

        }
    };
});