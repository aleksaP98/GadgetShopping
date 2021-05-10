$(document).ready(function(){
   
    //!REGISTER! 
    $("#forma").submit(function(e){
        e.preventDefault();
        provera();
    })
    //!REGISTER!

    //--PRODUCTS--

    $(document).on("click",".page",function(e){
        e.preventDefault();
        let filter =$("#filter").prop("value")
        let limit = $(this).data("limit");
        let value = $("#sortName").val();
        if(value == "")
            value = null;
        console.log(filter)
        if(filter > 0)
            paginationAJAX(limit,"models/products/filterCategory.php",filter,value)
        else
            paginationAJAX(limit,"models/products/filterCategory.php",null,value)
       
    })
    $(document).on("click",".prev",function(e){
        e.preventDefault()
        let limit = Number($(".page.active").data("limit")) - 1;
        let filter =$("#filter").prop("value")
        if(filter > 0)
            paginationAJAX(limit,"models/products/filterCategory.php",filter)
        else
            paginationAJAX(limit,"models/products/getProducts.php")
    })
    $(document).on("click",".next",function(e){
        e.preventDefault()
        let filter =$("#filter").prop("value")
        let limit = $(".page.active").data("limit") + 1;
        if(filter > 0)
            paginationAJAX(limit,"models/products/filterCategory.php",filter)
        else
            paginationAJAX(limit,"models/products/getProducts.php")
    })

    $("#filter").change(function(){
        let id = $(this).prop("value");
        let limit = 0
        paginationAJAX(limit,"models/products/filterCategory.php",id);
    })

    $("#sortPrice").change(function(){
        let value = $(this).prop("value");
        let products = $(".product");
            let productIds = []
            for(let product of products){
                    productIds.push(product.querySelector(".id").value)
            }
        $.ajax({
            url:"models/products/sortPrice.php",
            method:"post",
            type:"json",
            data:{value:value,ids:productIds},
            success : function(products){
                filterProducts(products)
            },
            error: showAJAXErrors
        })
    })

    $("#sortName").keyup(function(){
            let value = $(this).val()
            let productIds = $("#filter").prop("value");
            paginationAJAX(0,"models/products/filterName.php",productIds,value)
    })


    //--PRODUCTS--

    //!USERUPDATE!

    $("#editUsername").click(function(e){
        e.preventDefault()
        $("#formUsername").toggle();
    })
    $("#editPass").click(function(e){
        e.preventDefault()
        $("#formPass").toggle();
    })
    $("#editEmail").click(function(e){
        e.preventDefault()
        $("#formEmail").toggle();
    })
    $("#uploadImage").click(function(e){
        e.preventDefault()
        $("#formPicture").toggle()
    })
    
    //--USEREDIT--
    
    //--ADMIN PANEL--

    $(document).on("click",".update",function(e){
		e.preventDefault();
		$(".updateForma").css("display","inline-block")
         id = this.dataset.id;
         $("#idProduct").val(id)
         $('html, body').animate({
            scrollTop: $(".updateForma").offset().top
        }, 1000);
	})

	$(document).on("click",".updateU",function(e){
		e.preventDefault();
			$(".updateFormaU").css("display","inline-block")
             id = this.dataset.id;
             $("#idUser").val(id)
             $('html, body').animate({
                scrollTop: $(".updateFormaU").offset().top
            }, 1000);
			 
    })

    $(document).on("click",".delete",function(e){
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            url:"models/products/deleteProduct.php",
            method:"post",
            type:"json",
            data:{id:id},
            success:function(){
                refreshProductsTable();
            },
            error:showAJAXErrors
        })
    })
    
    $(document).on("click",".deleteU",function(e){
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            url:"models/user/deleteUser.php",
            method:"post",
            type:"json",
            data:{id:id},
            success:function(){
                refreshUsersTable();
            },
            error:showAJAXErrors
        })
    })
   
    // --ADMIN PANEL--    
})
function paginationAJAX(limit,url,id = null,value = null){
    $.ajax({
        url:url,
        method:"post",
        type:"json",
        data:{id:id,limit:limit,value:value},
        success : function(data){
            console.log(data);
            filterProducts(data.products)
            printPagination(data.pages,limit)
        },
        error: showAJAXErrors
    })
}

function filterProducts(products){
    let html = ``
    for(let product of products){
        html += `<li>
            <div class = product>
            <a href = "index.php?page=products&id=${product.id}"><img src = "${product.original}"/></a>
            <p class="name">${product.name}</p><hr>
            <p class ="price">$${product.price}</p>
            <input type = "hidden" value = "${product.id}" class = "id"/>
            <input type = "hidden" value = "${product.Category_ID}" class = "idC"/>
            <input type = "button" value = "Add to cart"/>
        </div>
    </li>`
    }
    $("#products").html(html);
}
function printPagination(numberOfProducts,active){
    
    let html = ``
    if(active > 0)
            html += `<button><a class = "prev" href = "#">PREVIOUS</a></button>`
    for(let i = 0;i<numberOfProducts;i++){
        if(i == active)
            html +=`<a href = "#" class = "page active" data-limit = "${i}">${i+1}</a>`
        else
            html +=`<a href = "#" class = "page" data-limit = "${i}">${i+1}</a>`
    }
    if(active != numberOfProducts-1)
            html += `<button><a class = "next" href = "#">NEXT</a></button>`
    $(".pages").html(html);
}

function refreshProductsTable(){
    $.ajax({
        url:"models/products/getProducts.php",
        method:"get",
        type:"json",
        success:function(products){
            fillProductsTable(products)
        },
        error:showAJAXErrors
    })  
}

function refreshUsersTable(){
    $.ajax({
        url:"models/user/getUsers.php",
        method:"get",
        type:"json",
        success:function(users){
            fillUsersTable(users)
        },
        error:showAJAXErrors
    })  
}

function fillProductsTable(products){
    let html = ``
    for(let product of products){
        html += `<tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.description}</td>
                <td>${product.price}</td>
                <td><img src = "${product.original}"/></td>
                <td>${product.Category_ID}</td>
                <td>
                    <button><a data-id = "${product.id}" class = "delete"  name = "deleteU" href = "" >DELETE PRODUCT</a></button>
                    <button><a data-id = "${product.id}" class = "update" name = "update" href = "#" >UPDATE PRODUCT</a></button>	
                </td>
            </tr>`
        }
        $("#products").html(html);

}

function fillUsersTable(users){
    let html = ``
                for(let user of users){
                html += `<tr>
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td><img src = "${user.profile}"/></td>
                <td>${user.name}</td>
                <td>
                    <button><a data-id = "${user.id}" class = "deleteU"  name = "deleteU" href = "" >DELETE USER</a></button>
                    <button><a data-id = "${user.id}" class = "updateU" name = "update" href = "#" >UPDATE USER</a></button>	
                </td>
            </tr>`
        }
            $("#users").html(html);

}

function showAJAXErrors(error, status, statusText){
    console.error('AJAX ERROR: ');
    console.log(status);
    console.log(statusText);
    if(error.status == 500){
        console.log(error.parseJSON);
    }
    else if(error.status == 400){
        alert('Parameters were not sent successfully')
    }
}

let postoji = false;
function provera()
    {
        
        let username = document.getElementById("usernameReg").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("passwordReg").value;
        let Cpassword = document.getElementById("Cpassword").value;
        
        let regUser = /^([A-z]\s*){2,15}/;
        let regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        let regPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/;

        let greske = [];
        
        let forma = document.getElementById("forma")

        if(!regUser.test(username))
				greske.push("Username must beggin with a letter,MIN 2,MAX 15 characters")
		if(!regPass.test(password))
				greske.push("Password must have at least 1 uppercase, 1 lovercase letter,1 number and 1 special character,MIN length 8,MAX 15")
		if(password != Cpassword)
				greske.push("password does not match")
		if(!regEmail.test(email))
				greske.push("Email is not in good format")
        if(greske.length){        
		    if(!postoji){
				$('<span id ="zagreske"></span>').appendTo(forma);
				let spanZaGreske = document.getElementById("zagreske")
				postoji = true;
				for(i in greske){
					
						spanZaGreske.innerHTML += greske[i] + "</br>";
				}
			}
			else{
				let spanZaGreske = document.getElementById("zagreske")
				spanZaGreske.innerHTML = "";
				for(i in greske){
						
						spanZaGreske.innerHTML += greske[i] + "</br>";
				}
            }
            return false;
		}
		else
		{
            $('#zagreske').remove();

            $.ajax({
                url : "models/login/register.php",
                method : "post",
                type : "json",
                data : {
                    username : username,
                    email : email,
                    password : password,
                    Cpassword : Cpassword
                },
                success : function(data){
                    
                    alert("Successfully registered!")
                    return true;

                },
                error : showAJAXErrors
            })   
		}
    }