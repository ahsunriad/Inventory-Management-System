<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="content" class="custom_content">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url();?>item">Create New Order <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>allorders">View Orders</a>
                    </li>

                </ul>
                <a href="<?php echo site_url('Logout');?>" class="btn btn-success btn-sm btn-inline my-sm-0" style="color:#fff;">Logout</a>

            </div>
        </nav>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-6">


                    <div class="container-fluid ">
                        <div class="row">

                            <div class="form-group col-md-6 align-left">
                                <label>Category:</label>
                                <select class="form-control" id="category">
                                    <option value="">Select Category</option>
                                    <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->catname; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 align-left">
                                <label>Subcategory:</label>
                                <select class="form-control" id="subcategory" disabled>
                                    <option value="">Select Subcategory</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid ">
                        <div class="row">
                            <div class="form-group">
                                <label>Search:</label>
                                <input class="form-control" type="text" id="search" placeholder="Search Items">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container-fluid ">
                        <div class="row">

                            <table class="table table-hover" id="item_table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>

                                        <th>Price</th>
                                        <th>Available Items</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container-fluid ">
                        <div class="row">
                            <?php echo form_open(base_url('admin/orderreq')); ?>


                            <table id="cart_table" class="table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Cart items will be added here -->
                                </tbody>


                            </table>
                            <?php echo form_close(); ?>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
   
 <script >
    $(document).ready(function() {
        var total = 0;
        $('#category').change(function() {
            var cat_id = $(this).val();
            if (cat_id != '') {
                $.ajax({
                    url: "<?php echo base_url('item/get_subcategories'); ?>",
                    method: "POST",
                    data: {
                        catname: cat_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var html = '<option value="">Select Subcategory</option>';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                html += '<option value="' + data[i].sid + '">' + data[i].subcname + '</option>';
                            }
                            $('#subcategory').removeAttr('disabled');
                        } else {
                            html += '<option value="">No Subcategories found</option>';
                            $('#subcategory').attr('disabled', 'disabled');
                        }
                        $('#subcategory').html(html);
                        $('#item_table tbody').html('');
                    }
                });
            } else {
                $('#subcategory').html('<option value="">Select Subcategory</option>');
                $('#subcategory').attr('disabled', 'disabled');
                $('#search').attr('disabled', 'disabled');
                $('#item_table tbody').html('');
            }
        });

        $('#subcategory').change(function() {
            var sub_id = $(this).val();
            if (sub_id != '') {
                $.ajax({
                    url: "<?php echo base_url('item/get_items'); ?>",
                    method: "POST",
                    data: {
                        subid: sub_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                html += '<tr>' +
                                    '<td>' + data[i].itemname + '</td>' +

                                    '<td>' + data[i].price + '</td>' +
                                    '<td>' + data[i].quantity + '</td>' +
                                    '<td> <a data-custom-value="' + data[i].id + '" id="add" class="btn btn-primary">add</a>'

                                '</td>' +
                                '</tr>';
                            }
                        } else {
                            html += '<tr><td colspan="5">No Items found</td></tr>';
                        }
                        $('#item_table tbody').html(html);
                    }
                });
            } else {
                $('#item_table tbody').html('');
            }
        });
        $('#search').on('input', function() {
            var search_text = $(this).val();
            if (search_text != '') {
                $.ajax({
                    url: "<?php echo base_url('item/search_items'); ?>",
                    method: "POST",
                    data: {
                        search_text: search_text
                    },
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                html += '<tr>' +
                                    '<td>' + data[i].itemname + '</td>' +

                                    '<td>' + data[i].price + '</td>' +
                                    '<td>' + data[i].quantity + '</td>' +
                                    '<td> <button data-custom-value="' + data[i].id + '" id="add" class="btn btn-primary">add</button>'

                                // +data[i].id+
                                '</td>' +
                                '</tr>';
                            }
                        } else {
                            html += '<tr><td colspan="5">No Items found</td></tr>';
                        }
                        $('#item_table tbody').html(html);
                    }
                });
            } else {
                $('#item_table tbody').html('');
            }
        });
        var itemquantity;

        $(document).on('click', '#add', function() {
            var quantity = parseInt($(this).siblings('.quantity').val());
            var itemid = $(this).data("custom-value");
            var quantity = 1; // Set the default quantity to 1

            if (itemid != '') {
                $.ajax({

                    url: "<?php echo base_url('item/add_item_to_cart'); ?>",
                    method: "POST",
                    data: {
                        itemid: itemid,
                        quantity: quantity
                    },
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                if (data[i].quantity>0){
                                    
                               

                                var itemquantity = (data[i].quantity);
                                update(itemquantity);
                                var itemSubtotal = parseFloat(data[i].price) * parseFloat(quantity);
                                html += '<tr>' +
                                    '<td>' + data[i].itemname + '</td>' +
                                    '<td>' + data[i].price + '</td>' +
                                    '<td>' +
                                    '<div class="input-group">' +
                                    '<button class="btn btn-outline-secondary decrease-quantity" type="button">-</button>' +
                                    '<input name="quantity" type="number" class="quantity" value="' + quantity + '" readonly>' +
                                    '<button class="btn btn-outline-secondary increase-quantity" type="button">+</button>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td>' + itemSubtotal + '</td>' +

                                    '<tr>' +
                                    '<td>' + '<input type="hidden" name="itemid" class="" value="' + data[i].id + '" >' + '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>' + '<input type="submit" class="btn btn-primary ">' + '</td>' +
                                    '</tr>';
                            }else {
                            html += '<tr><td colspan="4">No Items in store</td></tr>';
                        }
                         }

                        } else {
                            html += '<tr><td colspan="4">No Items found</td></tr>';
                        }
                        $('#cart_table tbody').html(html); // Replace the cart table contents with the new HTML
                    }
                });
            }
        });




        var itemQuantityf

        function update(itemquantity) {
            itemQuantityf = itemquantity

        }

        $(document).on('click', '.increase-quantity', function() {
            var quantityInput = $(this).siblings('.quantity');
            var quantity = parseInt(quantityInput.val()) + 1;
            var itemQuantity = parseInt(quantityInput.attr('max')); // assuming the maximum quantity is set as a 'max' attribute of the input element
            var price = parseFloat($(this).closest('tr').find('td:nth-child(2)').text());
            var subtotal = price * quantity;



            if (quantity <= itemQuantityf) {
                quantityInput.val(quantity);
                $(this).closest('tr').find('td:nth-child(4)').text(subtotal);
            } else {
                alert('Sorry, there are only ' + itemQuantityf + ' items available.');
                // or you can prevent the quantity from being updated, e.g.:
                // quantityInput.val(itemQuantity);
                // $(this).closest('tr').find('td:nth-child(4)').text(price * itemQuantity);
            }
        });




        $(document).on('click', '.decrease-quantity', function() {
            var quantityInput = $(this).siblings('.quantity');
            var quantity = parseInt(quantityInput.val()) - 1;
            if (quantity >= 1) {
                var price = parseFloat($(this).closest('tr').find('td:nth-child(2)').text());
                var subtotal = price * quantity;

                quantityInput.val(quantity);
                $(this).closest('tr').find('td:nth-child(4)').text(subtotal);

            }
        });



        $(document).on('input', '.quantity', function() {
            var quantity = parseInt($(this).val());
            if (isNaN(quantity) || quantity < 1) {
                $(this).val(1);
            } else {
                var price = parseFloat($(this).closest('tr').find('td:nth-child(2)').text());
                var subtotal = price * quantity;
                $(this).closest('tr').find('td:nth-child(4)').text(subtotal);

            }
        });




    });

</script>
</body>
</html>