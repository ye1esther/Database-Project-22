<?php
    
    $filing_quarter_id = $_POST['filing_quarter_id'];
    $revenue = $_POST['revenue'];
    $rd_expense = $_POST['rd_expense'];
    $net_income = $_POST['net_income'];
    $earnings_per_share = $_POST['earnings_per_share'];
    $sql = "INSERT INTO Financial(filing_quarter_id, revenue, rd_expense, net_income, earnings_per_share)
    VALUES (?,?,?,?,?);";

    include 'open.php';

    if (!empty($filing_quarter_id) || !empty($revenue) || !empty($rd_expense) || !empty($net_income) || !empty($earnings_per_share)) {
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $filing_quarter_id,$revenue,$rd_expense,$net_income,$earnings_per_share); 
            if ($stmt->execute()) {
                echo "inserted successfully to Financial table";

            } else { 
                echo "insertion unsuccessful";
            }

        } else { 
            echo "Prepare failed.<br>";
            $error = $conn->errno . ' ' . $conn->error;
            echo $error; 
        }

        $stmt->close();
    } else {
        echo "All fields are required";
        die();
    }

    $conn->close();


?>
</body>