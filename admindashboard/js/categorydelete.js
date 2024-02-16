$(document).ready(function(){
    $('.delete_category_btn').click(function(e){
        e.preventDefault();
        var category_id = $(this).data('category-id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                $.ajax({
                    type: 'POST',
                    url: 'code.php',
                    data: { delete_category_btn: true, category_id: category_id },
                    success: function(response) {
                        if(response.trim() === '200') {
                            Swal.fire(
                                'Deleted!',
                                'Your item has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page or do any other action
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Something went wrong while deleting the item.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'Something went wrong while processing your request.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
