
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
                "The Account has been Deleted.",
                "success"
              ).then(() => {
                location.reload(); // Reload the page or do any other action 
              });
            } else {
              Swal.fire(
                "Error!",
                "Something went wrong while deleting the account.",
                "error"
              );
            }
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        
      }
    });
  });
});


  
  










