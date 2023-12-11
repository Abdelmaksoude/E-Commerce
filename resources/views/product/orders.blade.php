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
                                    <th class="sort" data-sort="customer_name">Name</th>
                                    <th class="sort" data-sort="email">Email</th>
                                    <th class="sort" data-sort="phone">Phone</th>
                                    <th class="sort" data-sort="phone">Address</th>
                                    <th class="sort" data-sort="phone">Country</th>
                                    <th class="sort" data-sort="phone">City</th>
                                    <th class="sort" data-sort="phone">Created At</th>
                                    <th class="sort" data-sort="phone">Product Name</th>
                                    <th class="sort" data-sort="phone">Product Quantity</th>
                                    <th class="sort" data-sort="phone">Discount</th>
                                    <th class="sort" data-sort="phone">Shipping</th>
                                    <th class="sort" data-sort="phone">Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="customer_name">{{ $order->fname }}&nbsp;{{ $order->lname }}</td>
                                    <td class="email">{{ $order->email }}</td>
                                    <td class="phone">{{ $order->phone }}</td>
                                    <td class="phone">{{ $order->adress1 }}</td>
                                    <td class="phone">{{ $order->country }}</td>
                                    <td class="phone">{{ $order->city }}</td>
                                    <td class="phone" style="color: blue">{{ $order->created_at->diffForHumans() }}</td>
                                    <td class="phone">{{ $order->productname }}</td>
                                    <td class="phone">{{ $order->productquantity }}</td>
                                    @php
                                        $theproduct = App\Models\Product::find($order->productid);
                                        if ($theproduct->discount_percent != 0) {
                                            $dicount = $theproduct->discount_percent."%";
                                        }
                                        elseif ($theproduct->discount_value != 0) {
                                            $dicount = $theproduct->discount_value."$";
                                        }
                                        else {
                                            $dicount = "No Discount";
                                        }
                                    @endphp
                                    <td class="phone">{{ $dicount }}</td>
                                    <td class="phone">{{ $order->shipping }}</td>
                                    <td class="phone">{{ $order->totalprice }}</td>

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

@endsection
@section('js')

@endsection

