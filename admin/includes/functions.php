<?php

function pr($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function prx($array)
{
    echo "<pre>";
    print_r($array);
    die;
}

// Category all active data 
function categoryData($con){
    $category = "SELECT * FROM category WHERE category_status = 1";
    $category_sql = mysqli_query($con, $category);
    $category_query = mysqli_fetch_all($category_sql, MYSQLI_ASSOC);
    return $category_query ;
}

// Blogs all data 
function blogsData($con){
    $blogs = "SELECT blogs.*, category.category_name FROM `blogs` LEFT JOIN category ON category.id=blogs.category_id";
    $blogs_sql = mysqli_query($con, $blogs);
    $blogs_query = mysqli_fetch_all($blogs_sql, MYSQLI_ASSOC);
    return $blogs_query ;
}

// Blogs all Business Data
function blogsBusiness($con)
{
    $blogs = "SELECT blogs.*, category.category_name FROM `blogs` LEFT JOIN category ON category.id=blogs.category_id WHERE category_name = 'Business & Finance'";
    $blogs_sql = mysqli_query($con, $blogs);
    $blogs_query = mysqli_fetch_all($blogs_sql, MYSQLI_ASSOC);
    return $blogs_query;
}
// Blogs all Technology Data
function blogstech($con)
{
    $blogs = "SELECT blogs.*, category.category_name FROM `blogs` LEFT JOIN category ON category.id=blogs.category_id WHERE category_name = 'Technology'";
    $blogs_sql = mysqli_query($con, $blogs);
    $blogs_query = mysqli_fetch_all($blogs_sql, MYSQLI_ASSOC);
    return $blogs_query;
}