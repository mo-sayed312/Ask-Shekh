<?php
include('db.php');

if (isset($_GET['id'])) {
    $question_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
    $stmt->close();
}

$conn->close();
?>