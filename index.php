<?php

$connection = require_once './Connection.php';
$notes = $connection->getNotes();
$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Planner</title>
    <link rel="stylesheet" href="styles/notes.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/sidebar.css">
</head>
<body>
    <!--sidebar-html-->
<nav class="sidebar">
<div class="sidebar-link">
      <h2>Planner</h2>
      <img src="icons/home.svg">
        <div>Home</div>
      </div>
      <div class="sidebar-link">
        <img src="icons/explore.svg">
        <div>Explore</div>
      </div>
      <div class="sidebar-link">
        <img src="icons/subscriptions.svg">
        <div>Subscriptions</div>
      </div>
      <div class="sidebar-link">
        <img src="icons/originals.svg">
        <div>Originals</div>
      </div>
      <div class="sidebar-link">
        <img src="icons/youtube-music.svg">
        <div>YouTube Music</div>
      </div>
      <div class="sidebar-link">
        <img src="icons/library.svg">
        <div>Library</div>
      </div>
    </nav>

<!--navbar-html-->
    <div class="navbar">
      <div class="left-section">
        <h1>MY NOTES</h1>
    </di>
    <div class="middle-section">
        <input class="search-bar" type="text" placeholder="Search">
        <button class="search-btn"><i class="bi bi-search"></i>🔍</button>
        </div>
        <div class="right-section">
            <button class="settings-btn">⚙️</button>
            <button class="profile-btn">👤</button>
        </div>
    </div> 
    
<!--notes-html-->
<div> 
<h1>My Notes</h1>
<button id="show-note-form" class="add-note" >+ New Note</butto>
    <form id="note-form" class="new-note" action="create.php" method="post">
        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>">
        <input type="text" name="title" placeholder="Note title" autocomplete="off" value="<?php echo $currentNote['title']; ?>">
        <textarea name="description" cols="30" rows="4"
        placeholder="Note Description">
        <?php echo $currentNote['description'] ?></textarea>
        <button>
            <?php if ($currentNote['id']): ?>
                Update Note
            <?php else: ?>
                Add Note
            <?php endif; ?>
        </button>
    </form>

    <div class="notes">

        <?php foreach($notes as $note): ?>
            <div class="note">
                <div class="'title">
                <a href=""><?php echo $note['title']; ?></a>
                </div>
                <div class="description">
                    <?php echo $note['description']; ?>
                </div>
                <small><?php echo $note['create_date']; ?></small>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $note['id']; ?>">
                    <button class="delete">X</button>
                </form>
            </div>
        <?php endforeach; ?>

        <script>
        const showButton = document.getElementById('show-note-form');
        const form = document.getElementById('note-form');

        showButton.addEventListener('click', function (e) {
            e.preventDefault(); // Sayfanın en üstüne gitmesini engeller
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
        </script>

</div>
</body>
</html>
