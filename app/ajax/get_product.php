<?php 
require_once '../../src/connect.php';
session_start();

$requesterProduct = $_POST['u'];
$requestedProduct = $_POST['v'];

$stmt2 = $conn->prepare("SELECT product_request.product_request_id,
product_request.requested_product_id AS requested_product_id,
product_requested.product_name AS requested_product,
product_requested.product_type AS requested_product_type,
product_requester.product_name AS requester_product, 
product_requester.product_id AS requester_product_id, 
product_requester.product_type AS requester_product_type,
user_requester.user_name AS requester_username, 
user_requested.user_name AS requested_username, 
user_requested.user_profile_photo AS requested_user_profile,
user_requester.user_level AS requester_level 

FROM product_request 

INNER JOIN product AS product_requested 
    ON product_request.requested_product_id=product_requested.product_id 
    
INNER JOIN product AS product_requester 
    ON product_request.product_id=product_requester.product_id 

INNER JOIN user AS user_requested
    ON product_requested.user_id=user_requested.user_id 
    
INNER JOIN user AS user_requester 
    ON product_requester.user_id=user_requester.user_id 

WHERE (product_requested.product_id = $requestedProduct AND product_requester.product_id = $requesterProduct) OR (product_requested.product_id = $requesterProduct AND product_requester.product_id = $requestedProduct)");
$stmt2->execute();
$orders = $stmt2->fetch(PDO::FETCH_ASSOC);

echo json_encode($orders);


// <div class="content row mb-3">
// <div class="col-5 pe-0">
//     <p class="text-end">ogrenanemsi</p>
// </div>
// <div class="col-2 text-center">
//     <i class="fa fa-arrows-turn-to-dots"></i>
// </div>
// <div class="col-5 ps-0 text-start ">
//     <p>oglesine</p>
// </div>
// <div class="profile-card d-flex justify-content-between align-items-center">
//     <img class="border-0" src="img\profile.jpg" alt="logo">
//     <div class="handle ms-2 w-100 text-left">
//         <div class="handle2 align">
//             <p class="text-name fw-bold">username</p>
//         </div>
//         <h6 class="fw-light text-name">9 ortak Ark.</h6>
//     </div>
//     <div class="confirmation d-flex" id="heyoo" data-product-request-id=214" data-product-id="231" data-requested-id="321">
//         <button class="border-0 requestbtn-mini box me-1" value="s" style="background-color: #04cf98; color: black;"><i class="fa fa-check"> </i></button>
//         <button class="border-0 requestbtn-mini box ms-1" value="d" style="background-color: #fa0175; color: aliceblue;"><i class="fa fa-x"> </i></button>
//     </div>
// </div>
// </div>

