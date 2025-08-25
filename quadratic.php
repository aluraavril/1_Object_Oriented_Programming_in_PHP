<?php
class QuadraticEquation
{
    private $a;
    private $b;
    private $c;

    public function __construct($a = 1, $b = 0, $c = 0)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getA()
    {
        return $this->a;
    }
    public function getB()
    {
        return $this->b;
    }
    public function getC()
    {
        return $this->c;
    }

    public function getDiscriminant()
    {
        return $this->b * $this->b - 4 * $this->a * $this->c;
    }

    public function getRoot1()
    {
        $d = $this->getDiscriminant();
        if ($d < 0) return null;
        return (-$this->b + sqrt($d)) / (2 * $this->a);
    }

    public function getRoot2()
    {
        $d = $this->getDiscriminant();
        if ($d < 0) return null;
        return (-$this->b - sqrt($d)) / (2 * $this->a);
    }
}

// Handle user input
$a = $_POST['a'] ?? 1;
$b = $_POST['b'] ?? 0;
$c = $_POST['c'] ?? 0;

$eq = new QuadraticEquation($a, $b, $c);
$discriminant = $eq->getDiscriminant();

$solutions = [];
$results = [];

// Steps with LaTeX formatting
$solutions[] = "<span class='equation'>Discriminant: <br>\\(D = b^2 - 4ac = {$b}^2 - 4({$a})({$c}) = {$discriminant}\\)</span>";

if ($discriminant < 0) {
    $results[] = "<p><strong>No real roots</strong></p>";
} else {
    $root1 = $eq->getRoot1();
    $root2 = $eq->getRoot2();
    $solutions[] = "<span class='equation'>First root: <br>\\(x_1 = \\frac{-b + \\sqrt{D}}{2a} = \\frac{-{$b} + \\sqrt{{$discriminant}}}{2({$a})} = {$root1}\\)</span>";
    $solutions[] = "<span class='equation'>Second root: <br>\\(x_2 = \\frac{-b - \\sqrt{D}}{2a} = \\frac{-{$b} - \\sqrt{{$discriminant}}}{2({$a})} = {$root2}\\)</span>";

    $results[] = "<p><strong>Root 1:</strong> {$root1}</p>";
    $results[] = "<p><strong>Root 2:</strong> {$root2}</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quadratic Equation Solver</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
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
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
        }

        input[type="number"] {
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

        .results p {
            margin: 8px 0;
            font-size: 14px;
        }

        .solution-box,
        .result-box {
            margin-top: 15px;
            padding: 15px;
            background: #fff8c6;
            border-left: 4px solid #FFD700;
        }

        /* Equation style */
        .equation {
            font-family: "Times New Roman", Times, serif;
            font-size: 18px;
            font-style: italic;
            display: block;
            margin: 6px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <h1>Quadratic Equation Solver</h1>
            <form method="post">
                <label for="a">a:</label>
                <input type="number" step="any" id="a" name="a" placeholder="1" value="<?= htmlspecialchars($a) ?>">

                <label for="b">b:</label>
                <input type="number" step="any" id="b" name="b" placeholder="0" value="<?= htmlspecialchars($b) ?>">

                <label for="c">c:</label>
                <input type="number" step="any" id="c" name="c" placeholder="0" value="<?= htmlspecialchars($c) ?>">

                <button type="submit">Solve</button>
            </form>
        </div>
        <div class="results">
            <h2>Solution</h2>
            <div class="solution-box">
                <strong>Step-by-step:</strong><br><br>
                <?= implode('<br>', $solutions) ?>
            </div>
            <br>
            <h2>Result</h2>
            <div class="result-box">
                <p><strong>a:</strong> <?= $a ?></p>
                <p><strong>b:</strong> <?= $b ?></p>
                <p><strong>c:</strong> <?= $c ?></p>
                <?= implode('', $results) ?>
            </div>
        </div>
    </div>
</body>

</html>