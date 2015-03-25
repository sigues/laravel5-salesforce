var app = angular.module('contactApp', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
 
app.controller('contactController', function($scope, $http) {
    $scope.contacts = [];
    $scope.loading = false;
 
    $scope.init = function() {
        $scope.loading = true;
        $http.get('/api/contacts').
        success(function(data, status, headers, config) {
            $scope.contacts = data;
            $scope.loading = false;
        });
    }
 
    $scope.addContact = function() {
        $scope.loading = true;
        //console.log($scope);
        $http.post('/api/contacts', {
            FirstName: $scope.contact.FirstName,
            LastName: $scope.contact.LastName,
            Phone: $scope.contact.Phone,
            BirthDate: $scope.contact.BirthDate
        }).success(function(data, status, headers, config) {
            $scope.contacts.push(data);
            //$scope.contact = '';
            $scope.loading = false;
 
        });
    };
 
    $scope.updateContact = function(todo) {
        $scope.loading = true;
 
        $http.put('/api/contacts/' + todo.id, {
            title: todo.title,
            done: todo.done
        }).success(function(data, status, headers, config) {
            todo = data;
                $scope.loading = false;
 
        });;
    };
 
    $scope.deleteContact = function(index) {
        $scope.loading = true;
 
        var contact = $scope.contacts[index];
 
        $http.delete('/api/contacts/' + contact.Id)
            .success(function() {
                $scope.contacts.splice(index, 1);
                    $scope.loading = false;
 
            });;
    };
 
 
    $scope.init();
 
});

app.controller('profileController', function($scope, $http, $routeParams) {
    $scope.profile = [];
    $scope.loading = false;
    $scope.name = "profileController";
    $scope.params = $routeParams;
 
    $scope.init = function() {
        $scope.loading = true;
        console.log($scope.profile);
        $http.get('/api/contact/'+$scope.params.contactId).
        success(function(data, status, headers, config) {
            $scope.profile = data;
            $scope.loading = false;
        });
    }

    $scope.init();
 
});
