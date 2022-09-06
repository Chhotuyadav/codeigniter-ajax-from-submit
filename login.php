<form class="form-horizontal admin-login" >
  <fieldset class="form-group floating-label-form-group">
    <label for="user_email">Your Username</label>
    <input type="text" name="user-email" class="form-control" id="user_email" placeholder="Your Username">
  </fieldset>
  <fieldset class="form-group floating-label-form-group mb-1">
    <label for="user_password">Enter Password</label>
    <input type="password" name="user-pass" class="form-control" id="user_password" placeholder="Enter Password">
  </fieldset>
  <button type="submit" class="btn btn-outline-info btn-block">
    <i class="ft-unlock"></i> Login </button>
</form>


<script>
         /*  admin-login start*/
         $('body').on('submit','.admin-login',function(e){
              e.preventDefault();
                 var email       =   $('#user_email');
                 var pass        =   $('#user_password');

                //  email           =   _emailReg(email,"Invalid Email Address");
                //  pass            =   _blankReg(pass,"Enter Password");

                 if(email.val() != '' && pass != ''){
                    //  alert('ok');
                      var formdata    =   new FormData(this);
                      $.ajax({
                                url: '<?= site_url('admin-login')?>',
                                data: formdata,
                                type : 'POST',
                                async: false,
                                contentType : false,
                                processData : false,
                                success:function(res){
                                  var resObj  =  $.parseJSON(res);
                                  if (resObj.status){ 
                                    // showMsg('success',resObj.msg);
                                  $('.admin-login').trigger('reset');
                                  window.location.href = "<?= base_url('dashboard')?>";
                                  }else{
                                    alert(resObj.msg);
                                  }
                                                      


                                }
                      })
                 }
          });

         $('body').on('keyup','.email',function(e){
             if(e.KeyCode != 13){
                 $('.err-username').text("");
             }
         });

    </script>



public function login_user(){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$result = $this->Admin_model->login_user($email,$password);
			if ($result==true) {
	         $dataToReturn['status'] = true;
	        $dataToReturn['msg'] = ' Add successfully ';
	        }else{
	          $dataToReturn['status'] = false;
	          $dataToReturn['msg'] = 'something went wrong';
	        }
	        echo  json_encode($dataToReturn);
	}
