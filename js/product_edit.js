$(document).ready(function(){	
	$("select.opt_nm").change(function(){
	   var inp_tp=$(this).children(":selected").data('type');
	   var inp_val=$(this).val();
	   //show(inp_tp);
	   //show(inp_val);
	   if(inp_tp==1)
		   $.get(base_url+'product_edit/valuesattrajax/'+inp_val,{},function(r){	
		   		show(r);   	
		   		$.each(r,function (i,v) {
					show(i);
					show(v);	 
				});
		   	
				//echo "<option value='$id' $selected >{$v['val']}</option>";
									
									
									
				$(this).closest("tr").children(":last").empty().append(": <select size='1' name='attr_val[1]["+inp_val+"]'>"+"</select>"); 
		   },'json');
		else{
			$(this).closest("tr").children(":last").empty().append(': ',$('<input/>',{type:"text", name:"attr_val[0]["+inp_val+"]"}));	 
		}
	});
});