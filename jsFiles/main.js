function toggleNoteForm() {
  var element = document.getElementById("noteForm");4

  element.classList.toggle("new-note");
 // if (element.classList.contains("new-note")) {
   // element.classList.remove("new-note");
  //}
}


document.addEventListener("DOMContentLoaded", 
  function () {
const noteGrid = document.querySelector(".notes");
const addNoteButton = document.getElementById("toggleNoteForm");
const noteForm = document.getElementById("noteForm");

addNoteButton.addEventListener("click", () => {
        noteForm.classList.toggle("hidden");
    });

const colors = ["#e0f7d4", "#ffd6d6", "#d0e6ff", "#fff9cc", "#e6ccff", "#ccf2ff"];

addNoteButton.addEventListener("click", () => {
  const note = document.createElement("div");
  note.classList.add("note");
  
  const randomColor = colors[Math.floor(Math.random() * colors.length)];
  note.style.backgroundColor = randomColor;

  const today = new Date();
  const date = today.toLocaleDateString();
  const time = today.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

  note.innerHTML = `
    <p class="date">${date}</p>
    <h3>New Note</h3>
    <p>This is a dynamically generated note.</p>
    <p class="time">${time}</p>
  `;
    const newNoteBtn = document.getElementById("newNoteBtn");
    const noteForm = document.getElementById("noteForm");

    newNoteBtn.addEventListener("click", () => {
    noteForm.classList.remove("hidden");
    });

  // Insert before the "+ New Note" button
  noteGrid.insertBefore(note, addNoteButton);
});
});

