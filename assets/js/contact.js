const addFriendBtn = document.getElementById("friend");
const closeAddFriendBtn = document.getElementById("closePopUp");
const popUpBox = document.getElementById("popUp");

addFriendBtn.addEventListener("click", () => {
  popUpBox.classList.add("open");
});

closeAddFriendBtn.addEventListener("click", () => {
  popUpBox.classList.remove("open");
});

const notificationsBtn = document.getElementById("notifications");

//Per marjanin notify button i website
notificationsBtn.addEventListener("click", () => {
  window.location.href='contact.php?clist=true'
});


