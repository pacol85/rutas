var counter = 0;
var totals=[0,0,0,0,0];
$(document).ready(function() {
	$(this).find('.number').each(function(){
		if($(this).val() != null){
			totals[counter]+=parseInt( $(this).html());
		}       	
       	counter++;
       	if(counter == 5){
       		counter = 0;
       	}
    });
	$("#tefectivo").each(function(){  
    	$(this).html(totals[2]);
    });
    $("#tcheque").each(function(){  
    	$(this).html(totals[3]);
    });
    $("#tglobal").each(function(){  
    	$(this).html(totals[2]+ totals[3]);
    });
});