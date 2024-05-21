$(document).ready(function () {
    $(".approve_req").click(function (e) {
        e.preventDefault();
        var res_id = $(this).attr("data-id");

        Swal.fire({
            title: "Approve this reservation?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Approve",
            confirmButtonColor: "#45eb45",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#dc3545",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "./functions/approve.php",
                    data: { id: res_id },
                    success: function (response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top",
                            customClass: {
                                popup: "colored-toast",
                            },
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                        });

                        switch (response) {
                            case "success":
                                Toast.fire({
                                    icon: "success",
                                    title: "Reservation has been approved.",
                                    iconColor: "#28a745",
                                }).then(() => {
                                    var delay = 100;
                                    setTimeout(function () {
                                        location.reload();
                                    }, delay);
                                });
                                break;
                            case "error":
                                Toast.fire({
                                    icon: "error",
                                    title: "Reservation was not approved. Please try again.",
                                    iconColor: "#dc3545",
                                }).then(() => {
                                    location.reload();
                                });
                                break;
                            default:
                                Toast.fire({
                                    icon: "error",
                                    title: "Something went wrong!",
                                    iconColor: "#dc3545",
                                }).then(() => {
                                    location.reload();
                                });
                        }
                    },
                });
                return false;
            }
        });
    });
});