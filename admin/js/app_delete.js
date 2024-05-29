$(document).ready(function () {
    $(".delete_app").click(function (e) {
        e.preventDefault();
        var app_id = $(this).attr("data-id");

        Swal.fire({
            title: "Delete this meeting permanently?",
            text: "This action cannot be undone.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
            confirmButtonColor: "#dc3545",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#45eb45",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "./functions/delete_meeting.php",
                    data: { id: app_id },
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
                                    title: "Meeting has been permanently deleted.",
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
                                    title: "can't delete meeting. Please try again.",
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