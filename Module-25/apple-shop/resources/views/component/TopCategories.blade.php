<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Top Categories</h2>
                </div>
                <p class="text-center leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius.</p>
            </div>
        </div>
        <div id="TopCategoryItem" class="row align-items-center">


        </div>
    </div>
</div>


<script>

    async function TopCategory(){
        let res=await axios.get("/CategoryList");
        $("#TopCategoryItem").empty()
        res.data['data'].forEach((item,i)=>{
            let EachItem= `<div class="p-2 col-2">
                <div class="item">
                    <div class="categories_box">
                        <a href="/by-category?id=${item['id']}">
                            <img src="${item['categoryImg']}" alt="cat_img1"/>
                            <span>${item['categoryName']}</span>
                        </a>
                    </div>
                </div>
            </div>`
            $("#TopCategoryItem").append(EachItem);
        })
    }
</script>

