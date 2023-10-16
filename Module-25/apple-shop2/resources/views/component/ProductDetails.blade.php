<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img1" class="w-100" src='assets/images/product_img1.jpg' />
                    </div>
                    <div class="row p-2">
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img1" src="assets/images/product_small_img3.jpg"/>
                        </a>
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img2" src="assets/images/product_small_img3.jpg"/>
                        </a>
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img3" src="assets/images/product_small_img3.jpg" alt="product_small_img3" />
                        </a>
                        <a href="#" class="col-3 product_img_box p-1">
                            <img id="img4" src="assets/images/product_small_img3.jpg" alt="product_small_img3" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 id="p_title" class="product_title"></h4>
                        <h1 id="p_price"  class="price"></h1>
                    </div>
                    <div>
                        <p id="p_des"></p>
                    </div>
                    </div>


                    <label class="form-label">Size</label>
                    <select id="p_size" class="form-select">
                    </select>

                    <label class="form-label">Color</label>
                    <select id="p_color" class="form-select">

                    </select>

                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input id="p_qty" type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button onclick="AddToCart()" class="btn btn-fill-out btn-addtocart" type="button"><i class="icon-basket-loaded"></i> Add to cart</button>
                            <a class="add_wishlist" onclick="AddToWishList()" href="#"><i class="icon-heart"></i></a>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
</div>




<script>


    $('.plus').on('click', function() {
        if ($(this).prev().val()) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.minus').on('click', function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

    let searchParams = new URLSearchParams(window.location.search);
    let id = searchParams.get('id');


    async function productDetails() {
        let res = await axios.get("/ProductDetailsById/"+id);
        let Details=await res.data['data'];

        document.getElementById('product_img1').src=Details[0]['img1'];
        document.getElementById('img1').src=Details[0]['img1'];
        document.getElementById('img2').src=Details[0]['img2'];
        document.getElementById('img3').src=Details[0]['img3'];
        document.getElementById('img4').src=Details[0]['img4'];

        document.getElementById('p_title').innerText=Details[0]['product']['title'];
        document.getElementById('p_price').innerText=`$ ${Details[0]['product']['price']}`;
        document.getElementById('p_des').innerText=Details[0]['product']['short_des'];
        document.getElementById('p_details').innerHTML=Details[0]['des'];

        // Product Size & Color
        let size= Details[0]['size'].split(',');
        let color=Details[0]['color'].split(',');

        let SizeOption=`<option value=''>Choose Size</option>`;
        $("#p_size").append(SizeOption);
        size.forEach((item)=>{
            let option=`<option value='${item}'>${item}</option>`;
            $("#p_size").append(option);
        })


        let ColorOption=`<option value=''>Choose Color</option>`;
        $("#p_color").append(ColorOption);
        color.forEach((item)=>{
            let option=`<option value='${item}'>${item}</option>`;
            $("#p_color").append(option);
        })

        $('#img1').on('click', function() {
            $('#product_img1').attr('src', Details[0]['img1']);
        });
        $('#img2').on('click', function() {
            $('#product_img1').attr('src', Details[0]['img2']);
        });
        $('#img3').on('click', function() {
            $('#product_img1').attr('src', Details[0]['img3']);
        });
        $('#img4').on('click', function() {
            $('#product_img1').attr('src', Details[0]['img4']);
        });
    }



    async function productReview(){
        let res = await axios.get("/ListReviewByProduct/"+id);
        let Details=await res.data['data'];

        $("#reviewList").empty();

        Details.forEach((item,i)=>{
            let each= `<li class="list-group-item">
                <h6>${item['profile']['cus_name']}</h6>
                <p class="m-0 p-0">${item['description']}</p>
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width:${parseFloat(item['rating'])}%"></div>
                    </div>
                </div>
            </li>`;
           $("#reviewList").append(each);
        })
    }

    async function AddToCart() {
        try {
            let p_size=document.getElementById('p_size').value;
            let p_color=document.getElementById('p_color').value;
            let p_qty=document.getElementById('p_qty').value;

            if(p_size.length===0){
                alert("Product Size Required !");
            }
            else if(p_color.length===0){
                alert("Product Color Required !");
            }
            else if(p_qty===0){
                alert("Product Qty Required !");
            }
            else {
                $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
                let res = await axios.post("/CreateCartList",{
                    "product_id":id,
                    "color":p_color,
                    "size":p_size,
                    "qty":p_qty
                });
                $(".preloader").delay(90).fadeOut(100).addClass('loaded');
                if(res.status===200){
                    alert("Request Successful")
                }
            }

        } catch (e) {
            if (e.response.status === 401) {
                sessionStorage.setItem("last_location",window.location.href)
                window.location.href = "/login"
            }
        }
    }


    async function AddToWishList() {
        try{
            $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
            let res = await axios.get("/CreateWishList/"+id);
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            if(res.status===200){
                alert("Request Successful")
            }
        }catch (e) {
            if(e.response.status===401){
                sessionStorage.setItem("last_location",window.location.href)
                window.location.href="/login"
            }
        }
    }


    async function AddReview(){
        let reviewText=document.getElementById('reviewTextID').value;
        let reviewScore=document.getElementById('reviewScore').value;
        if(reviewScore.length===0){
            alert("Score Required !")
        }
        else if(reviewText.length===0){
            alert("Review Required !")
        }
        else{
            $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
            let postBody={description:reviewText, rating:reviewScore, product_id:id}
            let res=await axios.post("/CreateProductReview",postBody);
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            await  productReview();
        }


    }




</script>
