<?php

// Sanitation
function validateFormData($formData) {
    $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')' ), '', $formData ) ), ENT_QUOTES ) ) );
    return $formData;
}

//New User Sanitation
function validateNUFormData($NUformData) {
    $NUformData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')' ), '', $NUformData ) ), ENT_QUOTES ) ) );
    return $NUformData;
}




 ?>
