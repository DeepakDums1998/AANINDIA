<?php
include '../connection.php';
include '../header.php';
include '../sendmsg.php';
ob_start();
if(isset($_GET['gid']))
{
$sql="SELECT * FROM tbl_guidelines where g_id=".$_GET['gid']." ";


//echo $con->query($sql)->fetch_assoc()["Guidelines"];


?>
<script src="../Resources/js/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/cc6jviaafuf1u9xp4rzd86otv36kqqxneq7cwy7pw3r4lq8s/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b>
        <h4 class="page-header">GUIDELINES</h4>
        </b>
        <div class="form-group">
          
          <div class="row">
            <div class="col-lg-12">
              
              <div class="panel panel-default">
                <div style="color: red;" class="panel-heading">
                  <b>UPDATE GUIDELINE</b>
                </div>
                <form role="form" method="Post" enctype="multipart/form-data">
                  <div class="panel-body">
                    <div class="row">
                      <div class="form-group">
                        
                        <div class="col-lg-12">
                        <div class="col-lg-6">
                           <label class="form-check-label" for="Year_5"  >ENTER TITLE:</label>
                       
                        <input type="text" name="txttitle" class="form-control" style="text-transform:uppercase;" on keyup="javascript:this.value=this.value.toUpperCase();" required>
                      
                      
                        </div>
                        </br>
                         <div class="col-lg-10">
                           <label class="form-check-label" for="Year_5"  >ENTER GUIDELINE:</label>
                        <textarea name="guideline">
                        <?php
                        echo $con->query($sql)->fetch_assoc()["Guidelines"];
                        ?>
                        </textarea>
                        <script>
                        tinymce.init({
                        selector: 'textarea',
                        branding: false,
                        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                        imagetools_cors_hosts: ['picsum.photos'],
                        menubar: 'file edit view insert format tools table help',
                        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                        toolbar_sticky: true,
                        autosave_ask_before_unload: true,
                        autosave_interval: "30s",
                        autosave_prefix: "{path}{query}-{id}-",
                        autosave_restore_when_empty: false,
                        autosave_retention: "2m",
                        image_advtab: true,
                        content_css: '//www.tiny.cloud/css/codepen.min.css',
                        link_list: [
                        { title: 'My page 1', value: 'http://www.tinymce.com' },
                        { title: 'My page 2', value: 'http://www.moxiecode.com' }
                        ],
                        image_list: [
                        { title: 'My page 1', value: 'http://www.tinymce.com' },
                        { title: 'My page 2', value: 'http://www.moxiecode.com' }
                        ],
                        image_class_list: [
                        { title: 'None', value: '' },
                        { title: 'Some class', value: 'class-name' }
                        ],
                        importcss_append: true,
                        file_picker_callback: function (callback, value, meta) {
                        /* Provide file and text for the link dialog */
                        if (meta.filetype === 'file') {
                        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                        }
                        /* Provide image and alt text for the image dialog */
                        if (meta.filetype === 'image') {
                        callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                        }
                        /* Provide alternative source and posted for the media dialog */
                        if (meta.filetype === 'media') {
                        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                        }
                        },
                        templates: [
                        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                        ],
                        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                        height: 600,
                        image_caption: true,
                        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                        noneditable_noneditable_class: "mceNonEditable",
                        toolbar_mode: 'sliding',
                        contextmenu: "link image imagetools table",
                        });
                        </script>
                      </div>
                     
                        <div class="col-lg-6">
                          <button type="submit" name="btnupdate" class="btn btn-success">UPDATE GUIDELINE</button>
                        </div>
                      </div>
                     
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
  
  
  <?php
  if(isset($_POST['btnupdate']))
  {
  
  $sql = "UPDATE tbl_guidelines SET A_id='".$_SESSION["ADMIN"]."', TITLE = '{$_POST['txttitle']}',Guidelines='".$_POST['guideline']."' where g_id=".$_GET['gid']."";
  
  
  if($con->query($sql) == TRUE)
  {
    echo "<script>window.location.href='Guidelines.php';</script>";
    
  }
  else
  {
  echo "<script>alert('not updated');</script>";
  }
  
  
  }
  include '../footer.php';
  
  
  }
  ?>