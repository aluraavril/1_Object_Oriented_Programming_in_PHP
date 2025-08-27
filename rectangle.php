<?php
class Rectangle
{
    public $width;
    public $length;

    public function __construct($width = 1, $length = 1)
    {
        $this->width = $width;
        $this->length = $length;
    }

    public function getArea()
    {
        return $this->width * $this->length;
    }

    public function getPerimeter()
    {
        return 2 * ($this->width + $this->length);
    }
}

$solveFor = $_POST['solveFor'] ?? 'area';

// ✅ Error handling: Default to 1 if empty
$width = isset($_POST['width']) && $_POST['width'] !== '' ? (float)$_POST['width'] : 1;
$length = isset($_POST['length']) && $_POST['length'] !== '' ? (float)$_POST['length'] : 1;

$rectangle = new Rectangle($width, $length);

$solutions = [];
$results = [];

if ($solveFor === 'area' || $solveFor === 'all') {
    $area = $rectangle->getArea();
    $solutions[] = "A = w &times; l = {$width} &times; {$length} = {$area}";
    $results[] = "<p><strong>Area:</strong> {$area}</p>";
}

if ($solveFor === 'perimeter' || $solveFor === 'all') {
    $perimeter = $rectangle->getPerimeter();
    $solutions[] = "P = 2 &times; (w + l) = 2 &times; ({$width} + {$length}) = 2 &times; " . ($width + $length) . " = {$perimeter}";
    $results[] = "<p><strong>Perimeter:</strong> {$perimeter}</p>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rectangle Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 40px;
            display: flex;
            gap: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 850px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="number"],
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #FFD700;
            color: #000;
            font-size: 16px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #e6c200;
        }

        .results {
            flex: 1;
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .results h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .equation {
            font-family: "Times New Roman", Times, serif;
            font-size: 18px;
            font-style: italic;
            display: block;
            margin: 6px 0;
        }

        .result-box p {
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: normal;
            margin: 6px 0;
        }

        .result-box strong {
            font-weight: bold;
        }

        .solution-box,
        .result-box {
            margin-top: 15px;
            padding: 15px;
            background: #fff8c6;
            border-left: 4px solid #FFD700;
        }

        .solution-box strong {
            display: block;
            margin-bottom: 10px;
        }

        label {
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <h1>Rectangle Calculator</h1>
            <form method="post">
                <label for="solveFor">Solve for:</label>
                <select id="solveFor" name="solveFor">
                    <option value="area" <?= $solveFor === 'area' ? 'selected' : '' ?>>Area</option>
                    <option value="perimeter" <?= $solveFor === 'perimeter' ? 'selected' : '' ?>>Perimeter</option>
                    <option value="all" <?= $solveFor === 'all' ? 'selected' : '' ?>>All</option>
                </select>

                <label for="width">Width:</label>
                <input type="number" id="width" name="width" placeholder="Default = 1" value="<?= htmlspecialchars($width) ?>" min="1">

                <label for="length">Length:</label>
                <input type="number" id="length" name="length" placeholder="Default = 1" value="<?= htmlspecialchars($length) ?>" min="1">

                <button type="submit">Calculate</button>
            </form>
        </div>
        <div class="results">
            <h2>Solution</h2>
            <div class="solution-box">
                <strong>Step-by-step:</strong>
                <?php foreach ($solutions as $step): ?>
                    <span class="equation"><?= $step ?></span>
                <?php endforeach; ?>
            </div>

            <br>

            <h2>Result</h2>
            <div class="result-box">
                <p><strong>Width (w):</strong> <?= $width ?></p>
                <p><strong>Length (l):</strong> <?= $length ?></p>
                <?= implode('', $results) ?>
            </div>
        </div>
    </div>
</body>

</html>