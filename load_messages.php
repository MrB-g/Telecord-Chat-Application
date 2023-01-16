<?php

require "config.php";

$query = $pdo->prepare("SELECT users.profile_pic_name, messages.message FROM users INNER JOIN messages ON messages.user_id = users.id");
$query->execute();
$result = $query->fetchAll();

if ($result) {
    foreach ($result as $value) {
        echo '      <div class="message">
                        <div class="message_profile_wrap">
                            <img class="message_profile" src="./profile_pic/'.$value["profile_pic_name"].'" />
                        </div>
                        <div class="message_box">'.$value["message"].'</div>
                    </div>';
    }
}