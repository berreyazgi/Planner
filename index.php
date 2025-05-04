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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/notes.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/sidebar.css"> 
</head>
<body>
<script src="main.js"></script>

<!--sidebar-html-->
<nav class="sidebar">
<div class="logo">My Planner</div>
  <ul class="sidebar-top">
    <li><a href="#"><i class="bi bi-sticky"></i><span>Notes</span></a></li>
    <li><a href="#"><i class="bi bi-card-checklist"></i><span>To-Do List</span></a></li>
    <li><a href="#"><i class="bi bi-calendar-week"></i><span>Calendar</span></a></li>
    <li><a href="#"><i class="bi bi-stopwatch"></i><span>Pomodoro</span></a></li>
    </ul>
    <ul class="sidebar-bottom">
      <li><a href="#"><i class="bi bi-person"></i><span>Profile</span></a></li>
      <li><a href="#"><i class="bi bi-gear"></i><span>Settings</span></a></li>
      <li><a href="#"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a></li> 
  </ul>
</nav>




  

<h1>My Notes</h1>
<div> 
<button id="show-note-form" class="add-note" >+ New Note</button>
<script src="script.js"></script>
        <?php if (isset($_GET['error'])): ?>
            <div style="color: red; margin-bottom: 10px;">
                Add note failed. Please fill in all fields.
            </div>
        <?php endif; ?>
    <form id="note-form" class="new-note" action="create.php" method="post">
        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>">
        <input type="text" name="title" placeholder="Note title" autocomplete="off" value="<?php echo $currentNote['title']; ?>">
        <textarea name="description" cols="30" rows="4"
        placeholder="Note Description" required><?php echo $currentNote['description'] ?></textarea>
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
                <div class="note-header">
                    <i class="bi bi-pencil-square"></i>
                <a href="index.php?id=<?php echo $note['id']; ?>"><?php echo $note['title']; ?></a>
                </div>
                <div class="description">
                    <?php echo $note['description']; ?>
                </div>
                <small class="note-date"><?php echo $note['create_date']; ?></small>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $note['id']; ?>">
                    <button class="delete"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
        
          
</body>
</html>
