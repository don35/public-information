$(document).ready(function () {
  $(".delete_item_btn").click(function (e) {
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
          data: { delete_item_btn: true, item_id: item_id },
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
  $(".delete_category_btn").click(function (e) {
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
          data: { delete_category_btn: true, category_id: item_id },
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
