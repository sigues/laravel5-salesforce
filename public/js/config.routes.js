angular.module('contactApp').config(function($routeProvider) {
    $routeProvider
      .when('/Contact/:contactId', {
        templateUrl: 'templates/profile.html',
        controller: 'profileController'
      });

    $routeProvider.otherwise('/');
});