console.log($, Swal);

$(document).ready(function () {
    $(".delete").click(function () {
        Swal.fire({
            title: "Czy na pewno chcesz usunąć rekord?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Tak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data("id"),
                })
                    .done(function (data) {
                        window.location.reload();
                    })
                    .fail(function (data) {
                        Swal.fire(
                            "Oops..",
                            data.responseJSON.message,
                            data.responseJSON.status
                        );
                    });
            }
        });
    });
});
