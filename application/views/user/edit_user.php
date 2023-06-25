<?php $this->load->view('includes/header'); ?>
<div class="container">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Update User</h5>

        <form method="post" action="<?= base_url() ?>user/update/<?=$id?>" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?=$user->username?>" id="username" placeholder="Enter username">

          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="<?=$user->email?>" id="email" aria-describedby="emailHelp"
              placeholder="Your Email Id">

          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="phone" name="phone" value="<?=$user->phone?>" maxlength="10" class="form-control" id="phone"
              placeholder="Your Phone Number">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" value="<?=$user->address?>" class="form-control" id="address" placeholder="Your address">
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="hidden" name="old_image" value="<?=$user->image?>">
            <input type="file" name="image"  class="form-control" id="address">
          </div>
          <img src=" <?=base_url( 'uploads/' . $user->image);?> " width=50px height=50px>
          <br>
          <br>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php
        if ($this->session->flashdata('success')) { ?>

          <div class="alert alert-success" role="alert">
            Successfully Updated
          </div>
        <?php }
        ?>
<?php
if ($this->session->flashdata('error')) { ?>

<div class="alert alert-danger" role="alert">
 Failed to update data
</div>
<?php }
?>
      </div>
    </div>
  </div>

</div>

<?php $this->load->view('includes/footer'); ?>