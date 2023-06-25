<?php $this->load->view('includes/header'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
<div class="container">
    <div class="row">
        
    <div class="col md-12 float-right">
        <a href="<?=base_url()?>user/add" >
            <button type="button" class="btn btn-primary">Add </button>
        </a>  
        </div>
        <br></br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">User List</h5>
                <table class="table table-bordered">
                   <thead>
                        <tr>
                           
                        <th width=5%>SN</th>
                        <th width=15%>Username</th>
                        <th width=15%>Email</th>
                        <th width=15%>Phone</th>
                        <th width=15%>Address</th>
                        <th width=15%>Image</th>
                        <th width=20%>Options</th>
                        
                        </tr>
                   </thead>
                   <tbody>
                    <?php $i=1; foreach($crud_ci as $row) { ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$row['username']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['phone']?></td>
                            <td><?=$row['address']?></td>
                            <td><img src=" <?=base_url( 'uploads/' . $row['image']);?> " width=50px height=50px></td>
                            
                      
                            <td>
                                <a href="<?=base_url()?>user/edit/<?=$row['id']?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?=base_url()?>user/delete/<?=$row['id']?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                   </tbody>
                </table>

               
              
            </div>
        </div>
    </div>

</div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

<?php $this->load->view('includes/footer'); ?>