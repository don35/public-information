/*$(document).ready(function() {
  $(".delete_account_btn").click(function (e) {
    e.preventDefault();
    var account_id = $(this).val(); 

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
          data: { delete_account_btn: true, account_id: account_id }, 
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
});*/

$(document).ready(function () {

  $('.delete_account_btn').click(function (e) {
    e.preventDefault();

    var id = $(this).val();
    alert(id);
    
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "code.php",
          data: {
            'account_id': id,
            'delete_account_btn': true
          },
          success: function (response) {
            if(response == 200)
            {
              swal("Success!", "Account Deleted Successfully!", "success");
            }
            else if(response == 500)
            {
              swal("Error", "Account Deleted Successfully!", "Error");
            }
          }
        });
      }
    });
    
  })
});

