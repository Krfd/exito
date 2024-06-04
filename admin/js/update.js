$(document).ready(function () {
    $("#update").submit(function (e) {
        e.preventDefault();
        var adminData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "./functions/update.php",
                data: adminData,
                success: function (response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top",
                        customClass: {
                            popup: "colored-toast",
                        },
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                    });
                    switch (response) {
                        case "success":
                            Toast.fire({
                                icon: "success",
                                title: "Updated successfully.",
                                iconColor: "#28a745",
                                width: "50%",
                            }).then(() => {
                                var delay = 100;
                                setTimeout(function () {
                                    location.reload();
                                }, delay);
                            });
                            break;
                        case "invalid password":
                            Toast.fire({
                                icon: "error",
                                title: "Invalid input. Please try again.",
                                iconColor: "#dc3545",
                            }).then(() => {
                                location.reload();
                            });
                            break;
                        // case "error":
                        //     Toast.fire({
                        //         icon: "error",
                        //         title: "Can't update. Please try again.",
                        //         iconColor: "#dc3545",
                        //     }).then(() => {
                        //         location.reload();
                        //     });
                        //     break;
                        default:
                            Toast.fire({
                                icon: "error",
                                title: response,
                                iconColor: "#dc3545",
                            }).then(() => {
                                location.reload();
                            });
                    }
                },
            });
        });
    });