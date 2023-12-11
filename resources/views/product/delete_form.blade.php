<form method="POST" action="{{ route('products.destroy', $product->id) }}"  style="text-align: center">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Delete The Product</button>
</form>
