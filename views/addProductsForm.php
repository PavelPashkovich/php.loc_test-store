<form action="/save_products" method="post" enctype="multipart/form-data">
    <input type="text" name="name">
    <input type="file" name="files_arr[]" multiple>
    <textarea name="description"></textarea>
    <button type="submit">Send</button>
</form>
