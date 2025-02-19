<?php
if (isset($_GET['id'])) {
$id = $_GET['id'];
$category = "SELECT * FROM `category` WHERE id = '$id'";
$category_sql = mysqli_query($con, $category);
$category_query = mysqli_fetch_assoc($category_sql);
$blogs = "SELECT blogs.*, category.category_name FROM `blogs` LEFT JOIN category ON category.id=blogs.category_id WHERE category_id = '$id' ";
$blogs_sql = mysqli_query($con, $blogs);
$blogs_query = mysqli_fetch_all($blogs_sql, MYSQLI_ASSOC);

// Increase the view count
$update_view_query = "UPDATE blogs SET view = view + 1 WHERE category_id = $id";
$update_sql = mysqli_query($con, $update_view_query);

// Fetch the blog details
$query = "SELECT * FROM blogs WHERE category_id = $id";
$blog_sql = mysqli_query($con, $query);

if (mysqli_num_rows($blog_sql) > 0) {
$blog_res = mysqli_fetch_all($blog_sql, MYSQLI_ASSOC);
} else {
echo "Blog not found.";
exit;
}
} else {
header('location: index.php');
die();
}