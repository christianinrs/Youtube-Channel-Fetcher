<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url_yt = $_POST['urlnya'];
    
    $parsed_url = parse_url($url_yt);
    
    
    if (!isset($parsed_url['host']) || !preg_match('/youtube\.com$/', $parsed_url['host'])) {
        $_SESSION['error'] = "URL Tidak Valid!";
        header("Location: /");
        exit;
    }
    
    
    $url_server = "https://api.paxsenix.biz.id/yt/channel?url=".$url_yt;
    
    $ch = curl_init($url_server);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $result = json_decode($response, true);
    
    if ($result) {
        $_SESSION['api_data'] = $result;
    } else {
        $_SESSION['error'] = "Gagal Mendapatkan Data";
    }
    
    header("Location: /");
    exit;
}

?>
