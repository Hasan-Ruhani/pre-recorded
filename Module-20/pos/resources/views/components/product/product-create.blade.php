<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="productName">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPrice">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="productUnit">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">


                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    FillCategoryDropDown();

    async function FillCategoryDropDown() {
        let res = await axios.get("/list-category");
        res.data.forEach(function(item, i){
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#productCategory").append(option);
        });
    }


    async function Save() {
        let productCategory = document.getElementById('productCategory').value;
        let productName = document.getElementById('productName').value;
        let productPrice = document.getElementById('productPrice').value;
        let productUnit = document.getElementById('productUnit').value;
        let productImg = document.getElementById('productImg').files[0];

        if(productCategory.length === 0){
            errorToast("Category Required");
        }

        else if(productName.length === 0){
            errorToast("Name Required");
        }

        else if(productPrice.length === 0){
            errorToast("Price Required");
        }

        else if(productUnit.length === 0){
            errorToast("Unit Required");
        }
        
        else if(!productImg){
            errorToast("Image Required");
        }


        else{
            
            document.getElementById('modal-close').click();

            let formData = new FormData();
            formData.append('img', productImg);
            formData.append('name', productName);
            formData.append('price', productPrice);
            formData.append('unit', productUnit);
            formData.append('category_id', productCategory);

            const config = {          // when transfer a file then its code must 
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/create-product", formData, config);
            hideLoader();

            if(res.status === 201){
                successToast('New Product Added');
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast("Request Fail !");
            }
        }
    }
</script>
