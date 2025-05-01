const addFriendBtn = document.getElementById("friend");
const closeAddFriendBtn = document.getElementById("closePopUp");
const popUpBox = document.getElementById("popUp");

const notificationsBtn = document.getElementById("notifications");
const closeNotificationsBtn = document.getElementById(
  "closePopUpNotification"
);
const notificationsImg = document.getElementById("popUpNotifications");

addFriendBtn.addEventListener("click", () => {
  popUpBox.classList.add("open");
});

closeAddFriendBtn.addEventListener("click", () => {
  popUpBox.classList.remove("open");
});

notificationsBtn.addEventListener("click", () => {
  notificationsImg.classList.add("open");
});

closeNotificationsBtn.addEventListener("click", () => {
  notificationsImg.classList.remove("open");
});
