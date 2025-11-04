<?php
// When Download button is clicked
if (isset($_POST['downloadBtn'])) {
    $imgURL = $_POST['field'];
    $regPattern = '/\.(jpe?g|png|gif|bmp)$/i';
    if (preg_match($regPattern, $imgURL)) {
        $initCURL = curl_init($imgURL);
        curl_setopt($initCURL, CURLOPT_RETURNTRANSFER, true);
        $downloadImgLink = curl_exec($initCURL);
        curl_close($initCURL);
        // Convert the base 64 string to image and force download
        header("Content-Type: image/jpg"); // You can set the format/extention you want to download
        header("Content-Disposition: attachment; filename=\"image.jpg\"");
        echo $downloadImgLink;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Image App by @lucsantosdev</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/bf71d6f50f.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="preview-box">
            <div class="cancel-icon"><i class="fas fa-times"></i></div>
            <div class="img-preview"></div>
            <div class="content">
                <div class="img-icon"><i class="far fa-image"></i></div>
                <div class="text">Paste the image URL below, <br/>to see a preview or download!</div>
            </div>
        </div>
        <form action="index.php" method="POST" class="input-data">
            <input type="text" id="field" name="file" placeholder="Paste here the Image URL to Download..." autocomplete="off">
            <input type="submit" id="button" name="downloadBtn" value="Download">
        </form>
    </div>
    <script>
        $(document).ready(function() {
            // If user focus out from the input field
            $("#field").on("focusout", function() {
                //Getting user entered img URL
                let imgURL = $("#field").val();
                // Validation of img URL extension
                if (imgURL != "") {
                    const regPattern = /\.(jpe?g|png|gif|bmp)$/i;
                    if (regPattern.test(imgURL)) {
                        // Creates a new img tag to show img
                        let imgTag = `<img src="${imgURL}" alt="">`;
                        $(".img-preview").append(imgTag);
                        $(".preview-box").addClass("imgActive");
                        $("#button").addClass("active");
                        $("#field").addClass("disabled");
                        $(".cancel-icon").on("click", function() {
                            // On cancel icon click remove the added img tag
                            $(".preview-box").removeClass("imgActive");
                            $("#button").removeClass("active");
                            $("#field").removeClass("disabled");
                            $(".img-preview img").remove();
                        });
                    } else {
                        alert("Invalid image URL: " + imgURL);
                        $("#field").val(""); // Clear the input field if pattern not matches
                    }
                }
            });
        });
    </script>    
</body>
</html>