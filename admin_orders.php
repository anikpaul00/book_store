<?php
include 'config.php';
require 'fpdf/fpdf.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('Query failed');
    $message[] = 'Payment status has been updated!';

    // Generate PDF if payment status is completed
    if ($update_payment == 'completed') {
        generate_invoice_pdf($order_update_id);
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Query failed');
    header('location:admin_orders.php');
    exit;
}

function generate_invoice_pdf($order_id) {
    global $conn;

    // Fetch order details
    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$order_id'") or die('Query failed');
    if (mysqli_num_rows($order_query) > 0) {
        $order = mysqli_fetch_assoc($order_query);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Add content to PDF
        $pdf->Cell(190, 10, 'Bengal Books', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(190, 10, 'Your trusted book store', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 10, 'Order Confirmation', 0, 1);
        $pdf->Cell(50, 10, 'Order ID:', 0, 0);
        $pdf->Cell(50, 10, $order['id'], 0, 1);
        $pdf->Cell(50, 10, 'User ID:', 0, 0);
        $pdf->Cell(50, 10, $order['user_id'], 0, 1);
        $pdf->Cell(50, 10, 'Placed On:', 0, 0);
        $pdf->Cell(50, 10, $order['placed_on'], 0, 1);
        $pdf->Cell(50, 10, 'Name:', 0, 0);
        $pdf->Cell(50, 10, $order['name'], 0, 1);
        $pdf->Cell(50, 10, 'Email:', 0, 0);
        $pdf->Cell(50, 10, $order['email'], 0, 1);
        $pdf->Cell(50, 10, 'Address:', 0, 0);
        $pdf->Cell(50, 10, $order['address'], 0, 1);
        $pdf->Cell(50, 10, 'Total Products:', 0, 0);
        $pdf->Cell(50, 10, $order['total_products'], 0, 1);
        $pdf->Cell(50, 10, 'Total Price: ৳', 0, 0);
        $pdf->Cell(50, 10, $order['total_price'] . '/-', 0, 1);
        $pdf->Cell(50, 10, 'Payment Method:', 0, 0);
        $pdf->Cell(50, 10, $order['method'], 0, 1);
        $pdf->Cell(50, 10, 'Payment Status:', 0, 0);
        $pdf->Cell(50, 10, $order['payment_status'], 0, 1);

        // Ensure the invoices directory exists and is writable
        if (!file_exists('invoices')) {
            mkdir('invoices', 0777, true);
        }

        // Save the PDF to the invoices directory
        $file_path = "invoices/invoice_{$order_id}.pdf";
        $pdf->Output($file_path, 'F');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
<?php include 'admin_header.php'; ?>

<section class="orders">
   <h1 class="title">Placed Orders</h1>
   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
      if (mysqli_num_rows($select_orders) > 0) {
         while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
      ?>
      <div class="box">
         <p>User ID: <span><?php echo $fetch_orders['user_id']; ?></span></p>
         <p>Placed On: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
         <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
         <p>Number: <span><?php echo $fetch_orders['number']; ?></span></p>
         <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
         <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
         <p>Total Products: <span><?php echo $fetch_orders['total_products']; ?></span></p>
         <p>Total Price: <span>৳<?php echo $fetch_orders['total_price']; ?>/-</span></p>
         <p>Payment Method: <span><?php echo $fetch_orders['method']; ?></span></p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">Pending</option>
               <option value="completed">Completed</option>
            </select>
            <input type="submit" value="Update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
         </form>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<script src="js/admin_script.js"></script>
</body>
</html>
