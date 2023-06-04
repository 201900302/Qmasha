$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

  });




// for confirm order

  $(function(){
    $(document).on('click','#confirm',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to comfirm order?',
                    text: "Once you confirm order, you will not be able to role back",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirm it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Confirm',
                        'Order status has been updated to Confirmed successfully',
                        'success'
                      )
                    }
                  }) 


    });

  });



  // for process order

  $(function(){
    $(document).on('click','#process',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to process order?',
                    text: "Once you process order, you will not be able to role back",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Process it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Confirm',
                        'Order status has been updated to Processing successfully',
                        'success'
                      )
                    }
                  }) 


    });

  });


  // for deliver order

  $(function(){
    $(document).on('click','#deliver',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to deliver order?',
                    text: "Once you deliver order, you will not be able to role back",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Deliver it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Confirm',
                        'Order status has been updated to delivered successfully',
                        'success'
                      )
                    }
                  }) 


    });

  });


  ////////////////////////////////////////////////////////////////////////


// for process order item

$(function(){
  $(document).on('click','#processItem',function(e){
      e.preventDefault();
      var link = $(this).attr("href");


                Swal.fire({
                  title: 'Are you sure to process order item?',
                  text: "Once you process order item, you will not be able to role back",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Process it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                      'Confirm',
                      'Order Item status has been updated to Processing successfully',
                      'success'
                    )
                  }
                }) 


  });

});



// for ready order Item 

$(function(){
  $(document).on('click','#readyItem',function(e){
      e.preventDefault();
      var link = $(this).attr("href");


                Swal.fire({
                  title: 'Are you sure to mark the order item to Ready?',
                  text: "Once you mark tbe order item as ready, you will not be able to role back",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, its Ready!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                      'Confirm',
                      'Order Item status has been updated to Ready successfully',
                      'success'
                    )
                  }
                }) 


  });

});


// for deliver order item

$(function(){
  $(document).on('click','#deliveredItem',function(e){
      e.preventDefault();
      var link = $(this).attr("href");


                Swal.fire({
                  title: 'Are you sure to deliver order item?',
                  text: "Once you deliver order item, you will not be able to role back",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Deliver it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                      'Confirm',
                      'Order Item status has been updated to delivered successfully',
                      'success'
                    )
                  }
                }) 




               


  });

});





// for cancel order item

$(function(){
  $(document).on('click','#cancelorder',function(e){
      e.preventDefault();
      var link = $(this).attr("href");


                Swal.fire({
                  title: 'Are you sure to Cancel the Order?',
                  text: "Once you Cancel the Order, you will not be able to role back",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Cancel it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                      'Confirm',
                      'Order Cancelled Successfully',
                      'success'
                    )
                  }
                }) 




               


  });

});


 





  

