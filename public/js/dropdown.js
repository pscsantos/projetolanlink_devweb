//Carrega Fucnionários

$(document).ready(function(){

	$("#department").change(function(event){
		$.get("employees/"+event.target.value+"",function(response, department){
    	 	console.log(response);    
    	 	$('#employee').empty();	 	
    	 	for(i=0;i<response.length; i++){
                //alert("OLá");
    	 		//console.log(response[i].id);
                $("#employee").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
    	 	}    	 	
        });
	});

});