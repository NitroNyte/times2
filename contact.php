<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    



<section id="friendsTab">
        <div class="popUpBox" id="popUp">
            <div class="popUpBox-inner">
                <h4 class="pb-5">Add friends using their email to send a request!</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">Please be specific when entering your friends email</small>
                    </div>
                </form>
                <input type="submit" name="loginButton" class="btn btn-primary mt-3 mb-3" value="Send request" id="closePopUp">
            </div>
        </div>

        <div class="popUpBoxNotification" id="popUpNotification">
            <div class="popUpBox-inner">

            </div>
        </div>


        <div class="floatingPart">
            <div class="imagePart">
                <img src="assets/images/addCircle.svg" alt="Add friend" id="friendCircle" style="cursor: pointer;">
                <img src="assets/images/notification.svg" alt="Notification" style="cursor: pointer;">
            </div>
        </div>
        <div class="friendsTabDesign">
            <div class="friendsGroup pl-3 pr-4 p-1">
                <img src="assets/images/account.svg" alt="" width="60">
                <div class="info">
                    <p>Name Surename</p>
                    <p>Last online</p>
                </div>
                <div class="linkBox">
                    <a href=""><img src="assets/images/chats.svg" alt="" width="30" title="Chat with friend"></a>
                    <a href=""><img src="assets/images/close.svg" alt="" width="30" title="Delete friend"></a>

                </div>
            </div>
            <div class="friendsGroup pl-3 pr-4 p-1">
                <img src="assets/images/account.svg" alt="" width="60">
                <div class="info">
                    <p>Name Surename</p>
                    <p>Last online</p>
                </div>
                <div class="linkBox">
                    <a href=""><img src="assets/images/chats.svg" alt="" width="30" title="Chat with friend"></a>
                    <a href=""><img src="assets/images/close.svg" alt="" width="30" title="Delete friend"></a>

                </div>
            </div>

        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/contact.js"></script>


</body>
</html>