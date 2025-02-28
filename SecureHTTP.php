setcookie ('cookie_name', 'cookie_value', time() + 3600, '/', 'example.com', true, true );

session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        echo 'Form submitted successfully';
    } else {
        echo 'Invalid CSRF token';
    }
} else {
    echo '<form method="POST">
            <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
            <button type="submit">Submit</button>
          </form>';
}
