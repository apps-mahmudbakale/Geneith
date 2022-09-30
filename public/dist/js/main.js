$(document).ready(()=>{
	//Add User Blocks
	$('#addUser').click(()=>{
		//Variable Initialization

		var fullname = $('#fullname').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var phone = $('#phone').val();
		var role_id = $('#role_id').val();

		$.ajax({
			type: 'POST',
			url: '../Ajax/ajax.users.php',
			data:{fullname:fullname,username:username,password:password, phone:phone,role_id:role_id},
			cache: false,
			success: ((html)=>{
				$('#status').html(html);

				// console.log(html);
				// alert(role_id);
			})
		});
	});



	//Add User Blocks
	$('#changepass').click(()=>{
		//Variable Initialization

		var opassword = $('#opassword').val();
		var npassword = $('#npassword').val();
		var cpassword = $('#cpassword').val();
		var user_id = $('#user_id').val();

		$.ajax({
			type: 'POST',
			url: '../Ajax/ajax.changepass.php',
			data:{user_id:user_id,opassword:opassword,npassword:npassword,cpassword:cpassword},
			cache: false,
			success: ((html)=>{
				$('#status').html(html);

				// console.log(html);
				// alert(role_id);
			})
		});
	});


//Update User Blcock


$('#editUser').click(()=>{
	//Variable Initialization

	var user_id = $('#user_id').val();
	var fullname = $('#fullname').val();
	var username = $('#username').val();
	var phone = $('#phone').val();
	var role_id = $('#role_id').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/ajax.edit.users.php',
		data:{fullname:fullname,username:username,user_id:user_id, phone:phone,role_id:role_id},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);
		})
	});

	//alert('Worked');

	});	


//Add Item Blocks
$('#addItem').click(()=>{
	//Variable Initialization

	var item_name = $('#item_name').val();
	var reg_price = $('#reg_price').val();
	var hand_qty = $('#hand_qty').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/ajax.items.php',
		data:{item_name:item_name,reg_price:reg_price,hand_qty:hand_qty},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#addexpense').click(()=>{
	//Variable Initialization

	var reason = $('#reason').val();
	var amount = $('#amount').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/ajax.expense.php',
		data:{reason:reason,amount:amount},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editItem').click(()=>{
	//Variable Initialization

	var item_id = $('#item_id').val();
	var item_name = $('#item_name').val();
	var reg_price = $('#reg_price').val();
	var hand_qty = $('#hand_qty').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/ajax.edit.items.php',
		data:{item_name:item_name,reg_price:reg_price,item_id:item_id, hand_qty:hand_qty},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);
		})
	});

	//alert('Worked');

	});	



});


$(()=>{
	$('#search_keyword').keyup(()=>{
		

		var search_keyword_value = $('#search_keyword').val();
		//alert(search_keyword_value);
		var dataString = 'search_keyword='+ search_keyword_value;

		if(search_keyword_value!='')
		{
		    $.ajax({
		        type: "POST",
		        url: "../Ajax/ajax.search.php",
		        data: dataString,
		        cache: false,
		        success: ((html)=>{
		        		$('#result').html(html).show();
		        	  // console.log(html);
		        	})
		        
		          
		        
		    });
		}
		return false;
	})
})

$(()=>{
	$('#csearch_keyword').keyup(()=>{
		

		var search_keyword_value = $('#csearch_keyword').val();
		//alert(search_keyword_value);
		var dataString = 'search_keyword='+ search_keyword_value;

		if(search_keyword_value!='')
		{
		    $.ajax({
		        type: "POST",
		        url: "../Ajax/ajax.csearch.php",
		        data: dataString,
		        cache: false,
		        success: ((html)=>{
		        		$('#result').html(html).show();
		        	  // console.log(html);
		        	})
		        
		          
		        
		    });
		}
		return false;
	})
})