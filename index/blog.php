<?php
include_once("header.php");
include_once("../database/db.php");
?>

<link rel="stylesheet" href="css/blog.css">
<link rel="stylesheet" href="css/responsive.css">

<section class="reveal" id="blog-container">
    <div class="blogs">
        
        <?php
        $sql="SELECT * FROM blog";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $b_id=$row['b_id'];
                echo '
                <div class="post">
            <img src="' . $row['b_img'] . '" alt="">
            <br>
            <h3>'.$row['b_title'].' </h3>
            <br>
            <a href="readmore.php?b_id='.$b_id.'" class="button">Xem Thêm</a>
            <br><br><br>
        </div>
        ';
            }
        }
        ?>
    </div>
</section>
<script>
        //Animation Scroll
function reveal() {
    var reveals = document.querySelectorAll(".reveal");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

window.addEventListener("scroll", reveal);
</script>
<?php
include_once("footer.php");
?>