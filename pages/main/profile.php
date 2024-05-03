<style>
  .form-group {
    padding: 10px;
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-md-3 ">
      <div class="list-group ">
        <a href="index.php?manage=profile&control=viewprofile" class="list-group-item list-group-item-action <?php if($_GET['control'] == 'viewprofile'){?> active <?php } ?>">Information</a>
        <a href="index.php?manage=profile&control=viewhistoryorder" class="list-group-item list-group-item-action <?php if($_GET['control'] == 'viewhistoryorder'){?> active <?php } ?>">History Order</a>
        <a href="#" class="list-group-item list-group-item-action">Used</a>
        <a href="#" class="list-group-item list-group-item-action">Enquiry</a>


      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <?php
          if (isset($_GET['control']) && $_GET['control'] == 'viewprofile') {
              include('profile/main/customerprofile.php');
          }

          elseif (isset($_GET['control']) && $_GET['control'] == 'viewhistoryorder') {
              include('historypurchase.php');
          }

          ?>

        </div>


      </div>
    </div>
  </div>
</div>


