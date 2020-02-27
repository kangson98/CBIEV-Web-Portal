<!DOCTYPE html>
<html lang="en">

<!-- upload -->
<form action="/process" enctype="multipart/form-data" method="post">
    <label for="projectFile">
        <input type="file" name="projectfiles" id="projectfiles">
    </label>
<button type="submit">Upload</button>
{{ csrf_field() }}
</div>

<!-- view upload -->
