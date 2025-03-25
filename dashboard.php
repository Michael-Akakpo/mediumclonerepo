<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Fetch blogs from DummyJSON API
$blogs = json_decode(file_get_contents('https://dummyjson.com/posts'), true)['posts'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Medium Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #FAF7F2;
            color: #191919;
        }
        header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #ddd;
        }
        .container {
            padding: 20px;
        }
        .blog {
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .blog h2 a {
            color: #1A8917;
            text-decoration: none;
        }
        .blog h2 a:hover {
            text-decoration: underline;
        }
        .logout {
            color: #1A8917;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <a href="logout.php" class="logout">Logout</a>
    </header>

    <div class="container">
        <h2>Latest Blogs</h2>
        <?php foreach ($blogs as $blog): ?>
            <div class="blog">
                <h2><a href="https://dummyjson.com/posts/<?php echo $blog['id']; ?>" target="_blank"> <?php echo htmlspecialchars($blog['title']); ?></a></h2>
                <p><?php echo htmlspecialchars($blog['body']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
