<?php
if (function_exists('mb_list_encodings')) {
    echo "✅ mbstring est activé";
} else {
    echo "❌ mbstring n'est pas activé";
}
?>


echo '<pre>';
print_r($_SESSION);
echo '</pre>';
