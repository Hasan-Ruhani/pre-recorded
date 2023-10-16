<div class="container-fluid">

    <div class="row">
        <div class="col-md-3 p-2">
            <label class="form-label">Customer Name</label>
            <input type="text" id="cus_name" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Address</label>
            <input type="text" id="cus_add" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer City</label>
            <input type="text" id="cus_city" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer State</label>
            <input type="text" id="cus_state" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Post Code</label>
            <input type="text" id="cus_postcode" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Country</label>
            <input type="text" id="cus_country" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Phone</label>
            <input type="text" id="cus_phone" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Fax</label>
            <input type="text" id="cus_fax" class="form-control form-control-sm"/>
        </div>

    </div>

    <hr/>

    <div class="row">

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Name</label>
            <input type="text" id="ship_name" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Address</label>
            <input type="text" id="ship_add" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping City</label>
            <input type="text" id="ship_city" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping State</label>
            <input type="text" id="ship_state" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Post Code</label>
            <input type="text" id="ship_postcode" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Country</label>
            <input type="text" id="ship_country" class="form-control form-control-sm"/>
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Phone</label>
            <input type="text" id="ship_phone" class="form-control form-control-sm"/>
        </div>

    </div>

    <hr/>



    <div class="row">
        <div class="col-md-3">
            <button onclick="ProfileCreate()" class="btn btn-danger">Save Change</button>
        </div>
    </div>


</div>


<script>


    async  function ProfileCreate(){

       let cus_name= document.getElementById('cus_name').value;
       let cus_add= document.getElementById('cus_add').value;
       let cus_city= document.getElementById('cus_city').value;
       let cus_state= document.getElementById('cus_state').value;
       let cus_postcode= document.getElementById('cus_postcode').value;
       let cus_phone= document.getElementById('cus_phone').value;
       let cus_country= document.getElementById('cus_country').value;
       let cus_fax= document.getElementById('cus_fax').value;
       let ship_name= document.getElementById('ship_name').value;
       let ship_add= document.getElementById('ship_add').value;
       let ship_city= document.getElementById('ship_city').value;
       let ship_state= document.getElementById('ship_state').value;
       let ship_postcode= document.getElementById('ship_postcode').value;
       let ship_country= document.getElementById('ship_country').value;
       let ship_phone= document.getElementById('ship_phone').value;

       let postBody={
           "cus_name": cus_name,
           "cus_add": cus_add,
           "cus_city": cus_city,
           "cus_state": cus_state,
           "cus_postcode": cus_postcode,
           "cus_country": cus_country,
           "cus_phone": cus_phone,
           "cus_fax": cus_fax,
           "ship_name": ship_name,
           "ship_add": ship_add,
           "ship_city":ship_city,
           "ship_state": ship_state,
           "ship_postcode": ship_postcode,
           "ship_country": ship_country,
           "ship_phone": ship_phone
       }


        $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        let res = await axios.post("/CreateProfile",postBody);
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        if(res.data['msg']==="success"){
            alert("Request Successful")
        }
        else{
            alert("Request Fail")
        }

    }

      async function ProfileDetails() {

          let res = await axios.get("/ReadProfile");
          if (res.data['data'] !== null) {

              document.getElementById('cus_name').value = res.data['data']['cus_name']
              document.getElementById('cus_add').value = res.data['data']['cus_add']
              document.getElementById('cus_city').value = res.data['data']['cus_city']
              document.getElementById('cus_state').value = res.data['data']['cus_state']
              document.getElementById('cus_postcode').value = res.data['data']['cus_postcode']
              document.getElementById('cus_phone').value = res.data['data']['cus_phone']
              document.getElementById('cus_country').value = res.data['data']['cus_country']
              document.getElementById('cus_fax').value = res.data['data']['cus_fax']
              document.getElementById('ship_name').value = res.data['data']['ship_name']
              document.getElementById('ship_add').value = res.data['data']['ship_add']
              document.getElementById('ship_city').value = res.data['data']['ship_city']
              document.getElementById('ship_state').value = res.data['data']['ship_state']
              document.getElementById('ship_postcode').value = res.data['data']['ship_postcode']
              document.getElementById('ship_country').value = res.data['data']['ship_country']
              document.getElementById('ship_phone').value = res.data['data']['ship_phone']


          }


      }



</script>
