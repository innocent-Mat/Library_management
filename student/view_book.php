<?php  
if (isset($_GET['pdf'])) {  
    $pdf_path = urldecode($_GET['pdf']);  
    // Ensure the file exists  
    if (file_exists($pdf_path)) {  
        // Display the PDF  
        header('Content-type: application/pdf');  
        header('Content-Disposition: inline; filename="' . basename($pdf_path) . '"');  
        readfile($pdf_path);  
        exit;  
    } else {  
        echo "File not found.";  
    }  
} else {  
    echo "No file specified.";  
}  
?>  