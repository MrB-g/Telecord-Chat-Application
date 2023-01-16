<?php
require "config.php";
$pdo_statement = $pdo->prepare("SELECT users.profile_pic_name, users.name FROM users INNER JOIN login_users ON login_users.login_users_id = users.id");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
if ($result) {
    foreach ($result as $value) {
?>
<div class="member">
    <div class="member-profile-wrapper">
        <img src="./profile_pic/<?php
                                        echo $value['profile_pic_name'];
                                        ?>" />
    </div>
    <div class="member-name">
        <p><?php
                    echo $value['name'];
                    ?></p>
    </div>
</div>
<?php
    }
}
?>