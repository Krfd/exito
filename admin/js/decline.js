$(document).ready(function () {
    $(".decline_req").click(function (e) {
        e.preventDefault();
        var res_id = $(this).attr("data-id");

        Swal.fire({
            title: "Decline this reservation?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Decline",
            confirmButtonColor: "#dc3545",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#45eb45",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "./functions/decline.php",
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
                                    title: "Reservation has been declined.",
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
                                    title: "can't decline reservation. Please try again.",
                                    iconColor: "#dc3545",
                                }).then(() => {
                                    location.reload();
                                });
                                break;
                            default:
                                Toast.fire({
                                    icon: "error",
                                    title: "something went wrong!",
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