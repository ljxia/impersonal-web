<html>
<head>
  <title>Contours</title>
<body>
<h2><?php echo count($data) ?> Contour Patterns</h2>
<ul>

<?php foreach ($data as $pattern) 
{
  ?>
    <li>
      <?php if (!empty($pattern->contour_fileName)) {echo $pattern->contour_fileName."<br />";} ?>
      <img src="../../uploads/contour/ctr_<?php echo $pattern->contour_id; ?>.png" alt="" />
    </li>
  <?php
} ?>

</ul>
</body>
</html>