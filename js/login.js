$(document).ready(function(){	
	/*Trigger custom checkbox*/
	$(".w_check").on("click",function(){
		$(this).toggleClass("checked");
		//$("input[name='remember']").val($(this).hasClass("checked")?1:'');
	});		
	//   login 
	$('#login_form').validate({
	  rules: {	    
	    login: {
	      required: true,
	      email: true
	    },	    
	    password: {
	      minlength: 6,
	      required: true
	    }
	  },
	  submitHandler: function () {
            login_on_server();
     },
	 errorElement: "div"
	  
	
	 /*showErrors: function( errors ) {
			if ( errors ) {
				// add items to error list and map
				$.extend( this.errorMap, errors );
				this.errorList = [];
				for ( var name in errors ) {
					this.errorList.push({
						message: errors[name],
						element: this.findByName(name)[0]
					});
				}
				// remove items from success list
				this.successList = $.grep( this.successList, function( element ) {
					return !(element.name in errors);
				});
			}
			if ( this.settings.showErrors ) {
				this.settings.showErrors.call( this, this.errorMap, this.errorList );
			} else {
				this.defaultShowErrors();
			}
	 }*/
	 /*
     showErrors: function(errorMap, errorList) {
        var i, length = errorList.length;
        var el;
		show('в');
		for(input_nm in errorMap) {
			//console.log(prop);
			console.log(errorMap[input_nm]);
			$("input[name='"+input_nm+"']").parent().addClass('error');
			$("input[name='"+input_nm+"']").parent().prepend("<div class='err_msg'>"+errorMap[input_nm]+"</a>");
		}
		//show(this.successList);
		
		
		/*
        for (i = 0; i < length; i++) {
			el = errorList[i].element;
            //console.log(typeof  el);
			console.log(errorList[i]);
			console.log(errorMap);
			
			
			
			/*$(el.id).tooltip({
				content:"Не правильный логин или пароль!",					
    			position:{
    				at:"right bottom",
                   	my:"right bottom"  
                   }              	
                }).tooltip('open');
                setTimeout(function(){ $("#f_title").tooltip('disable').attr('title',''); }, 2490);  
			*/
            //el.
            //$("#" + el.id + "-bg").show() // <-- write code against this selector
        //}
    //}
	});	
	
	
	/*
	$("body").on('change','input',function(){
		if($(this).haseClass('error')){
			$(this).parent().removeClass('error');
			//alert(1);
		}
    });
	*/
	
	function login_on_server()
	{	
		lg =$("input[name='login']").val();
		psw=$("input[name='password']").val();
		rmb=$(".w_check").hasClass("checked")?1:'';
		$.post( 
			base_url+"welcome/enter_form",
			{
    			login: lg,
    			password: psw,
    			remember: rmb,
    			authorization: 1
  			},
  			onAjaxSuccess
		);
		
		
		function onAjaxSuccess(resp)
		{
			if(resp) {
				location.reload();				
			}else{
				$("#f_title").tooltip({
				content:"Не правильный логин или пароль!",					
    			position:{
    				at:"right bottom",
                   	my:"right bottom"  
                   }              	
                }).tooltip('open');
                setTimeout(function(){ $("#f_title").tooltip('disable').attr('title',''); }, 2490);  
            }
		}
	}
	
	
});