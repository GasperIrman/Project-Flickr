<?php 	require_once './Templates/header.php';?>

<body>

<form action="PHP/uploadImg.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file" id="fileToUpload"><br>
    <input type="text" name="tags"><br>
    <input type="text" name="title"><br>
    <input type="text" name="description"><br>
    <input type="submit" value="Upload Image" name="submit">

</form>

</body>

<?php 	include_once './Templates/footer.php' ;?>