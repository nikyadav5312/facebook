<?php
session_start();
include("js.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("connection.php");
include("navbar.php");

$currentURL = $_SERVER['REQUEST_URI'];
$parts = parse_url($currentURL);
parse_str($parts['query'], $query);

$friend = $query['username'];
$user = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$friend'";
$result = $conn->query($sql);

$user_data = null;
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}
?>
<section class="w-100 px-4 py-5" style="background-color: #9de2ff; border-radius: .5rem .5rem 0 0;">
    <div class="row d-flex justify-content-center">
        
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp" alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1 ms-3">

                                                           
                                <h5 class="mb-1"> <span>@<?php echo htmlspecialchars($friend); ?></span></h5>
                                <p class="mb-2 pb-1"><span><?php echo htmlspecialchars($user_data["name"]); ?></span></p>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">POST</p>
                                        <p class="mb-0">41</p>
                                    </div>
                                    <div class="px-3">
                                        <p class="small text-muted mb-1"><a href="showfriend.php" style="text-decoration: none;">Followers</a></p>
                                        <p class="mb-0">800.M</p>
                                    </div>
                                    <div>
                                        <p class="small text-muted mb-1">Following</p>
                                        <p class="mb-0">8.5.k</p>
                                    </div>
                                </div>
                                <div class="d-flex pt-1">
                                    <div class="d-flex mt-2">
                                        <form action="follow.php" method="post">
                                            <input type="hidden" name="user" value="<?php echo htmlspecialchars($user); ?>">
                                            <input type="hidden" name="friend" value="<?php echo htmlspecialchars($friend); ?>">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary me-1 flex-grow-1">Chat</button>
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary flex-grow-1">Follow</button>
                                        </form>
                                    </div>
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>