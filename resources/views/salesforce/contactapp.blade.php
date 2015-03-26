@extends('app')

@section('content')
<div class="container" ng-app="contactApp" ng-controller="contactController">
    <h1>ContactApp</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="div-wrapper">
                User: <strong>{{ $user->getUserFullName() }}</strong><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="div-wrapper">
                <form name="contactForm" method="post">
                    <div class="form-group">
                        <label for="contactFirstName">First name</label>
                        <input type='text' class="form-control" placeholder="First Name" id="contactFirstName" ng-model="contact.FirstName">
                    </div>
                    <div class="form-group">
                        <label for="contactLastName">Last name</label>
                        <input type='text' class="form-control" placeholder="Last Name" id="contactLastName" ng-model="contact.LastName">
                    </div>

                    Phone: <input type='text' ng-model="contact.Phone"><br>
                    Birth Date: <input type='text' ng-model="contact.BirthDate"><br>
                    <button class="btn btn-primary btn-md" ng-click="addContact()">Add</button>
                    <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="div-wrapper">
                <div ng-view></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr ng-repeat='contact in contacts'>
                    <!-- <td><input type="checkbox" ng-true-value="1" ng-false-value="'0'" 
                        ng-model="contact.done" ng-change="updateContact(contact)"></td> !-->
                    <td><a href="#/Contact/<% contact.Id %>"><% contact.Id %></a></td>
                    <td><% contact.FirstName %> <% contact.LastName %></td>
                    <td><% contact.Phone %></td>
                    <td><% contact.Birthdate['date'] %></td>
                    <td><button class="btn btn-danger btn-xs" ng-click="deleteContact($index)">  <span class="glyphicon glyphicon-trash" ></span></button></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

