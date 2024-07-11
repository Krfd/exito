$(document).ready(function () {
    $(".done").click(function (e) {
        e.preventDefault();
        var res_id = $(this).attr("data-id");

        Swal.fire({
            title: "Mark this transaction as Fully Paid?",
            text: "This action cannot be undone.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Continue",
            confirmButtonColor: "#45eb45",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#dc3545",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "./functions/done.php",
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
                                    title: "Transaction finished.",
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
                                    title: "Can't mark as done. Please try again.",
                                    iconColor: "#dc3545",
                                }).then(() => {
                                    location.reload();
                                });
                                break;
                            default:
                                Toast.fire({
                                    icon: "error",
                                    title: "Something went wrong",
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