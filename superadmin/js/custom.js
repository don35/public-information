
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

document.getElementById('addAccountBtn').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent the form from submitting
  
  // Here you can add your code to add the data
  
  // Assuming the data was successfully added, show a SweetAlert success message
  Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Data has been added successfully.',
      showConfirmButton: false,
      timer: 1500 // Automatically close after 1.5 seconds
  });
});






