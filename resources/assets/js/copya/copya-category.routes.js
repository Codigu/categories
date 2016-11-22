

function categoryRoutes($stateProvider, $urlRouterProvider, $httpProvider) {
    //$http.defaults.headers.get['X-CSRFToken'] = Laravel.csrfToken;

    $stateProvider
        .state('categories', {
            abstract: true,
            url: '/',
            templateUrl: "js/copya/tpl/app.html",
        })
        .state('categories.index', {
            url: "categories",
            templateUrl: "js/copya/tpl/categories.index.html",
            controller: 'CategoryCtrl',
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        ], {
                            insertBefore: '#lazyload_placeholder'
                        })
                        .then(function() {
                            return $ocLazyLoad.load([
                                'js/copya/controllers/categories.js'
                            ]);
                        });
                }]
            }
        });
}

categoryRoutes.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];
//
angular.module('copya')
    .config(categoryRoutes);