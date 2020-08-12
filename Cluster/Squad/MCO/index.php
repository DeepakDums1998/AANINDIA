
<?php include'header.php';

    ?>
<script src="../../../Resources/js/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script type="text/javascript">
    $(document).ready(function(){
      $.ajax({
         type: 'post',
         url: 'allchest_card.php',
         success: function (response) {
            document.getElementById("chest_card").innerHTML = response;
         }
     });
        $("#bond").keyup(function(){
            var data = document.getElementById("bond").value;
            $.ajax({
               type: 'post',
               url: 'allchest_card.php',
               data: {
                   get_enroll: data
               },
               success: function (response) {
                  document.getElementById("chest_card").innerHTML = response;
               }
           });
        });
    });
</script>
<style type="text/css">
  .chest{
    height: 150px;
    margin: 20px 20px 30px 30px;
    box-shadow: 0px 0px 20px black;
  }
</style>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">OUTPASS</h2>
                            <div>
                              <div class="form-group">
                                    <label>Enter Chest Card Number Here</label>
                                    <input type="text" id="bond" class="form-control" autofocus>
                                    <p class="help-block">Example : 1111 </p>
                                </div>
                                <div>
                            </div>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="chest_card">
                        </div>
                    </div>
                </div>
<?php include'footer.php'; ?>