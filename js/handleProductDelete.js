$(document).on("click", ".delete", function (event) {

    var answer = confirm("Wil je dit product echt verwijderen ?");
    if (answer == true) {
        $.ajax({
            url: "deleteProductFromTable.php",
            type: "POST",
            data: {"id": this.id},
            success: function (sResult) {
                // remove row closest to delete button being pressed

                if (sResult.localeCompare('OK')) {
                    $(event.target).closest("tr").remove();
                }
            },
            statusCode: {
                404: function () {
                    alert("page not found");
                }
            }
        });
    }
});