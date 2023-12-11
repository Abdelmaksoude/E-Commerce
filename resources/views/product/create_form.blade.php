<h4 style="text-align: center">Add Product</h4>
<form class="row g-3" id="createForm" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">Choose Header Photo</label>
        <input required type="file" class="form-control" id="validationDefault01" name="photo" >
    </div>
    @error('photo')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">Title Arabic</label>
        <input required type="text" class="form-control" id="validationDefault01" name="ar[title]" >
    </div>
    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">Title English</label>
        <input required type="text" class="form-control" id="validationDefault01" name="en[title]" >
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="col-md-4">
        <label for="validationDefault02" class="form-label">Description Arabic</label>
        <input required type="text"  class="form-control" id="validationDefault02" name="ar[description]" >
    </div>
    <div class="col-md-4">
        <label for="validationDefault02" class="form-label">Description English</label>
        <input required type="text"  class="form-control" id="validationDefault02" name="en[description]" >
    </div>
    <div class="col-md-4">
        <label for="validationDefault02" class="form-label">Rate</label>
        <input required type="text"  class="form-control" id="validationDefault02" name="rate" >
    </div>
    <div class="col-md-4">
        <label for="validationDefault02" class="form-label">Price</label>
        <input required type="text"  class="form-control" id="price" name="price" >
    </div>

    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">Apply Discount?</label>
        <select class="form-select" id="applyDiscountverfication" name="apply_discount_verify">
            <option selected disabled>Choose</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <div id="applyDiscount" class="col-md-4" style="display: none;">
        <label for="validationDefault01" class="form-label">Apply Discount?</label>
        <select class="form-select" id="applyDiscountSelect"  name="apply_discount">
            <option selected disabled>Choose</option>
            <option value="discount_value">Discount Value</option>
            <option value="discount_percent">Discount Percent</option>
        </select>
    </div>

    <div class="col-md-4" id="discountPercentContainer" style="display: none;">
        <label for="validationDefault02" class="form-label">Discount Percent</label>
        <input type="text" class="form-control" id="discount_percent" name="discount_percent" value="0">
    </div>

    <div class="col-md-4" id="discountValueContainer" style="display: none;">
        <label for="validationDefault03" class="form-label">Discount Value</label>
        <input type="text" class="form-control" id="discount_value" name="discount_value" value="0">
    </div>

    <div class="col-md-4">
        <label for="validationDefault03" class="form-label">Final Price</label>
        <input type="text" class="form-control" id="final_value" disabled>
    </div>

    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="col-md-3">
        <div class="form-group">
            <label for="gender">Category : <span class="text-danger">*</span></label>
            <select class="custom-select mr-sm-2" name="Category" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                <option selected disabled>Choose...</option>
                @foreach($all_category as $all_category)
                    <option  value="{{ $all_category->id }}">{{ $all_category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="gender">Sub Category : <span class="text-danger">*</span></label>
            <select class="custom-select mr-sm-2" name="subCategory" id="sub_category_id">

            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="gender">Brand : <span class="text-danger">*</span></label>
            <select class="custom-select mr-sm-2" name="brand_id">
                <option selected disabled>Choose...</option>
                @foreach($all_brand as $all_brand)
                    <option  value="{{ $all_brand->id }}">{{ $all_brand->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">Choose all photo of this product</label>
        <input type="file" class="form-control" id="validationDefault01" name="photos[]" multiple required>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
        $(document).ready(function () {
            // Add an event listener to the select element
            $('#applyDiscountverfication').change(function () {
                // Hide both discount containers initially
                $('#applyDiscount').hide();

                // Show the corresponding container based on the selection
                if ($(this).val() === 'yes') {
                    $('#applyDiscount').show();
                } else if ($(this).val() === 'no') {
                    $('#applyDiscount').hide();
                }
            });

            $('#applyDiscountSelect').change(function () {
                var selectedValue = $(this).val();

                // Hide both discount containers initially
                $('#discountPercentContainer').hide();
                $('#discountValueContainer').hide();

                // Show the corresponding container based on the selection
                if (selectedValue === 'discount_percent') {
                    $('#discountPercentContainer').show();
                } else if (selectedValue === 'discount_value') {
                    $('#discountValueContainer').show();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            function calculateFinalPrice() {
                var price = parseFloat($("#price").val());
                var applyDiscount = $("#applyDiscountSelect").val();
                var discount_percent = parseFloat($("#discount_percent").val());
                var discount_value = parseFloat($("#discount_value").val());

                var final_value_element = $("#final_value");

                if (applyDiscount === 'discount_percent' && discount_percent > 0 && price) {
                    final_value_element.val(price - (discount_percent / 100) * price);
                } else if (applyDiscount === 'discount_value' && discount_value > 0 && price) {
                    final_value_element.val(price - discount_value);
                } else {
                    final_value_element.val(price);
                }
            }

            // Add an event listener to recalculate whenever there's a change
            $("#applyDiscountSelect, #price, #discount_percent, #discount_value").on('change input', calculateFinalPrice);
        });
    </script>
{{-- ////////////////// ajax of the category --}}
    <script>
        $(document).ready(function() {
            $('select[name="Category"]').on('change', function() {
                var CategoryId = $(this).val();
                if (CategoryId) {
                    $.ajax({
                        url: "{{ URL::to('subGategory') }}/" + CategoryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subCategory"]').empty();
                            console.log(data)
                            $.each(data, function(key, value) {
                                $('select[name="subCategory"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>

