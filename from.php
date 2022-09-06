<form class="add-blog" enctype="multipart/form-data">
<div class="row">
    <div class="col-sm-6">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" placeholder="Enter Blog Title">
    </div>
    <div class="col-sm-6">
      <label class="form-label">Thumbnail</label>
      <input type="file" name="file" class="form-control">
      <input type="hidden" name="date" value="<?= date('d-m-y') ?>">

    </div>
    <div class="col-sm-12">
      <label class="form-label">Description</label>
      <textarea class="form-control" cols="12" rows="10" name="description" >Enter Blog Description</textarea>
    </div>
  </div>
  </div>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" name="save" class="btn btn-primary">Save changes</button>
</form>

<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<script>


  <!-- Data table  -->
  #data table script
  
  <!--Export Button -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  
  
  
  
    $('#example2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    
    
    <!-- Data table  -->
    
    
    #from data send to controller by the help of class
    
    $('body').on('submit','.add-blog',function(e){
      e.preventDefault()
        var formData = new FormData(this)

        var res = insertData("<?= base_url('add-blog')?>","POST",formData)

        if (res.status) {
          alert(res.msg)
          window.location.reload()
        }else{
          alert(res.msg)
          // $('#exampleModalCenter').modal('hide')
        }
          
    })
    
    #same update data

    $('body').on('submit','.add-blog-update',function(e){
      e.preventDefault()
        var formData = new FormData(this)

        var res = insertData("<?= base_url('update-blog')?>","POST",formData)

        if (res.status) {
          alert(res.msg)
          window.location.reload()
        }else{
          alert(res.msg)
          // $('#exampleModalCenter').modal('hide')
        }
          
    })
    
    All default function send update delete

    function insertData(url, method, data) {
        // alert('ok')
        // console.log(data)
        var dataToReturn = "";
        $.ajax({
            url: url,
            method: method,
            async: false,
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                var responseObj = $.parseJSON(response);
                dataToReturn = responseObj;
            }
        });
        return dataToReturn;
    }


</script>

# controller

public function add_blog(){

        if (isset($_FILES['file']['name'])) {
          if ($_FILES['file']['name'] != '') {
            $ImgVideoFiles = $_FILES['file']['name'];
            $target_dir = "images/blog/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
              
          }
        }

        $data = array(
          'title' => $this->input->post('title'),
          'description' => $this->input->post('description'),
          'date' => $this->input->post('date'),
          'file' => $ImgVideoFiles,
        );

        $result = $this->Admin_model->add_blog_m($data);
        if ($result==true) {
         $dataToReturn['status'] = true;
        $dataToReturn['msg'] = ' Add successfully ';
        }else{
          $dataToReturn['status'] = false;
          $dataToReturn['msg'] = 'something went wrong';
        }
        echo  json_encode($dataToReturn);

    }
