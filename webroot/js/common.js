$(document).ready(function() {
    $('#fund_categ').change(function() {
        var value = $(this).val();
        //alert(value);
        //return false;


        if (value != "")
        {
            $.ajax({
                type: 'GET',
                url: 'subcategory',
                data: 'value='+value,
                contentType: 'json',
                success: function(data)
                {
                    
                     // alert(data);
                       var  data = JSON.parse(data);
                      

                    if ($.isEmptyObject(data))
                    {

                        $('#sub_categ').empty();


                    }
                    else
                    {
                       
                        $('#sub_categ').empty();
                        
                     $.each(data,function(key,value){
				
                                   
                                    
				var Option ="<option value='"+value.id+"'>"+value.type_of_fund+" </option>";
					
                                             
					
                                 
                                           
				//alert(Option);
                                       // var value1 = $('#sub_categ').val();
                                        ///lert(value1+'sub_categ');
                                        
                                      
                              $('#sub_categ').append(Option);
                             //alert($('#sub_categ').val('h'));  
					//alert('sub_categ='+s.val());
					});
                                        
                   


                    }
                }, error: function(error) {
                  // alert(JSON.stringify(error));
                }


            });
        }
        else
        {
            $('#sub_categ').empty();
            $('#sub_categ').append("<option value=''>--Select--</option>");
            //alert(value);
        }

    });

});
	