<form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Item Name</label>
    <input type="text" name="title" placeholder="e.g. Black Leather Wallet" required>

    <label>Category</label>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="Accessories">Accessories</option>
        <option value="Electronics">Electronics</option>
        <option value="Other">Other</option>
    </select>

    <label>Status</label>
    <input type="radio" name="status" value="Lost" required> Lost
    <input type="radio" name="status" value="Found" required> Found

    <label>Description</label>
    <textarea name="description" placeholder="Describe the item..." required></textarea>

    <label>Location</label>
    <input type="text" name="location" placeholder="Where was it lost/found?" required>

    <label>Upload Image</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">Submit Item</button>
</form>