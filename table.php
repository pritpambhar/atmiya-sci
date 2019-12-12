
<div id="myHeader" class="bg-light">
     <h3 align="center"><b><i>ATMIYA SCIENTIFIC</i></b></h3>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline" action="table.php" method="post">
    <input style="width: 1200px; margin-left: 35px;" list="chemicals" name="chemical_name" class="form-control mr-sm-2" type="search" placeholder="S e a r c h   O t h e r   C h e m i c a l s   h e r e  .  .  .  .  .  .  ." aria-label="Search" required="required">

                     <datalist id="chemicals" class="wrap-input2">
                         <?php 
                         $con=mysqli_connect("localhost","root","","atmiya_master");
                        $customer=mysqli_query($con,"select DISTINCT Product_Description from chemical_master");                    
                           ?>
                             <?php 
                                 while($rs=mysqli_fetch_assoc($customer))
                                 {
                                     ?><option class="input100 border border-secondary" value="<?php echo $rs["Product_Description"]; ?>"><?php echo $rs["Product_Description"]; ?></option>
                                <?php }
                                    ?>
                    </datalist>

    <button class="btn btn-success" type="submit">Search</button>
  </form>
  <form action="cart.php" method="post">
     <button style="margin-right:80px;" class="btn btn-success">View Cart</button>
  </form>
</nav>
<?php
    $con=mysqli_connect("localhost","root","","atmiya_master");
    $chemical_info=mysqli_query($con,"select * from chemical_master where Product_Description='".$_POST["chemical_name"]."'"); 
?>
<html>
    <head>
        <style type="text/css">
            
            .sticky
            {
                position: fixed;
                top: 0;
                width: 100%;
            }

            .content
            {
              padding: 16px;
            }
            .sticky + .content 
            {
              padding-top: 102px;
            }

        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min_1.css" rel="stylesheet" type="text/css"/>
        <title>Atmiya Scientific</title>
    </head>
<body>    

    <h4 align="center"><b><i>list of company</i></b></h4>

<table border="1" class="table table-bordered" id="history" style="margin-left:auto;margin-right:auto;">
                    
    
                     <?php 
                         $con=mysqli_connect("localhost","root","","atmiya_master");
                        $Brand=mysqli_query($con,"select DISTINCT Brand from chemical_master");                    
                           ?>
                             <?php 
                             $i=1;
                                 while($rs=mysqli_fetch_assoc($Brand))
                                 {

                                     ?><td><input type="checkbox"  checked="checked" id="" name="brand" value="<?php echo $rs["Brand"]; ?>" onclick="filter(this)"> <?php echo $rs["Brand"]; ?></td>
                                <?php 
                                    $i++;
                                }
                                    ?>

</table>
</div>
<div class="content">


<table border="1" class="table table-bordered" id="history" style="margin-left:auto;margin-right:auto;">
    <tr>
        <th>Brand</th>
        <th>Product Code</th>
        <th>Product Description</th>
        <th>Grade</th>
        <th>Pack Size</th>
        <th>PPL 2019</th>
        <th>HSN Code</th>
        <th>Add</th>
    </tr>  
    <?php 
    while($rs=mysqli_fetch_assoc($chemical_info))
    { ?>
        <tr class="<?php echo $rs["Brand"]; ?>">
            <td><?php echo $rs["Brand"]; ?></td>
            <td><?php echo $rs["Product_Code"]; ?></td>
            <td><?php echo $rs["Product_Description"]; ?></td>
            <td><?php echo $rs["Grade"]; ?></td>
            <td><?php echo $rs["Pack_Size"]; ?></td>
            <td><?php echo $rs["PPL_2019"]; ?></td>
            <td><?php echo $rs["HSN_Code"]; ?></td>
            <td><button type="button" class="btn btn-success" onclick="input_qty()">ADD</button></td>
        </tr>
        
    <?php }
    ?>
</table>
</div>
<!--
<br><br><br><hr><br>
<h3 align="center">Cart</h3>
<br><br>
<table border="1" class="table table-bordered" id="history" style="margin-left:auto;margin-right:auto;">
    <tr>
        <th>Brand</th>
        <th>Product Code</th>
        <th>Product Description</th>
        <th>Grade</th>
        <th>Pack Size</th>
        <th>PPL 2019</th>
        <th>HSN Code</th>
        <th>Remove</th>
    </tr>  
   
</table>
-->

    <form method="post" action="cart.php" id="cart_form">
        <input type="hidden" name="qty" value="" id="qty">
        <input type="hidden" name="discount" value="" id="discount">
    </form>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>

        async function input_qty()
        {
             /*const { value: ipAddress } = Swal.fire({
              title: 'Enter Quantity',
              input: 'text',
              showCancelButton: true,
              inputValidator: (value) => {
                if (!value) {
                  return 'You need to write something!'
                }
                else
                {
                    var v=value;
                    //alert(v);
                }
              }
            });*/

             const { value: formValues } = await Swal.fire({
              title: '',
              html:
                'Enter Quantity <input id="swal-input1" class="swal2-input" required>' +
                'Enter Discount <input id="swal-input2" class="swal2-input" required>',
              focusConfirm: false,
              showCancelButton: true,
              preConfirm: () => {
                return [
                  document.getElementById('swal-input1').value,
                  document.getElementById('swal-input2').value
                ]
              }
            })

            if (formValues == ',') {
              //Swal.fire(JSON.stringify(formValues))
              //alert("empty");
            }
            else
            {
                //alert(formValues);
                var sp=formValues.toString();
                var str = sp.split(",");
                var qty =  str[0];
                var discount = str[1];
                document.getElementById("qty").value=qty;
                document.getElementById("discount").value=discount;
                document.getElementById("cart_form").submit();
                //alert(discount);
            }
           
        }

        function filter(a)
        {
           // alert();
            if(a.checked == true)
            {
               var bname = a.value;
             //document.getElementById(bname).style.display='none';
               var r=document.getElementsByClassName(bname);
              //alert(bname);
                for(var i=0; i<r.length; i++)
                {
                   r[i].style.display = 'table-row';
                }
            }
            else if(a.checked == false)
            {
                var bname = a.value;
             //document.getElementById(bname).style.display='none';
               var b=document.getElementsByClassName(bname);
              //alert(bname);
                for(var i=0; i<b.length; i++)
                {
                   b[i].style.display = 'none';
                }

            }

        }

    window.onscroll = function() {myFunction()};

    // Get the header
    var header = document.getElementById("myHeader");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    } 
    </script>

</body>
</html>
