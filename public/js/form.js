var totale=0;
var totalc=0;
$(document).ready(function() {
	$('*[id^="eb"]').change(function() {
		var sum = 0;
    	$('*[id^="eb"]').each(function() {
	        sum += Number($(this).val());
	    });
    	totale = sum;
    	$("#tefectivo").html(totale);
    	$("#tglobal").html(totale + totalc);
    });
    
    $('*[id^="c"]').change(function() {
    	var sum = 0;
    	$('*[id^="c"]').each(function() {
	        sum += Number($(this).val());
	    });
    	totalc = sum;
    	$("#tcheque").html(totalc);
    	$("#tglobal").html(totale + totalc);
	});
});