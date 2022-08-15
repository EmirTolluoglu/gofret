<?php
$conn = mysqli_connect('localhost', 'root', '', 'posts');
$query = $conn -> prepare('SELECT * FROM `blog_posts`');
$query -> execute();
$query_result = $query -> get_result();
echo "<h1>Blog Posts</h1>";
while($row=$query_result->fetch_assoc())
{
    echo '<a href="post/'.$row['url'].'">'.$row['title'].'</a>';
    echo "<br>";
}
?>