@extends('master')
@section('css')

@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add Product</button>


                                <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control search" placeholder="Search...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="sort" data-sort="phone">Image</th>
                                    <th class="sort" data-sort="customer_name">Title</th>
                                    <th class="sort" data-sort="email">Description</th>
                                    <th class="sort" data-sort="date">Sales Count</th>
                                    <th class="sort" data-sort="status">Rate</th>
                                    <th class="sort" data-sort="action">Price</th>
                                    <th class="sort" data-sort="action">Discount</th>
                                    <th class="sort" data-sort="action">Final Price </th>
                                    <th class="sort" data-sort="action">Category</th>
                                    <th class="sort" data-sort="action">Sub Category</th>
                                    <th class="sort" data-sort="action">Brand</th>
                                    <th class="sort" data-sort="action">Processing</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </th>
                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                        <td class="customer_name"><img src="{{ asset('Attachments/Product/'.$product->photo) }}" width="50px" height="50px" style="border-radius: 50%"></td>
                                        <td class="customer_name">{{ $product->title }}</td>
                                        <td class="customer_name">{{ $product->description }}</td>
                                        <td class="customer_name">{{ $product->sales_count }}</td>
                                        <td class="customer_name">{{ $product->rate }}</td>
                                        <td class="customer_name"><del>{{ $product->price }} LE</del></td>
                                        @if ($product->discount_percent != 0)
                                            <td class="customer_name">{{ $product->discount_percent }}%</td>
                                        @elseif ($product->discount_value != 0)
                                            <td class="customer_name">{{ $product->discount_value }} LE</td>
                                        @else
                                            <td class="customer_name" style="color: rgb(0, 51, 255); font-style: italic">No Discount</td>
                                        @endif
                                        <td class="customer_name">{{ $product->final_value }} LE</td>
                                        <td class="customer_name">{{ $product->Category->name }}</td>
                                        <td class="customer_name">{{ $product->Sub_category->name }}</td>
                                        <td class="customer_name">{{ $product->Brand->title }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-success edit-item-btn edit-btn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                                </div>
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-primary edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal"><a href="{{ route('products.show',$product->id) }}">Show Product</a></button>
                                                </div>
                                                <div class="remove">
                                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="javascript:void(0);">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- This is where the form content will be displayed -->
            </div>
            <!-- ... (other modal elements) ... -->
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-edit-body">
                <!-- This is where the form content will be displayed -->
            </div>
            <!-- ... (other modal elements) ... -->
        </div>
    </div>
</div> --}}




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
    $('#create-btn').click(function () {
        $.ajax({
            url: "{{ route('products.create') }}",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('#showModal .modal-body').html(response.html);
            },
            error: function () {
                alert('Failed to load create form.');
            }
        });
    });
});

</script>

<script>
    $(document).ready(function () {
    $('.edit-btn').click(function () {
        var productId = $(this).data('id');
        // console.log(productId);
        var url = "{{ route('products.edit',":productId") }}";
        // console.log(url);
        url = url.replace(":productId",productId)
        $.ajax({
            url:url ,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('#showModal .modal-body').html(response.html);
            },
            error: function () {
                alert('Failed to load create form.');
            }
        });
    });
});
</script>


@endsection
@section('js')

@endsection
