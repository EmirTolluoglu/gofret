<?php
require_once 'src/connect.php';
session_start();


$activeUserId = $_GET['u'];
$realUserId = $_SESSION['user_id'];

$userStmt = $conn->query("SELECT * FROM user");
$userStmt->execute();
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    if ($user['user_id'] == $activeUserId) {
        $activeUser = $user;
    }
}

$messageStmt = $conn->query("SELECT * FROM `message` WHERE (from_user_id = $activeUserId OR to_user_id = $activeUserId) AND (from_user_id = $realUserId OR to_user_id = $realUserId) ORDER BY message_date ASC");
$messageStmt->execute();
$messages = $messageStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
    <style>
        :root {
            --theme-bg-color: rgba(16 18 27 / 40%);
            --body-font: "Poppins", sans-serif;

            --white: #374349;
            --black: #000;
            --bg: #f8f8f8;
            --grey: #999;
            --dark: #fff;
            --light: #515f68;
            --wrapper: 1000px;
            --blue: #a425a8;
        }

        ::placeholder {
            color: #999;
        }

        body {
            font-family: var(--body-font);
            background-image: url("img/backd.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 2em;
        }

        .video-bg {
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .video-bg video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .app {
            background-color: rgba(16 18 27 / 40%);
            max-width: 1250px;
            max-height: 860px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            width: 100%;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            font-size: 15px;
            font-weight: 500;
        }

        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        /* :root {
            
            --white: #202C33;
            --black: #000;
            --bg: #f8f8f8;
            --grey: #999;
            --dark: #fff;
            --light: #e6e6e6;
            --wrapper: 1000px;
            --blue: #00b0ff;
        } */

        body {
            background-color: var(--bg);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 400;
        }

        .wrapper {
            position: relative;
            left: 50%;
            width: var(--wrapper);
            height: 800px;
            transform: translate(-50%, 0);
        }

        .container {}

        .container .left {
            float: left;
            width: 37.6%;
            height: 100vh;
            border: 1px solid var(--light);
            background-color: var(--white);
        }

        .container .left .top {
            position: relative;
            width: 100%;
            height: 96px;
            padding: 29px;
        }

        .container .left .top:after {
            position: absolute;
            bottom: 0;
            left: 50%;
            display: block;
            width: 80%;
            height: 1px;
            content: "";
            background-color: var(--light);
            transform: translate(-50%, 0);
        }

        .container .left input {
            float: left;
            width: 188px;
            height: 42px;
            padding: 0 15px;
            border: 1px solid var(--light);
            background-color: #515f68;
            border-radius: 21px;
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 400;
        }

        .container .left input:focus {
            outline: none;
        }

        .container .left a.search {
            display: block;
            float: left;
            width: 42px;
            height: 42px;
            margin-left: 10px;
            border: 1px solid var(--light);
            background-color: var(--blue);
            background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/name-type.png");
            background-repeat: no-repeat;
            background-position: top 12px left 14px;
            border-radius: 50%;
        }

        .container .left .people {
            padding: 0;
            margin-left: -1px;
            border-right: 1px solid var(--light);
            border-left: 1px solid var(--light);
            width: calc(100% + 2px);
        }

        .container .left .people .person {
            position: relative;
            width: 100%;
            padding: 12px 10% 28px;
            cursor: pointer;
            background-color: var(--white);
        }

        .container .left .people .person:after {
            position: absolute;
            bottom: 0;
            left: 50%;
            display: block;
            width: 80%;
            height: 1px;
            content: "";
            background-color: var(--light);
            transform: translate(-50%, 0);
        }

        ::marker {
            color: #a425a8;
            width: 20px;
            height: 20px;
        }

        .container .left .people .person img {
            float: left;
            width: 40px;
            height: 40px;
            margin-right: 12px;
            border-radius: 50%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .container .left .people .person .name {
            font-size: 14px;
            line-height: 22px;
            color: var(--dark);
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 600;
        }

        .container .left .people .person .time {
            font-size: 14px;
            position: absolute;
            top: 16px;
            right: 10%;
            padding: 0 0 5px 5px;
            color: var(--grey);
            background-color: var(--white);
        }

        .container .left .people .person .preview {
            font-size: 14px;
            display: inline-block;
            overflow: hidden !important;
            width: 70%;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: var(--grey);
        }

        .container .left .people .person.active,
        .container .left .people .person:hover {
            margin-top: -1px;
            margin-left: -1px;
            padding-top: 13px;
            border: 0;
            background-color: var(--blue);
            width: calc(100% + 2px);
            padding-left: calc(10% + 1px);
        }

        .container .left .people .person.active span,
        .container .left .people .person:hover span {
            color: var(--white);
            background: transparent;
        }

        .container .left .people .person.active:after,
        .container .left .people .person:hover:after {
            display: none;
        }

        .container .right {
            position: relative;
            float: left;
            width: 62.4%;
            height: 90vh;
        }

        .container .right .top {
            width: 100%;
            height: 47px;
            padding: 15px 29px;
            background-color: var(--white);
        }

        .container .right .top span {
            font-size: 15px;
            color: var(--grey);
        }

        .container .right .top span .name {
            color: var(--dark);
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 600;
        }

        .container .right .chat {
            position: relative;
            overflow-y: scroll;
            padding: 40vh 35px 40px;
            border-width: 1px 1px 1px 0;
            border-style: solid;
            border-color: var(--light);
            height: calc(100% - 48px);
            justify-content: flex-end;
            flex-direction: column;
        }

        .container .right .chat.active-chat {
            display: block;
            background-color: rgb(20, 20, 20, 20%);
        }

        .container .right .chat.active-chat .bubble {
            transition-timing-function: cubic-bezier(0.4, -0.04, 1, 1);
            border-radius: 24px !important;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(1) {
            -webkit-animation-duration: 0.15s;
            animation-duration: 0.15s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(2) {
            -webkit-animation-duration: 0.3s;
            animation-duration: 0.3s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(3) {
            -webkit-animation-duration: 0.45s;
            animation-duration: 0.45s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(4) {
            -webkit-animation-duration: 0.6s;
            animation-duration: 0.6s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(5) {
            -webkit-animation-duration: 0.75s;
            animation-duration: 0.75s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(6) {
            -webkit-animation-duration: 0.9s;
            animation-duration: 0.9s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(7) {
            -webkit-animation-duration: 1.05s;
            animation-duration: 1.05s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(8) {
            -webkit-animation-duration: 1.2s;
            animation-duration: 1.2s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(9) {
            -webkit-animation-duration: 1.35s;
            animation-duration: 1.35s;
        }

        .container .right .chat.active-chat .bubble:nth-of-type(10) {
            -webkit-animation-duration: 1.5s;
            animation-duration: 1.5s;
        }

        .container .right .write {
            position: absolute;
            bottom: 0;
            height: 42px;
            padding-left: 8px;
            border: 1px solid var(--light);
            background-color: var(--white);
            width: 100%;
            border-radius: 5px;
        }

        .container .right .write input {
            font-size: 16px;
            float: left;
            width: 89%;
            height: 40px;
            padding: 0 10px;
            color: var(--dark);
            border: 0;
            outline: none;
            background-color: var(--white);
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 400;
        }

        .container .right .write .write-link.attach:before {
            display: inline-block;
            float: left;
            width: 20px;
            height: 42px;
            content: "";
            background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/attachment.png");
            background-repeat: no-repeat;
            background-position: center;
        }

        .container .right .write .write-link.smiley:before {
            display: inline-block;
            float: left;
            width: 20px;
            height: 42px;
            content: "";
            background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/smiley.png");
            background-repeat: no-repeat;
            background-position: center;
        }

        .container .right .bubble {
            font-size: 16px;
            position: relative;
            display: inline-block;
            clear: both;
            margin-bottom: 8px;
            padding: 13px 14px;
            vertical-align: top;
            border-radius: 25px;
        }

        .container .right .bubble:before {
            position: absolute;
            top: 22px;
            display: block;
            width: 8px;
            height: 6px;
            content: " ";
            transform: rotate(29deg) skew(-35deg);
        }

        .container .right .bubble.you {
            float: left;
            color: var(--dark);
            background-color: var(--white);
            align-self: flex-start;
            -webkit-animation-name: slideFromLeft;
            animation-name: slideFromLeft;
        }

        .container .right .bubble.you:before {
            left: -3px;
            background-color: var(--white);
        }

        .container .right .bubble.me {
            float: right;
            color: var(--dark);
            background-color: var(--blue);
            align-self: flex-end;
            -webkit-animation-name: slideFromRight;
            animation-name: slideFromRight;
        }

        .container .right .bubble.me:before {
            right: -3px;
            background-color: var(--blue);
        }

        .container .right .conversation-start {
            position: relative;
            width: 100%;
            margin-bottom: 27px;
            text-align: center;
        }

        .container .right .conversation-start span {
            font-size: 14px;
            display: inline-block;
            color: var(--grey);
        }

        .container .right .conversation-start span:before,
        .container .right .conversation-start span:after {
            position: absolute;
            top: 10px;
            display: inline-block;
            width: 30%;
            height: 1px;
            content: "";
            background-color: var(--light);
        }

        .container .right .conversation-start span:before {
            left: 0;
        }

        .container .right .conversation-start span:after {
            right: 0;
        }

        @keyframes slideFromLeft {
            0% {
                margin-left: -200px;
                opacity: 0;
            }

            100% {
                margin-left: 0;
                opacity: 1;
            }
        }

        @-webkit-keyframes slideFromLeft {
            0% {
                margin-left: -200px;
                opacity: 0;
            }

            100% {
                margin-left: 0;
                opacity: 1;
            }
        }

        @keyframes slideFromRight {
            0% {
                margin-right: -200px;
                opacity: 0;
            }

            100% {
                margin-right: 0;
                opacity: 1;
            }
        }

        @-webkit-keyframes slideFromRight {
            0% {
                margin-right: -200px;
                opacity: 0;
            }

            100% {
                margin-right: 0;
                opacity: 1;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .prodcutQueue {

            text-decoration: underline;
            background: rgb(66 66 66 / 68%);
            position: absolute;
            top: -10px;
            left: -10px;
            color: #0069c2;

        }
    </style>

    <div class="video-bg">
        <video width="320" height="240" autoplay loop muted>
            <source src="img/arka.mp4" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="app rounded-4 container px-0">
        <div class="h-100">
            <div class="rounded-4">
                <div class="left">
                    <div class="top">
                        <input type="text" placeholder="Search" />
                        <a href="javascript:;" class="search"></a>
                    </div>

                    <ul id="people" class="people">
                        <?php foreach ($users as $otherUser) { ?>

                            <li class="person" data-chat="<?= $otherUser['user_id'] ?>">
                                <img src="<?= $otherUser['user_profile_photo'] ?>" alt="Pp" />
                                <span class="name"><?= $otherUser['user_name'] ?></span>
                                <span class="time">2:09 PM</span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="right">
                    <div class="top"><span>To: <span class="name"><?= $user["user_name"]; ?></span></span></div>

                    <div id="chat" class="chat" data-chat="person2">
                        <div class="conversation-start">
                            <span>Today, 5:38 PM</span>
                        </div>
                        <?php foreach ($messages as $message) { ?>
                            <div class="bubble <?php if ($activeUserId == $message['from_user_id']) {
                                                    echo "me";
                                                } else {
                                                    echo "you";
                                                } ?>">
                                <?php echo $message['message_content']; ?>
                            </div>
                        <?php } ?>
                    </div>



                    <div class="write d-flex align-items-center">
                        <input class="w-100" type="text" id="send_box" name="send_box" />
                        <button id="m_send" type="button" class="write-link send me-2 d-flex align-items-center" style="color: var(--blue);"><i class="fa fa-paper-plane my-auto mx-2"></i></button>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                activeUserId = 0;
                $('#people').click(function(event) {
                    if (event.target.classList.contains('active')) {
                        return;
                    }
                    event.target.classList.add('active');
                    //remove active class from all other people
                    $('#people li').not(event.target).removeClass('active');
                    //get chat messages from ajax
                    activeUserId = event.target.dataset.chat;
                    $.post("app/ajax/get_message.php", {
                            u: event.target.dataset.chat
                        },
                        function(results) {
                            var data = JSON.parse(results);
                            //empty chat box
                            $('#chat').empty();
                            //append messages to chat box
                            for (var i = 0; i < data.length; i++) {
                                var message = data[i];
                                var bubble = document.createElement('div');
                                //add data attributes to bubble
                                bubble.setAttribute('data-message', message.message_id);
                                bubble.classList.add('bubble');
                                // bubble.attr('data-message', message.message_id);
                                if (message.from_user_id == <?= $realUserId ?>) {
                                    bubble.classList.add('me');
                                } else {
                                    bubble.classList.add('you');
                                }
                                bubble.innerHTML = message.message_content;
                                $('#chat').append(bubble);
                                if (message.message_product_quatation_id != 0) {
                                    prodcutQueue(message.message_id, message.message_product_quatation_id);
                                }
                                //scroll top of #chat without animate
                                $('#chat').scrollTop(0);
                            }
                        });
                });

                $('#m_send').click(function() {
                    const message_input = $('#send_box');
                    const message = message_input.val().trim();
                    const chat = $('#chat');
                    // chat.scrollTop(chat.prop('scrollHeight'));
                    //scroll to bottom of chat animate
                    chat.animate({
                        scrollTop: chat.prop('scrollHeight')
                    }, 1000, 'swing');
                    if (message != '') {
                        $.post("app/ajax/send_message.php", {
                                v: message,
                                u: activeUserId
                            },
                            function(data) {
                                if (data == 's') {
                                    message_input.val('');
                                    message_input.focus();
                                    //scroll down
                                    $('#chat').append('<div class="bubble me">' + message + '</div>');

                                    chat.scrollTop(chat.prop('scrollHeight'));
                                }
                                // $('#chat').append('<div class="bubble you">' + $('#send_box').val() + '</div>');
                                // $('#send_box').val('');
                            });
                    }

                });


                function prodcutQueue(message_id, product_id) {
                    $.post("app/ajax/get_product.php", {
                            u: product_id
                        },
                        function(results) {
                            var data = JSON.parse(results);
                            var queue = document.createElement('a');
                            queue.setAttribute('data-product', data.product_id);
                            queue.setAttribute('href', "product.php?u=" + data.product_name);
                            queue.classList.add('prodcutQueue');

                            queue.innerHTML = data.product_name;
                            //get element with message_id attribute
                            var message = document.querySelector('[data-message="' + message_id + '"]');
                            message.append(queue);
                        });
                }
            });
        </script>
    </div>
</body>

</html>