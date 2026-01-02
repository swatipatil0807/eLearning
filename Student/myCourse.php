<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'My Course');
define('PAGE', 'mycourse');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

if(isset($_SESSION['is_login'])){
  $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-9 mt-5">
  <div class="container">
    <h4 class="text-center">All Course</h4>

    <?php 
    if(isset($stuLogEmail)){
      $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, 
      c.course_desc, c.course_img, c.course_author, 
      c.course_original_price, c.course_price 
      FROM courseorder AS co 
      JOIN course AS c ON c.course_id = co.course_id 
      WHERE co.stu_email = '$stuLogEmail'";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
    ?>

    <div class="bg-light mb-3 p-3" style="border-radius:10px;">
      <h5 class="card-header bg-secondary text-white p-2 rounded">
        <?php echo $row['course_name']; ?>
      </h5>

      <div class="row mt-3">
        <div class="col-sm-3">
          <!-- FIXED IMAGE PATH -->
          <img src="../<?php echo $row['course_img']; ?>" class="img-fluid rounded" alt="pic">
        </div>

        <div class="col-sm-6">
          <p><?php echo $row['course_desc']; ?></p>
          <small>Duration: <?php echo $row['course_duration']; ?></small><br>
          <small>Instructor: <?php echo $row['course_author']; ?></small><br>

          <p class="mt-2">
            Price: 
            <del>₹<?php echo $row['course_original_price']; ?></del>
            <strong class="text-success">
              ₹<?php echo $row['course_price']; ?>
            </strong>
          </p>
        </div>

        <div class="col-sm-3 d-flex align-items-center">
          <a href="watchcourse.php?course_id=<?php echo $row['course_id'] ?>" 
             class="btn btn-primary w-100">
             Watch Course
          </a>
        </div>
      </div>
    </div>

    <?php 
        } 
      }
    }
    ?>

  </div>
</div>

<?php include('./stuInclude/footer.php'); ?>
