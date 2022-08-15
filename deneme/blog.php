<?php
$conn = mysqli_connect('localhost', 'root', '', 'posts');
$url = $_GET['url'];
$query = $conn -> prepare('SELECT * FROM `blog_posts` WHERE `url`= ?');
$query -> bind_param('s', $url);
$query -> execute();
$query_result = $query -> get_result();
$query_data = $query_result -> fetch_assoc();
echo '<h1>'.$query_data['title'].'</h1>';
echo '<p>'.$query_data['blog_conetnets'].'</p>';
?>