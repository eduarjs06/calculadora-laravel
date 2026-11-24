<?php
session_start();

$resultado = $_SESSION['resultado'] ?? null;
$error     = $_SESSION['error'] ?? null;
$numero1   = $_SESSION['numero1'] ?? '';
$numero2   = $_SESSION['numero2'] ?? '';
$operacion = $_SESSION['operacion'] ?? '';

// Se borran para que no se repitan al recargar la página
unset($_SESSION['resultado'], $_SESSION['error'],
      $_SESSION['numero1'], $_SESSION['numero2'], $_SESSION['operacion']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
</head>
<body>
    <h1>Calculadora web</h1>

    <form method="POST" action="procesar.php">
        <input type="text" name="numero1" value="<?= htmlspecialchars($numero1) ?>" placeholder="Número 1">

        <select name="operacion">
            <option value="sumar" <?= $operacion === 'sumar' ? 'selected' : '' ?>>Suma (+)</option>
            <option value="restar" <?= $operacion === 'restar' ? 'selected' : '' ?>>Resta (-)</option>
            <option value="multiplicar" <?= $operacion === 'multiplicar' ? 'selected' : '' ?>>Multiplicación (*)</option>
            <option value="dividir" <?= $operacion === 'dividir' ? 'selected' : '' ?>>División (/)</option>
        </select>

        <input type="text" name="numero2" value="<?= htmlspecialchars($numero2) ?>" placeholder="Número 2">

        <button type="submit">Calcular</button>
    </form>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($resultado !== null): ?>
        <h2>Resultado: <?= htmlspecialchars((string) $resultado) ?></h2>
    <?php endif; ?>
</body>
</html>