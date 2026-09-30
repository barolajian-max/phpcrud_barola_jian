<?php
$conn = new mysqli('localhost', 'root', '', 'phpcrud_barola_jian');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>