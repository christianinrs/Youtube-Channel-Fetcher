<?php
session_start();
$api_data = isset($_SESSION['api_data']) ? $_SESSION['api_data'] : null;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;

unset($_SESSION['api_data']);
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Get Detail Channel Youtube</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar-container">
        <h1>Christian</h1>
        <div class="subnavbar">
            <ul>
                <li>Home</li>
                <li>Feature</li>
                <li>Pricing</li>
            </ul>
        </div>
    </div>
    
    <div class="input-container" id="start">
        <form action="get_detail.php" method="POST">
            <h1>Input Your Channel Link</h1>
            <input class="input-class" type="url" id="urlnya" name="urlnya" placeholder="https://www.youtube.com/#####" required> <br>
            <button class="button-class" type="submit">Check Detail</button> 
        </form>
    </div>
    
    <?php if ($api_data !== null): ?>
        <div id="result-container">
            <?php
            $profileImage120 = "";
            if (isset($api_data['channelProfiles'])) {
                foreach ($api_data['channelProfiles'] as $profile) {
                    if ($profile['width'] == 120) {
                        $profileImage120 = $profile['url'];
                        break;
                    }
                }
            }
            ?>
            
            <?php if ($profileImage120): ?>
                <img src="<?php echo htmlspecialchars($profileImage120); ?>" alt="Profile Image" style="border-radius: 50%; margin-top: 10px;">
            <?php endif; ?>
            <div class="output-container">
                <span>Channel Name</span>
                <span><?php echo htmlspecialchars($api_data['channelName']); ?></span>
            </div>
            
            <div class="output-container">
                <span>Jumlah Subscriber</span>
                <span><?php echo htmlspecialchars($api_data['subscribersTotal']); ?></span>
            </div>
            
            <div class="output-container">
                <span>Number of videos</span>
                <span><?php echo htmlspecialchars($api_data['videosTotal']); ?></span>
            </div>
            
            <div class="output-container">
                <span>Channel Description</span>
                <span><?php echo htmlspecialchars($api_data['channelDescription']); ?></span>
            </div>
            
            <div class="output-container">
                <span>Country Channel</span>
                <span><?php echo htmlspecialchars($api_data['country']); ?></span>
            </div>
            
            <div class="output-container">
                <span>Total Views</span>
                <span><?php echo htmlspecialchars($api_data['viewCount']); ?></span>
            </div>
            
            <div class="output-container">
                <span>Channel Join Date</span>
                <span><?php echo htmlspecialchars($api_data['joinedDate']); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div id="error-message">
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <script>
        <?php if ($api_data !== null): ?>
            document.getElementById("result-container").style.display = "block";
        <?php endif; ?>

        <?php if ($error): ?>
            document.getElementById("error-message").style.display = "block";
        <?php endif; ?>
    </script>
</body>
</html>
