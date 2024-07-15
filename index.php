<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enkripsi dan Dekripsi Sederhana</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .form-container {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .result-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Enkripsi - Dekripsi Pesanmu!</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="message">Pesan:</label>
                    <input type="text" id="message" name="message" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="action">Aksi:</label>
                    <select id="action" name="action" class="form-control">
                        <option value="encrypt">Enkripsi</option>
                        <option value="decrypt">Dekripsi</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom">Proses</button>
            </form>

            <?php
            function enkripsi($data) {
                $shift = 3; // Nilai geser untuk enkripsi
                $result = '';

                for ($i = 0; $i < strlen($data); $i++) {
                    $char = ord($data[$i]);

                    if ($char >= ord('a') && $char <= ord('z')) {
                        $result .= chr((($char - ord('a') + $shift) % 26) + ord('a'));
                    } elseif ($char >= ord('A') && $char <= ord('Z')) {
                        $result .= chr((($char - ord('A') + $shift) % 26) + ord('A'));
                    } else {
                        $result .= $data[$i];
                    }
                }

                return $result;
            }

            function dekripsi($data) {
                $shift = 3; // Nilai geser untuk dekripsi
                $result = '';

                for ($i = 0; $i < strlen($data); $i++) {
                    $char = ord($data[$i]);

                    if ($char >= ord('a') && $char <= ord('z')) {
                        $result .= chr((($char - ord('a') - $shift + 26) % 26) + ord('a'));
                    } elseif ($char >= ord('A') && $char <= ord('Z')) {
                        $result .= chr((($char - ord('A') - $shift + 26) % 26) + ord('A'));
                    } else {
                        $result .= $data[$i];
                    }
                }

                return $result;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $message = $_POST['message'];
                $action = $_POST['action'];

                if ($action === 'encrypt') {
                    $result = enkripsi($message);
                    echo "<div class='result-container'><h4>Hasil Enkripsi:</h4><p>" . htmlspecialchars($result) . "</p></div>";
                } elseif ($action === 'decrypt') {
                    $result = dekripsi($message);
                    echo "<div class='result-container'><h4>Hasil Dekripsi:</h4><p>" . htmlspecialchars($result) . "</p></div>";
                } else {
                    echo "<div class='result-container'><p>Aksi tidak valid!</p></div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
