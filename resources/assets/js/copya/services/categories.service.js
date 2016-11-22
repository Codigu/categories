function categoryService($resource) {
    return $resource('/api/categories/:id',{id: '@id'},
        { query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
    );

}

categoryService.$inject = ['$resource'];

angular
    .module('copya')
    .factory('categoryService', categoryService);
