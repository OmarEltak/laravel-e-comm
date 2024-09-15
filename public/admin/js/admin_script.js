$(document).ready(function() {
    // Check Admin Password is correct or not
    $("#current_pwd").keyup(function() {
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            type: "POST",
            url: "/admin/check-current-pwd",
            data: {current_pwd: current_pwd},
            success: function(resp) {
                 if (resp=="false"){
                    $("#chkCurrentPwd").html("<font color='red'>Current Password is Incorrect</font>");
                }else if (resp=="true"){
                    $("#chkCurrentPwd").html("<font color='green'>Current Password is Correct</font>");
                }
            },error: function(){
                alert("Error");
            }
        })
    });

    $(".updateSectionStatus").click(function() {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            type: "POST",
            url: "/admin/update-section-status",
            data: {status: status, section_id: section_id},
            success: function(resp) {
                if (resp['status']=="0"){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>");
                }else if (resp['status']=="1"){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    $(".updateCategoryStatus").click(function() {
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $.ajax({
            type: "POST",
            url: "/admin/update-category-status",
            data: {status: status, category_id: category_id},
            success: function(resp) {
                if (resp['status']=="0"){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
                }else if (resp['status']=="1"){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    // Append Category Level
    $("#section_id").change(function(){
        var section_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "/admin/append-categories-level",
            data: {section_id: section_id},
            success: function(resp) {
                $("#appendCategoriesLevel").html(resp);
            },    error: function(xhr, status, error) {
                console.log(xhr.responseText); // Log the error response
                alert("Error: " + error); // Display an error message
            }
        })
    });

   // Delete Category Image
   function deleteCategoryImage(categoryId) {
    if (confirm("Are you sure you want to delete the category image?")) {
        $.ajax({
            url: "{{ route('admin.deleteCategoryImage', '') }}/" + categoryId,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                // Handle the successful response
                console.log(response);
                $('#category-image-preview').remove();
            },
            error: function(xhr) {
                // Handle the error
                console.error(xhr.responseText);
            }
        });

    }
    };

    // Update product status
    $(".updateProductStatus").click(function() {
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        $.ajax({
            type: "POST",
            url: "/admin/update-product-status",
            data: {status: status, product_id: product_id},
            success: function(resp) {
                if (resp['status']=="0"){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Inactive</a>");
                }else if (resp['status']=="1"){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    

    // Product Attributes ADD/REMOVE
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px"></div><input type="text" name="size[]" style="width:120px"  placeholder="Size"/>&nbsp;<input type="text" name="sku[]" style="width:120px"  placeholder="SKU"/>&nbsp;<input type="text" name="price[]" style="width:120px"  placeholder="Price"/>&nbsp;<input type="text" name="stock[]" style="width:120px"  placeholder="Stock"/><a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });

    
});
