'use strict';

function CategoryCtrl($scope, $sce, $state, $stateParams, categoryService) {
    $scope.categories = [];
    $scope.category = {};

    $scope.toggleSlideUpSize = function() {
        var modalElem = $('#modalSlideUp');
        $('#modalSlideUp').modal('show');
        modalElem.children('.modal-dialog').removeClass('modal-lg');
    };

    $scope.submitCategoryForm = function(isValid) {
        // check to make sure the form is completely valid
        if (isValid) {
            if($scope.category.id){
                categoryService.update({id: $scope.category.id}, $scope.category, function (result) {
                    $('#modalSlideUp').modal('hide');
                    /*var itemIndex = $scope.menus.indexOf($scope.selectedMenu[index]);
                    $scope.menus.splice(itemIndex, 1);*/
                    $scope.category = {};
                    $scope.category_.$setUntouched();
                    $scope.category_.$setPristine();
                }, function (err) {
                    console.log(err);
                });
            } else {
                categoryService.save({}, $scope.category, function (result) {
                    $('#modalSlideUp').modal('hide');
                    $scope.categories.push(result.data);
                    $scope.category = {};
                    $scope.category_.$setUntouched();
                    $scope.category_.$setPristine();
                }, function (err) {
                    console.log(err);
                });
            }
        }
    };

    $scope.editCategory = function(category){
        $scope.category = category;
        $scope.toggleSlideUpSize();
    };

    if($state.is('categories.index')){
        categoryService.query({}, function(result){
            $scope.categories = result.data;
            console.log(result.data);
        }, function(err){

        });
    }

}

CategoryCtrl.$inject = ['$scope', '$sce', '$state', '$stateParams', 'categoryService'];

angular.module('copya', ['ui.tree'])
    // Chart controller 
    .controller('CategoryCtrl', CategoryCtrl);


