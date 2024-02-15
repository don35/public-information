$(document).ready(function () {
  // Use event delegation to handle dynamically added elements
  $(document).on("click", ".delete_item_btn", function (e) {
    e.preventDefault();
    var id = $(this).val();
    alert(id);

    $(document).ready(function () {
      $(".delete_item_btn").click(function (e) {
        e.preventDefault();
        var delete_product = $(this).attr("id");
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              data: {
                item_id: id,
                delete_item_btn: true,
              },
              type: "post",
              url: "code.php",
              success: function (data) {
                if (response == 200) {
                  swal("Success!", "Product Deleted Successfully", "success");
                  $("#products_table").load(location.href + "#products_table");
                } else if (response == 500) {
                  swal("Error!", "Something Went Wrong", "error");
                }
                Swal.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  icon: "success",
                }).then((result) => {
                  location.reload();
                });
              },
            });
          }
        });
      });
    });
  });
});
