<?php
    include '../header.php';
    include '../connection.php';
    include '../sendmsg.php';
    $visible = "hidden";
?>
<style type="text/css">
  #campyear{
      visibility: hidden;
  }
  .visiblehide{
    visibility: hidden;
  }
  .visibledata{
    visibility: visible;
  }
</style>
  <script src="../Resources/js/jquery.min.js"></script>
  <script>
    function clearsss(val)
    {
      document.getElementById("state").value = "";
      document.getElementById("uno").value = "";
      document.getElementById("troop_code").value = "";
    }
     function fetch_erno(val)
     {
         $.ajax({
             type: 'post',
             url: 'load_erno.php',
             data: {
                 get_option: val
             },
             success: function (response) {
              // alert(response);
               var data = response.split("_");
               var counter;
               var options = "<option>-----select-----</option>";
               for(counter = 0;counter < data.length-1;counter++)
               {
                 options = options + "<option>"+data[counter]+"</option>";
               }
               document.getElementById("state").innerHTML = options;
             }
         });
     }

     $(document).ready(function(){
        $('#checkATC').click(function(){
            if($(this).prop("checked") == true){
                $("#rdSTC").prop("checked", true);
                $("#rdSTC").prop("disabled", false);
                $("#rdATC").prop("disabled", true);
            }
            else if($(this).prop("checked") == false){
                $("#rdATC").prop("checked", true);
                $("#rdSTC").prop("disabled", true);
                $("#rdATC").prop("disabled", false);
            }
        });
        $('#checkSTC').click(function(){
            if($(this).prop("checked") == true){
                $("#rdOTC").prop("checked", true);
                $("#checkATC").prop("checked", true);
                $("#checkATC").attr("disabled", true);
                $("#rdOTC").prop("disabled", false);
                $("#rdSTC").prop("disabled", true);
                $("#rdATC").prop("disabled", true);
            }
            else if($(this).prop("checked") == false){
                $("#rdATC").prop("checked", true);
                $("#rdATC").prop("disabled", false);
                $("#rdSTC").prop("disabled", true);
                $("#rdOTC").prop("disabled", true);
                $("#checkATC").prop("checked", false);
                $("#checkATC").attr("disabled", false);
            }
        });
    });

     $(document).ready(function(){
      $("#cdt_aadhar").keypress(function(e){
        var data = $("#cdt_aadhar").val();
        if(data.length == 4)
        {
          data = data + "-";
        }
        if(data.length == 9)
        {
          data = data + "-";
        }
        $("#cdt_aadhar").val(data);
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
        }
      });

      $("#state").change(function(){
         var erid=$("#erid").val();
          var troop_code=$("#troop_code").val();
           var state=$("#state").val();
      
           $.ajax({
             type: 'post',
             url: 'load_enrollment.php',
             data: {
                 er_id : erid,troopcode : troop_code , state_id : state
             },
             success: function (response) {
                 var currentYear = (new Date).getFullYear();
                 var year = "" + currentYear;
                 var lastdigityear = year.substr(year.length-2);
                  $("#uno").val(response);
                  $("#btnentercadets").click();
             }
         });

     });

      /*var isDisabled = $('#t_year').prop('disabled');
      if(isDisabled == false)
      {
        var data2 = document.getElementById("t_year").value;
        if(data2 == 1)
        {
          $('#rdNULL').prop('checked', true);
          $('#rdNULL').attr('disabled', false);
          $('#rdATC').attr('disabled', false);
          $('#rdSTC').attr('disabled', true);
          $('#rdOTC').attr('disabled', true);
          $('#checkATC').attr('disabled', true);
          $('#checkSTC').attr('disabled', true);
        }
      }*/
     
     $("#t_year").change(function(){
        var data2 = document.getElementById("t_year").value;
        if(data2 == 1)
        {
          $('#rdNULL').prop('checked', true);
          $('#rdNULL').attr('disabled', false);
          $('#rdATC').attr('disabled', false);
          $('#rdSTC').attr('disabled', true);
          $('#rdOTC').attr('disabled', true);
          $('#checkATC').attr('disabled', true);
          $('#checkSTC').attr('disabled', true);
        }
        if(data2 == 2)
          {
            $('#rdNULL').prop('checked', true);
            $('#rdNULL').attr('disabled', false);
            $('#rdATC').attr('disabled', true);
            $('#rdSTC').attr('disabled', true);
            $('#rdOTC').attr('disabled', true);
            $('#checkATC').attr('disabled', true);
            $('#checkSTC').attr('disabled', true);
          }
          if(data2 == 3)
          {
            $('#rdNULL').attr('disabled', true);
            $('#rdATC').attr('disabled', false);
            $('#rdATC').prop('checked', true);
            $('#rdSTC').attr('disabled', true);
            $('#rdOTC').attr('disabled', true);
            $('#checkATC').attr('disabled', true);
            $('#checkSTC').attr('disabled', true);
          }
          if(data2 == 4)
          {
            $('#rdATC').attr('disabled', false);
            $('#rdATC').prop('checked', true);
            $('#rdNULL').attr('disabled', true);
            $('#rdSTC').attr('disabled', true);
            $('#rdOTC').attr('disabled', true);
            $('#checkATC').attr('disabled', false);
            $('#checkSTC').attr('disabled', true);
          }
          if(data2 == 5)
          {
            $('#rdATC').attr('disabled', false);
            $('#rdATC').prop('checked', true);
            $('#rdNULL').attr('disabled', true);
            $('#rdSTC').attr('disabled', true);
            $('#rdOTC').attr('disabled', true);
            $('#checkATC').attr('disabled', false);
            $('#checkSTC').attr('disabled', false);
          }
    });
   
      $("#uno").change(function(){
       var data1 = document.getElementById("uno").value;
       if(data1 >= 1000)
       {
         alert("Please Enter Valid Reg Number");
       }
      });
   });
  </script>
  <!-- Page Content -->
  <div id="page-wrapper">
  <div class="container-fluid">
  <div class="row">
     <div class="col-lg-12">
        <b>
           <h4 class="page-header">Enrollment Master</h4>
        </b>
           <div class="row">
              <div class="col-lg-12">
                 <div class="panel panel-default">
                    <div style="color: red;" class="panel-heading">
                       <b>Enrollment Id</b>
                    </div>
                    <form role="form" method="Post" enctype="multipart/form-data">
                       <div class="panel-body">
                          <div class="row">
                             <div class="col-lg-2">
                                <div class="form-group">
                                   <select class="form-control" name="year" id="erid" onchange="clearsss(this.value)">
                                      <?php
                                        $query = "select * FROM year_master ORDER BY year_code DESC";
                                        $rs = $con->query($query);
                                        while($row = $rs->fetch_assoc())
                                        {
                                          ?>
                                          <option value="<?php echo $row["year_code"]; ?>"><?php echo $row["year_code"]; ?></option>
                                          <?php
                                        }
                                       ?>
                                   </select>
                                </div>
                             </div>
                             <div class="col-lg-2">
                              <div class="form-group">
                                <input class="form-control" name="troop_code" id=troop_code onchange="fetch_erno(this.value);" pattern="[0-9]{4}" title="Only Four Digit Cadet School No." required>
                                </div>
                             </div>
                             <div class="col-lg-2">
                              <div class="form-group">
                                <select class="form-control" name="state" id="state">
                                   <option value=" "></option>
                                   <?php
                                      $query = "select * FROM state_master order by state_name ASC";
                                      $rs    = $con->query($query);
                                      while ($row = $rs->fetch_assoc()) {
                                      ?>
                                          <option value="<?php echo $row["state_code"];?>" selected>
                                            <?php echo $row["state_code"];?></option>
                                   
                                   <?php
                                      }
                                      ?>
                                </select>
                              </div>
                             </div>
                                <div class="col-lg-2">
                                  <div class="form-group">
                                    <input class="form-control" name="uno" id="uno" pattern="[0-9]{3}" title="Three Digit Cadet Form No." required>
                                  </div>
                               </div>
                               <div class="col-lg-2">
                                <div class="form-group">
                                  <button type="submit" id="btnentercadets" name="btnentercadets" class="btn btn-success">View Cadets</button>
                                </div>
                               </div>
                          </div>
                       </div>
                       </form>
                 </div>
                 </div>
               
                 <div class="col-lg-12" style="visibility:hidden;" id="erno_form">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="form-group">
                        <h4><b><label id="idnext" name="idnext" style="color: red;">Enrollment Form Number Is : <?php
                           $erno = "";
                           if (isset($_POST["btnentercadets"]) || isset($_POST["btnnewyear"])) {
                                $year       = $_POST["year"];
                                 $troop_code = $_POST["troop_code"];
                                 $state      = $_POST["state"];
                                 $uno        = $_POST["uno"];
                                 
                                 $erno = $year . "-" . $troop_code . "-" . $state . "-" . $uno;
                                 
                                 if ($uno >= 1000) {
                                     
                                 } else {
                                     echo $erno;
                                 }
                               
                           }
                           ?></label>
                         </h4></b>

                         </div>
                     </div>
                     
                       <form role="form" id="enroll_detail" method="Post" enctype="multipart/form-data">
                          <div class="panel-body">
                             <div class="row">
                              <div class="col-lg-12">
                                 <div class="panel panel-default">
                                    <div style="color: red;" class="panel-heading">
                                       <b>Personal Details </b>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                              <label>First Name <b><span style="color:red;"> * </span></b> </label>
                                              <input style="text-transform: uppercase;" class="form-control" id="firstname" placeholder="Cadet Name " name="cdt_first_name" required>
                                           </div>
                                        </div>
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                              <label>Middle Name <b><span style="color:red;"> * </span></b></label>
                                              <input style="text-transform: uppercase;" class="form-control" id="middlename" placeholder="Father Name " name="cdt_middle_name" required>
                                           </div>
                                        </div>
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                              <label>Last Name <b><span style="color:red;"> * </span></b></label>
                                              <input style="text-transform: uppercase;" class="form-control" id="lastname" placeholder="Surname " name="cdt_last_name" required>
                                           </div>
                                        </div>
                                        <div class="col-lg-4">
                                         <div class="form-group">
                                            <label>STD <b><span style="color:red;"> * </span></b></label>
                                            <input style="text-transform: uppercase;" type='text' class="form-control" name="cdt_std" id="std" required="" />
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                            <label> Form Number <b><span style="color:red;"> * </span></b></label>
                                            <input class="form-control" type="number" placeholder="Ex :- 1028" name="cdt_form_no" id="cdt_form_no" pattern="[0-9]{4,6}" required="">
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                            <label>Select Training Year <b><span style="color:red;"> * </span></b></label>
                                            <select name="t_year" id="t_year" class="form-control" disabled="">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                         </div>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>



                                <div class="col-lg-12">
                                  <div class="panel panel-default">
                                    <div style="color: red;" class="panel-heading">
                                       <b> Address & Mobile </b>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-lg-8">
                                         <div class="form-group">
                                            <label> Address Line</label>
                                            <input style="text-transform: uppercase;" class="form-control" name="cdt_add" id="cdt_add">
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                            <label>City / Village</label>
                                            <input style="text-transform: uppercase;" class="form-control" placeholder="Ex :- Mandvi" name="cdt_city" id="cdt_city">
                                         </div>
                                      </div>
                                      <div class="col-lg-3">
                                         <div class="form-group">
                                            <label>Mobile Number </label>
                                            <input class="form-control" type="number" placeholder="Ex :- 7698320138" name="cdt_mo1" id="cdt_mo1">
                                         </div>
                                      </div>
                                      <div class="col-lg-3">
                                         <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" type="number" placeholder="Ex :- 7698320138" name="cdt_mo2" id="cdt_mo2">
                                         </div>
                                      </div>

                                      <div class="col-lg-6" id="campyear" style="visibility: hidden;">
                                        <div class="form-group">
                                          <label>Camp Year</label><br/>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdATC" name="rdcampyear" value="ATC" > <label>ATC</label><br/>
                                                <input type="checkbox" id="checkATC" name="checkcampyear" disabled=""> <label>ATC Done</label>
                                              </div>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdSTC" value="STC" name="rdcampyear" value="ATC" disabled=""> <label> STC</label>
                                                <br/>
                                                <input type="checkbox" id="checkSTC" name="checkcampyear" disabled=""> <label>STC Done</label>
                                              </div>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdOTC" value="OTC" name="rdcampyear" disabled=""> <label> OTC</label>
                                              </div>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdNULL" value="NULL" name="rdcampyear" checked=""> <label> NULL</label>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                </div>


                                <div class="col-lg-12">
                                  <div class="panel panel-default">
                                    <div style="color: red;" class="panel-heading">
                                       <b> Other Details </b>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label>Blood Group</label>
                                              <select class="form-control" name="cdt_bgroup" id="cdt_bgroup">
                                                 <option selected>Null</option>
                                                 <option>A+</option>
                                                 <option>B+</option>
                                                 <option>O+</option>
                                                 <option>AB+</option>
                                                 <option>A-</option>
                                                 <option>B-</option>
                                                 <option>O-</option>
                                                 <option>AB-</option>
                                              </select>
                                           </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label>Gender</label>
                                              <select class="form-control" name="cdt_gender" id="cdt_gender">
                                                 <option value="M">Male</option>
                                                 <option value="F">Female</option>
                                                 <option value="O">Other</option>
                                              </select>
                                           </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label> Birth Date </label>
                                              <input  type="date"  class="form-control " name="cdt_dob" id="cdt_dob">
                                           </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label>Aadhar Card No</label>
                                              <input class="form-control" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" maxlength="14" placeholder="Ex :- 7698 - 3201 - 3812 " name="cdt_aadhar" id="cdt_aadhar">
                                           </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>


                              </div>
                                <div id="newcadet">
                                  <div class="form-group">
                                    <div class="col-lg-2">
                                       <button type="submit" name="btnsubmit" class="btn btn-success">Enroll Cadet</button>
                                    </div>
                                  </div>
                                </div>
                                <div id="oldcadet">
                                  <div class="form-group">
                                    <div class="col-lg-2">
                                       <button type="submit" name="btnedit" class="btn btn-success">Edit Cadet</button>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-2">
                                       <button  type="submit" name="btnnext" id="btnnext" class="btn btn-primary">Promote Year</button>
                                  </div>
                                </div>
                          </div>
                        </form>
                        
                 </div>
              </div>
              </div>
              
                
              </div>
           </div>
         </div>
       </div>
           <?php
              if (isset($_POST["btnentercadets"])) {
                  echo "<script>$('#oldcadet').hide();$('#btnnext').hide();</script>";
                  $year       = $_POST["year"];
                  $troop_code = $_POST["troop_code"];
                  $state      = $_POST["state"];
                  $uno        = $_POST["uno"];

                  $erno = $year . "-" . $troop_code . "-" . $state . "-" . $uno;
                  
                  if ($uno >= 1000) {
                      echo "<script>alert('Please Enter Valid Reg Number');</script>";
                  } else {
                    $error = 0;
                      $cadet_no         = substr($erno, 10);
                      $_SESSION["erno"] = $erno;
                      $query            = "select * from enroll_master where enrollment_id='" . $erno . "'";
                      $rs               = $con->query($query);
                      if ($row = $rs->fetch_assoc()) {
                          echo "<script>" . "$('#firstname').attr('readonly',true).val('" . $row["first_name"] . "');" . "$('#middlename').attr('readonly',true).val('" . $row["middle_name"] . "');" . "$('#lastname').attr('readonly',true).val('" . $row["last_name"] . "');" . "$('#std').attr('readonly',true).val('" . $row["std"] . "');" . "$('#cdt_form_no').attr('readonly',true).val('" . $row["form_no"] . "');" . "$('#cdt_add').attr('readonly',true).val('" . $row["address"] . "');" . "$('#cdt_city').attr('readonly',true).val('" . $row["city"] . "');" . "$('#cdt_mo1').attr('readonly',true).val('" . $row["mobile1"] . "');" . "$('#cdt_mo2').attr('readonly',true).val('" . $row["mobile2"] . "');" . "$('#cdt_bgroup').attr('readonly',true).val('" . $row["blood_group"] . "');" . "$('#cdt_gender').attr('readonly',true).val('" . $row["gender"] . "');" . "$('#cdt_dob').attr('readonly',true).val('" . $row["birthdate"] . "');" . "$('#cdt_aadhar').attr('readonly',true).val('" . $row["aadharcard_no"] . "');
                            $('#t_year').attr('readonly',true).val('" . $row["t_year"] . "');
                            $('#atc').attr('readonly',true).val('" . $row["atc"] . "');
                            $('#stc').attr('readonly',true).val('" . $row["stc"] . "');
                            $('#otc').attr('readonly',true).val('" . $row["otc"] . "');
                            $('#newcadet').hide();$('#oldcadet').show();$('#btnnext').show();" . "</script>";
                            echo "<script>" . "$('#erno_form').css('visibility','visible');" . "</script>";
                      }
                      else
                      {
                        echo "<script>" . "$('#campyear').css('visibility', 'visible');" . "</script>";
                      }
                      echo "<script>" . "$('#erno_form').css('visibility','visible');" . "</script>";
                            
                  }


                  echo "<script>var formno = ".(($uno + 1)-1).";";
                        echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                        echo "if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                        echo "if(formno >= 100 & formno <= 999){ formno = formno; }";
                        echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                        echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                        echo "document.getElementById('state').value = state;";
                        echo "document.getElementById('uno').value = formno;";
                        echo "var year = ".(explode("-", $_SESSION["erno"])[0]).";";
                        echo "document.getElementById('erid').value = year;</script>";
              }

              if (isset($_POST["btnsubmit"])) {
                  $enrol = $_SESSION["erno"];
                  $firstname = strtoupper($_POST["cdt_first_name"]);
                  $middlename = strtoupper($_POST["cdt_middle_name"]);
                  $lastname = strtoupper($_POST["cdt_last_name"]);
                  $std = strtoupper($_POST["cdt_std"]);
                  $form_no = $_POST["cdt_form_no"];
                  $address = strtoupper($_POST["cdt_add"]);
                  $city = strtoupper($_POST["cdt_city"]);
                  $mo1 = $_POST["cdt_mo1"];
                  $mo2 = $_POST["cdt_mo2"];
                  $blood_group = strtoupper($_POST["cdt_bgroup"]);
                  $gen = strtoupper($_POST["cdt_gender"]);
                  $BDate = $_POST["cdt_dob"];
                  $aadhar = $_POST["cdt_aadhar"];
                  $t_year = 1;
                  $atc = 0;
                  $stc = 0;
                  $otc = 0;

                  if($t_year == 1)
                  {
                    if($_POST["rdcampyear"] == "ATC")
                    {
                       $atc = 1;$stc = 0;$otc = 0;
                    }
                    else if($_POST["rdcampyear"] == "NULL")
                    {
                      $atc = 0;$stc = 0;$otc = 0;
                    }
                  }
                  if($t_year == 2)
                  {
                    if($_POST["rdcampyear"] == "NULL")
                    {
                      $atc = 0;$stc = 0;$otc = 0;
                    }
                  }
                  if($t_year == 3)
                  {
                    if($_POST["rdcampyear"] == "ATC")
                    {
                       $atc = 1;$stc = 0;$otc = 0;
                    }
                  }
                  if($t_year == 4)
                  {
                    if($_POST["rdcampyear"] == "ATC")
                    {
                       $atc = 1;$stc = 0;$otc = 0;
                    }
                    else if($_POST["rdcampyear"] == "STC")
                    {
                      $atc = 0;$stc = 1;$otc = 0;
                    }
                  }
                  if($t_year == 5)
                  {
                    if($_POST["rdcampyear"] == "ATC")
                    {
                    $atc = 1;$stc = 0;$otc = 0;
                    }
                    else if($_POST["rdcampyear"] == "STC")
                    {
                      $atc = 0;$stc = 1;$otc = 0;
                    }
                    else if($_POST["rdcampyear"] == "OTC")
                    {
                      $atc = 0;$stc = 0;$otc = 1;
                    }
                  }
                  

                  $status = 0;
                  $sql1 = "select * from enroll_master where enrollment_id = '".$enrol."'";
                  $rs = $con->query($sql1);
                  while ($row = $rs->fetch_assoc()) {
                    $status = 1;
                  }
                  if($status == 0)
                  {
                    $time = date("y-m-d h:i:s");
                    $min = "+5 hours";
                    $cenvertedTime = date('Y-m-d H:i:s',strtotime($min,strtotime($time)));
                    $min = "+30 min";
                    $cenvertedTime = date('Y-m-d H:i:s',strtotime($min,strtotime($cenvertedTime)));
                    $sql = "";
                    if($BDate == "")
                    {
                      $sql = "INSERT INTO enroll_master(enrollment_id, yoe, t_year,c_year, first_name, middle_name, last_name, std, form_no, address, city, mobile1, mobile2, blood_group, gender, birthdate, aadharcard_no, status, late_status, atc, stc, otc, date_time) VALUES ('".$enrol."','".explode("-", $_SESSION["erno"])[0]."',".$t_year.",'".date("Y")."','".$firstname."','".$middlename."','".$lastname."','".$std."',".$form_no .",'".$address."','".$city."','".$mo1."','".$mo2."','".$blood_group."','".$gen."',NULL,'".$aadhar."',1,1,".$atc.",".$stc.",".$otc.",'".$cenvertedTime."')";
                    }
                    else
                    {
                      $sql = "INSERT INTO enroll_master(enrollment_id, yoe, t_year,c_year, first_name, middle_name, last_name, std, form_no, address, city, mobile1, mobile2, blood_group, gender, birthdate, aadharcard_no, status, late_status, atc, stc, otc, date_time) VALUES ('".$enrol."','".explode("-", $_SESSION["erno"])[0]."',".$t_year.",'".date("Y")."','".$firstname."','".$middlename."','".$lastname."','".$std."',".$form_no .",'".$address."','".$city."','".$mo1."','".$mo2."','".$blood_group."','".$gen."','".$BDate."','".$aadhar."',1,1,".$atc.",".$stc.",".$otc.",'".$cenvertedTime."')";
                    }
                      
                    
                    if ($con->query($sql) == TRUE) {
                      $sql23 = "select * from year_master Order By year_code DESC limit 1";
                          $resss = $con->query($sql23);
                          $_SESSION["Send"] = 1;
                          if($mo1 == NULL)
                          {
                            $sqlllll = "select * from school_master where troop_code = ".explode("-", $enrol)[1];
                            $res = $con->query($sqlllll);
                            while ($row = $res->fetch_assoc()) {
                              $mo1 = $row["incharge_no"];
                            }
                          }
                        if($mo1 != "" || $mo2 != "")
                        {
                          $ty = "";
                          $select = "select * from enroll_master where enrollment_id = '".$enrol."'";
                          $res123 = $con->query($select);
                          while($row = $res123->fetch_assoc())
                          {
                            $ty = $row["t_year"];
                          }

                          $sql23 = "select * from year_master Order By year_code DESC limit 1";
                          $resss = $con->query($sql23);
                          $_SESSION["Send"] = 1;
                          $_SESSION["mobile_no"] = $mo1;
                          $_SESSION["msg"] = "Your child ".strtoupper($name)." is enrolled in AAN (Alumni Association of NCC Cadets) for the training year ".$resss->fetch_assoc()["year_range"];
                          $_SESSION["msg1"] = "Enrollemnt number is ".$enrol." in year of training ".$ty." on basis of his application form ".$form_no." of AAN.";
                        }

                        $_SESSION["Done"] = 1;
                        echo "<script>var formno = ".(explode("-", $_SESSION["erno"])[3] + 1).";";
                        echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                        echo "else if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                        echo "else if(formno >= 100 & formno <= 999){ formno = formno; }";
                        echo "document.getElementById('uno').value = formno;";
                        echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                        echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                        echo "document.getElementById('state').value = state;";
                        echo "document.getElementById('erid').value = '".(explode("-", $_SESSION["erno"])[0])."';";
                        echo "alert('Cadet Add Successfully.'); ";
                        echo "document.getElementById('btnentercadets').click();</script>";
                    }
                  }
                  else
                  {
                    echo "<script>alert('".$_SESSION["erno"]." - This Enrollment is already enroll.');</script>";
                    echo "<script>var formno = ".(explode("-", $_SESSION["erno"])[3] + 1).";";
                    echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                    echo "if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                    echo "if(formno >= 100 & formno <= 999){ formno = formno; }";
                    echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                    echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                    echo "document.getElementById('state').value = state;";
                    echo "document.getElementById('erid').value = '".(explode("-", $_SESSION["erno"])[0])."';";
                    echo "document.getElementById('uno').value = formno;</script>";
                  }
              }

              if (isset($_POST["btnedit"])) {
                  $query            = "select * from enroll_master where enrollment_id = '" . $_SESSION["erno"] . "'";
                  $rs               = $con->query($query);
                  if ($row = $rs->fetch_assoc()) {                    
                      echo "<script>" . "$('#firstname').val('" . $row["first_name"] . "');"
                      . "$('#middlename').val('" . $row["middle_name"] . "');"
                      . "$('#lastname').val('" . $row["last_name"] . "');" 
                      . "$('#std').val('" . $row["std"] . "').attr('readonly',true);" 
                      . "$('#cdt_form_no').val('" . $row["form_no"] . "').attr('readonly',true);" 
                      . "$('#cdt_add').val('" . $row["address"] . "');" 
                      . "$('#cdt_city').val('" . $row["city"] . "');" 
                      . "$('#cdt_mo1').val('" . $row["mobile1"] . "');" 
                      . "$('#cdt_mo2').val('" . $row["mobile2"] . "');" 
                      . "$('#cdt_bgroup').val('" . $row["blood_group"] . "');" 
                      . "$('#cdt_gender').val('" . $row["gender"] . "');" 
                      . "$('#cdt_dob').val('" . $row["birthdate"] . "');" 
                      . "$('#cdt_aadhar').val('" . $row["aadharcard_no"] . "');"
                      . "$('#t_year').val('" . $row["t_year"] . "');"
                      . "$('#otc').attr('readonly','true').val(". $row["otc"] .");"
                      . "$('#stc').attr('readonly','true').val(". $row["stc"] .");"
                      . "$('#atc').attr('readonly','true').val(". $row["atc"] .");"
                      . "if(".$row["t_year"]." == 3) { "
                      . "    $('#atc').removeAttr('readonly');"
                      . "    }"
                      . "if(".$row["t_year"]." == 4) { "
                      . "    $('#atc').removeAttr('readonly');"
                      . "    $('#stc').removeAttr('readonly');"
                      . "  }"
                      . "if(".$row["t_year"]." == 5) {    "
                      . "    $('#atc').removeAttr('readonly');"
                      . "    $('#stc').removeAttr('readonly');"
                      . "    $('#otc').removeAttr('readonly'); "
                      . "  }"
                      . "$('#btnnext').text('Update').attr('name','btnupdate').attr('id','btnupdate');
                        $('#newcadet').hide();$('#oldcadet').hide();" . "</script>";
                  }
                  echo "<script>" . "$('#erno_form').css('visibility','visible');" . "</script>";

                  echo "<script>var formno = ".(explode("-", $_SESSION["erno"])[3]).";";
                  echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                  echo "if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                  echo "if(formno >= 100 & formno <= 999){ formno = formno; }";
                  echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                  echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                  echo "document.getElementById('state').value = state;";
                  echo "document.getElementById('uno').value = formno;";
                  echo "var year = ".(explode("-", $_SESSION["erno"])[0]).";";
                  echo "document.getElementById('erid').value = year;</script>";
              }


              if (isset($_POST["btnupdate"])) {
                $queryupdate = "";
                if($BDate == "")
                {
                  $queryupdate = "UPDATE enroll_master SET first_name='" . $_POST["cdt_first_name"] . "',last_name='" . $_POST["cdt_last_name"] . "',middle_name='" . $_POST["cdt_middle_name"] . "',std='" . $_POST["cdt_std"] . "',form_no='" . $_POST["cdt_form_no"] . "',address='" . $_POST["cdt_add"] . "',city='" . $_POST["cdt_city"] . "',mobile1='" . $_POST["cdt_mo1"] . "',mobile2='" . $_POST["cdt_mo2"] . "',blood_group='" . $_POST["cdt_bgroup"] . "',gender='" . $_POST["cdt_gender"] . "',birthdate=NULL,aadharcard_no='" . $_POST["cdt_aadhar"] . "'" ." WHERE enrollment_id='" . $_SESSION["erno"] . "'";
                }
                else
                {
                  $queryupdate = "UPDATE enroll_master SET first_name='" . $_POST["cdt_first_name"] . "',last_name='" . $_POST["cdt_last_name"] . "',middle_name='" . $_POST["cdt_middle_name"] . "',std='" . $_POST["cdt_std"] . "',form_no='" . $_POST["cdt_form_no"] . "',address='" . $_POST["cdt_add"] . "',city='" . $_POST["cdt_city"] . "',mobile1='" . $_POST["cdt_mo1"] . "',mobile2='" . $_POST["cdt_mo2"] . "',blood_group='" . $_POST["cdt_bgroup"] . "',gender='" . $_POST["cdt_gender"] . "',birthdate='" . $_POST["cdt_dob"] . "',aadharcard_no='" . $_POST["cdt_aadhar"] . "'" ." WHERE enrollment_id='" . $_SESSION["erno"] . "'";
                }

                  if ($con->query($queryupdate) == TRUE) {
                      echo "<script>alert('Data Updated successfully.');</script>";
                  }

                  echo "<script>var formno = ".(explode("-", $_SESSION["erno"])[3]).";";
                  echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                  echo "if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                  echo "if(formno >= 100 & formno <= 999){ formno = formno; }";
                  echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                  echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                  echo "document.getElementById('state').value = state;";
                  echo "document.getElementById('uno').value = formno;";
                  echo "var year = ".(explode("-", $_SESSION["erno"])[0]).";";
                  echo "document.getElementById('erid').value = year;";
                  echo "var data = 'Enrollment Form Number Is : ".$_SESSION["erno"]."';";
                  echo "document.getElementById('idnext').innerHTML = data;";
                  echo "document.getElementById('btnentercadets').click();</script>";
              }

              if (isset($_POST["btnnext"])) {
                echo "<script>" . "$('#campyear').css('visibility', 'visible');" . "</script>";
                $t_year = 0;
                $otc = 0;
                $sql = "select * from enroll_master where enrollment_id = '".$_SESSION["erno"]."'";
                $rs = $con->query($sql);
                while ($row = $rs->fetch_assoc()) {
                  $t_year = $row["t_year"] + 1;
                  $otc = $row["otc"];
                }

                if($t_year <= 5 || ($otc == 0 || $otc == 1))
                {
                  if($t_year >= 5)
                  {
                    $t_year = 5;
                  }
                  $query            = "select * from enroll_master where enrollment_id = '" . $_SESSION["erno"] . "'";
                    $rs               = $con->query($query);
                    if ($row = $rs->fetch_assoc()) {
                      if($row["t_year"] == 1)
                      {
                        echo "<script>";
                        echo "$('#rdNULL').attr('disabled', false);";
                        echo "$('#rdATC').attr('disabled', true);";
                        echo "$('#rdSTC').attr('disabled', true);";
                        echo "$('#rdOTC').attr('disabled', true);";
                        echo "$('#checkATC').attr('disabled', true);";
                        echo "$('#checkSTC').attr('disabled', true);";
                        echo "</script>";
                      }
                      if($row["t_year"] == 2)
                      {
                        echo "<script>";
                        echo "$('#rdNULL').attr('disabled', true);";
                        echo "$('#rdATC').attr('disabled', false);";
                        echo "$('#rdATC').prop('checked', true);";
                        echo "$('#rdSTC').attr('disabled', true);";
                        echo "$('#rdOTC').attr('disabled', true);";
                        echo "$('#checkATC').attr('disabled', true);";
                        echo "$('#checkSTC').attr('disabled', true);";
                        echo "</script>";
                      }
                      if($row["t_year"] == 3)
                      {
                        echo "<script>";
                        echo "$('#rdNULL').attr('disabled', true);";
                        echo "$('#rdATC').attr('disabled', false);";
                        echo "$('#rdATC').prop('checked', true);";
                        echo "$('#rdSTC').attr('disabled', true);";
                        echo "$('#rdOTC').attr('disabled', true);";
                        echo "$('#checkATC').attr('disabled', false);";
                        echo "$('#checkSTC').attr('disabled', true);";
                        echo "</script>";
                      }
                      if($row["t_year"] == 4)
                      {
                        echo "<script>";
                        echo "$('#rdNULL').attr('disabled', true);";
                        echo "$('#rdATC').attr('disabled', false);";
                        echo "$('#rdATC').prop('checked', true);";
                        echo "$('#rdSTC').attr('disabled', true);";
                        echo "$('#rdOTC').attr('disabled', true);";
                        echo "$('#checkATC').attr('disabled', false);";
                        echo "$('#checkSTC').attr('disabled', false);";
                        echo "</script>";
                      }
                      if($row["t_year"] == 5)
                      {
                        echo "<script>";
                        echo "$('#rdNULL').attr('disabled', true);";
                        echo "$('#rdATC').attr('disabled', false);";
                        echo "$('#rdATC').prop('checked', true);";
                        echo "$('#rdSTC').attr('disabled', true);";
                        echo "$('#rdOTC').attr('disabled', true);";
                        echo "$('#checkATC').attr('disabled', false);";
                        echo "$('#checkSTC').attr('disabled', false);";
                        echo "</script>";
                      }


                        echo "<script>" . "$('#firstname').val('" . $row["first_name"] . "');" . "$('#middlename').val('" . $row["middle_name"] . "');" . "$('#lastname').val('" . $row["last_name"] . "');"  . "$('#std').val('" . $row["std"] . "');" . "$('#cdt_form_no').val('" . $row["form_no"] . "');" . "$('#cdt_add').val('" . $row["address"] . "');" . "$('#cdt_city').val('" . $row["city"] . "');" . "$('#cdt_mo1').val('" . $row["mobile1"] . "');" . "$('#cdt_mo2').val('" . $row["mobile2"] . "');" . "$('#cdt_bgroup').val('" . $row["blood_group"] . "');" . "$('#cdt_gender').val('" . $row["gender"] . "');" . "$('#cdt_dob').val('" . $row["birthdate"] . "');" . "$('#cdt_aadhar').val('" . $row["aadharcard_no"] . "');" . "$('#btnnext').text('Add To Next Year').attr('name','btnprmote').attr('id','btnprmote').removeAttr('style');
                          $('#newcadet').hide();$('#oldcadet').hide();" . "</script>";

                           echo "<script>" . "$('#firstname').attr('readonly',true).val('" . $row["first_name"] . "');" . "$('#middlename').attr('readonly',true).val('" . $row["middle_name"] . "');" . "$('#lastname').attr('readonly',true).val('" . $row["last_name"] . "');" . "$('#std').attr('readonly',false).val('" . $row["std"] . "');" . "$('#cdt_form_no').attr('readonly',false).val('');" . "$('#cdt_add').attr('readonly',true).val('" . $row["address"] . "');" . "$('#cdt_city').attr('readonly',true).val('" . $row["city"] . "');" . "$('#cdt_mo1').attr('readonly',false).val('" . $row["mobile1"] . "');" . "$('#cdt_mo2').attr('readonly',false).val('" . $row["mobile2"] . "');" . "$('#cdt_bgroup').attr('readonly',true).val('" . $row["blood_group"] . "');" . "$('#cdt_gender').attr('readonly',true).val('" . $row["gender"] . "');" . "$('#cdt_dob').attr('readonly',true).val('" . $row["birthdate"] . "');" . "$('#cdt_aadhar').attr('readonly',true).val('" . $row["aadharcard_no"] . "');
                           $('#t_year').attr('readonly',true).val('" . $row["t_year"] . "');
                            $('#stc').attr('readonly',true).val('" . $row["stc"] . "');
                            $('#otc').attr('readonly',true).val('" . $row["otc"] . "');
                            $('#atc').attr('readonly',true).val('" . $row["atc"] . "');
                           
                              $('#newcadet').hide();$('#oldcadet').hide();$('#btnnext').show();" . "</script>";
                    }
                    echo "<script>" . "$('#erno_form').css('visibility','visible');" . "</script>";
                }
                else
                {
                  echo "<script>alert('Cadet All Camp Are Finish.');</script>";
                  echo "<script>" . "$('#campyear').css('visibility', 'hidden');" . "</script>";
                }

                echo "<script>var formno = ".(explode("-", $_SESSION["erno"])[3]).";";
                echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                echo "if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                echo "if(formno >= 100 & formno <= 999){ formno = formno; }";
                echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                echo "document.getElementById('state').value = state;";
                echo "document.getElementById('uno').value = formno;";
                echo "var year = ".(explode("-", $_SESSION["erno"])[0]).";";
                echo "document.getElementById('erid').value = year;";
                echo "var data = 'Enrollment Form Number Is : ".$_SESSION["erno"]."';";
                echo "document.getElementById('idnext').innerHTML = data;</script>";
              }


              if(isset($_POST["btnprmote"]))
              {
                echo "<script>" . "$('#campyear').css('visibility', 'visible');" . "</script>";
                $mo1 = "";
                $mo2 = "";
                $std = "";
                $t_year = 0;
                $otc = 0;
                $sql = "select * from enroll_master where enrollment_id = '".$_SESSION["erno"]."'";
                $rs = $con->query($sql);
                while ($row = $rs->fetch_assoc()) {
                  $t_year = $row["t_year"] + 1;
                  $otc = $row["otc"];
                }

                if($t_year <= 5 || ($otc == 0 || $otc == 1))
                {
                  if($t_year >= 5)
                  {
                    $t_year = 5;
                  }
                    $std = $_POST["cdt_std"];
                    $mo1 = $_POST["cdt_mo1"];
                    $mo2 = $_POST["cdt_mo2"];
                    $data = $_POST["cdt_form_no"];

                    $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."' where enrollment_id = '".$_SESSION["erno"]."'";
                      
                      if($t_year == 1)
                      {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc = 0,stc=0,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                      }
                      if($t_year == 2)
                      {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc = 1,stc=0,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                      }
                      if($t_year == 3)
                      {
                        if($_POST["rdcampyear"] == "ATC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc = 1,stc=0,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                        if($_POST["rdcampyear"] == "STC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc=0,stc=1,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                      }
                      else if($t_year == 4)
                      {
                        if($_POST["rdcampyear"] == "ATC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc = 1,stc=0,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                        if($_POST["rdcampyear"] == "STC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc=0,stc=1,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                        if($_POST["rdcampyear"] == "OTC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc=0,stc=0,otc=1 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                      }
                      else if($t_year == 5)
                      {
                        if($_POST["rdcampyear"] == "ATC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc = 1,stc=0,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                        if($_POST["rdcampyear"] == "STC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc=0,stc=1,otc=0 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                        if($_POST["rdcampyear"] == "OTC")
                        {
                          $sql = "update enroll_master set form_no = ". $data .",std = '".$std."',mobile1 = '".$mo1."',mobile2 = '".$mo2."',c_year = ".date("Y").", t_year = '".$t_year."',atc=0,stc=0,otc=1 where enrollment_id = '".$_SESSION["erno"]."'";
                        }
                      }
                  if($con->query($sql) == TRUE)
                  {
                    $sql23 = "select * from year_master Order By year_code DESC limit 1";
                    $resss = $con->query($sql23);
                    $_SESSION["Send"] = 1;
                    if($mo1 == NULL)
                    {
                      $sqlllll = "select * from school_master where troop_code = ".explode("-", $_SESSION["erno"])[1];
                      $res = $con->query($sqlllll);
                      while ($row = $res->fetch_assoc()) {
                        $mo1 = $row["incharge_no"];
                      }
                    }
                    if($mo1 != "" || $mo2 != "")
                    {
                      $_SESSION["Send"] = 1;
                      $_SESSION["mobile_no"] = $mo1;
                      $_SESSION["msg"] = "Your child ".strtoupper($name)." is enrolled in AAN (Alumni Association of NCC Cadets) for the training year ".$resss->fetch_assoc()["year_range"];
                      $_SESSION["msg1"] = "Enrollemnt number is ".$_SESSION["erno"]." in year of training ".$t_year." on basis of his application form ".$data." of AAN.";
                    }
                    echo "<script>alert('Cadet Was Enter In Next Year.');</script>";
                  }
                }
                else
                {
                  echo "<script>alert('Cadet All Camp Are Finish.');</script>";
                  echo "<script>" . "$('#campyear').css('visibility', 'hidden');" . "</script>";
                }

                echo "<script>var formno = ".(explode("-", $_SESSION["erno"])[3] + 1).";";
                echo "if(formno > 0 & formno <= 9){ formno = '00' + formno; }";
                echo "if(formno >= 10 & formno <= 99){ formno = '0' + formno; }";
                echo "if(formno >= 100 & formno <= 999){ formno = formno; }";
                echo "document.getElementById('troop_code').value = '".(explode("-", $_SESSION["erno"])[1])."';";
                echo "var state = '".(explode("-", $_SESSION["erno"])[2])."';";
                echo "document.getElementById('state').value = state;";
                echo "document.getElementById('uno').value = formno;";
                echo "var year = ".(explode("-", $_SESSION["erno"])[0]).";";
                echo "document.getElementById('erid').value = year;";
                echo "document.getElementById('btnentercadets').click();</script>";
              }
              ?>
        </div>
     </div>
  </div>
<?php
  include '../footer.php';
?>