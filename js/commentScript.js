var app = angular.module('shoppingApp', []);
app.controller('shoppingController', function () {

    var hiddenFormText = 'Commentaar toevoegen';
    var showFormFormText = 'Commentaar toevoegen verbergen';
    this.showForm = false;
    this.toggleText = 'Commentaar toevoegen';

    this.toggleForm = function () {
        this.showForm = !this.showForm;
        if (this.showForm) {
            this.toggleText = showFormFormText;
        } else {
            this.toggleText = hiddenFormText;
        }

    };

});
