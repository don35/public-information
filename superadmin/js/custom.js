
$(document).ready(function () {
  $(".delete_account_btn").click(function (e) {
    e.preventDefault();
    var item_id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        // User confirmed, proceed with deletion
        $.ajax({
          type: "POST",
          url: "code.php",
          data: { delete_account_btn: true, account_id: item_id },
          success: function (response) {
            if (response == 200) {
              Swal.fire(
                "Deleted!",
                "Your item has been deleted.",
                "success"
              ).then(() => {
                location.reload(); // Reload the page or do any other action
              });
            } else {
              Swal.fire(
                "Error!",
                "Something went wrong while deleting the item.",
                "error"
              );
            }
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User canceled, do nothing
      }
    });
  });
});


$(document).ready(function () {
  $(".add_account_btn").click(function (e) {
    e.preventDefault();

    // Perform your form submission here
    // Replace this with your actual form submission logic
    $.ajax({
      type: "POST",
      url: "code.php",
      data: { add_account_btn: true },
      success: function (response) {
        if (response == 200) {
          Swal.fire(
            "Success!",
            "Account added successfully.",
            "success"
          ).then(() => {
            // Redirect or reload the page after success
            window.location.reload(); // Example: Reload the page
          });
        } else {
          Swal.fire(
            "Error!",
            "Failed to add account.",
            "error"
          );
        }
      },
    });
  });
});
