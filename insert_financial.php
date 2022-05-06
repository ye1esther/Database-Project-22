<?php
    
    $filing_quarter_id = $_POST['filing_quarter_id'];
    $revenue = $_POST['revenue'];
    $rd_expense = $_POST['rd_expense'];
    $net_income = $_POST['net_income'];
    $earnings_per_share = $_POST['earnings_per_share'];
    $sql = "INSERT INTO Financial(filing_quarter_id, revenue, rd_expense, net_income, earnings_per_share)
    VALUES ('$filing_quarter_id', '$revenue', '$rd_expense', '$net_income', '$earnings_per_share');";


    if (!empty($filing_quarter_id) || !empty($revenue) || !empty($rd_expense) || !empty($net_income) || !empty($earnings_per_share)) {

        //open a connection to dbase server 
        include 'open.php';

        if ($conn->query($sql)) {
            echo "Inserted Data Successfully!";
        } else {
            echo "ERROR: ".$sql."<br>".$conn->error;
        }

        $conn->close();

    // if one of the fields was empty
    } else {
        echo "All fields are required";
        die();
    }
