<?php
session_start();
include '../../../connection.php';
    $campsql = "select * from camp_master where Cluster_Id = ".$_SESSION["Cluster_Id"];
    $campres = $con->query($campsql);
    while ($row = $campres->fetch_assoc()) {
      $chestcardno = "select * from camp_cadet_entry where Camp_Id = ".$row["srno"];
      if(isset($_POST["get_enroll"]))
      {
        if(!empty($_POST["get_enroll"]))
        {
          if($_POST["get_enroll"] > 0)
          {
            $chestcardno = $chestcardno . " and Chest_Card_No LIKE '%".$_POST["get_enroll"]."%'";
          }
          else
          {
            echo "Chest Card Number Not Valid..";
            break;
          }
        }
      }
      $chestcardnores = $con->query($chestcardno);
      while ($rowchest = $chestcardnores->fetch_assoc()) {
        ?>
          <div class="col-lg-3 chest" style="padding: 5px 5px 5px 5px;">
          <center>
            <div style="color: green;">
              <?php  
                $campId = "select Camp_Id from camp_master where srno = ".$rowchest["Camp_Id"];
                echo $con->query($campId)->fetch_assoc()["Camp_Id"];
              ?>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div style="float: left;width: 50%">
                  <h2 style="color: red;"><?php echo $rowchest["Chest_Card_No"]; ?></h2>
                </div>
                <div style="float: left;width: 50%">
                  <a href="outpass.php?Bond=<?php echo $rowchest['Camp_Id']; ?>&chestcard=<?php echo $rowchest["Chest_Card_No"]; ?>&status=<?php echo $rowchest['camp_status']; ?>">
                    
                      <?php if($rowchest['camp_status'] == 1){ echo "<button style='margin-top: 20px;' class='btn btn-primary'>OUTPASS</button>"; } else { echo "<button style='margin-top: 20px;' class='btn btn-success'>INPASS</button>"; } ?>
                  </a>
                </div>
              </div>
            </div>
            <div style="margin-top: 20px;word-wrap: break-word;">
              <b>
                <?php
                  $sql = "select * from enroll_master where e_id = ".$rowchest["C_No"];
                  $res = $con->query($sql);
                  while ($rows = $res->fetch_assoc()) {
                    echo $rows["last_name"]." ".$rows["first_name"]." ".$rows["middle_name"];
                  }
                ?>
              </b>
            </div>
          </center>
        </div>
        <?php
      }
    }
  ?>