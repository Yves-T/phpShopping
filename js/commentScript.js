var app = angular.module('shoppingApp', []);
app.controller('shoppingController', function () {
    var that = this;

    var hiddenFormText = 'Commentaar toevoegen';
    var showFormFormText = 'Commentaar verbergen';

    this.toggleForm = function () {
        console.log('showform before ' + this.showForm);
        this.showForm = !this.showForm;
        sessionStorage.showForm = this.showForm;
        console.log('showform after ' + this.showForm);
        setToggleButtonText();
    };

    this.isFormVisible = function () {
        setToggleButtonText();
        return JSON.parse(sessionStorage.showForm);
    };

    function checkShowForm() {
        if (typeof JSON.parse(sessionStorage.showForm) !== 'undefined') {
            that.showForm = JSON.parse(sessionStorage.showForm);
        } else {
            that.showForm = false;
        }
        setToggleButtonText();
    }

    function setToggleButtonText() {
        if (that.showForm) {
            that.toggleText = showFormFormText;
        } else {
            that.toggleText = hiddenFormText;
        }
    }

    checkShowForm();
});
