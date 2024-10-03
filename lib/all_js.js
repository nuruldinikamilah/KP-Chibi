// prepare the form when the DOM is ready 
$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#jsonForm').ajaxForm({ 
        // dataType identifies the expected content type of the server response 
        dataType:  'json', 
 
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson 
    }); 
});


function processJson(response) { 
    // 'data' is the json object returned from the server 
    alert(response.status); 
	//jika berhasil
			if(response.status == 1)
			{
			  $('#divResult_sub').text('Data berhasil ditambah').css({'color':'#000000','background-color':'#FFFF00'}).fadeIn();
			  tb_remove();
			  $.growlUI('Pesan', '<b>Data FOTO <br><font color="red">'+response.nama+'</font><br>Berhasil Ditambahkan</b>');
			  
			 //refresh image 
	   		 $("#mydiv").html('<img id=foto_calon_siswa src="foto_upload/'+response.nama+'?time'+new Date().getTime()+'">');
			  
			  
			}
			//end jika berhasil
			
			//jika error
			else if(response.status == 2)
			{
			  $("#waiting_sub").hide();	
			  $('#divResult_sub').text(response.text).css({'color':'#FFFFFF','background-color':'#FF0000'}).fadeIn();
			}
			//end jika error
			
			//jika error
			else if(response.status == 3)
			{
			  $("#waiting_sub").hide();	
			  $('#divResult_sub').text(response.text).css({'color':'#FFFFFF','background-color':'#FF0000'}).fadeIn();
			}
			//end jika error
}















