<?php
session_start();
require_once 'calculadora.php';

// Solo se acepta el envío del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$numero1   = trim($_POST['numero1'] ?? '');
$numero2   = trim($_POST['numero2'] ?? '');
$operacion = $_POST['operacion'] ?? '';

$operaciones_validas = ['sumar', 'restar', 'multiplicar', 'dividir'];

// Validaciones
if (!is_numeric($numero1) || !is_numeric($numero2)) {
    $_SESSION['error'] = 'Por favor escribe dos números válidos.';
} elseif (!in_array($operacion, $operaciones_validas, true)) {
    $_SESSION['error'] = 'Selecciona una operación válida.';
} else {
    $calculadora = new Calculadora();

    try {
        $resultado = $calculadora->$operacion((float) $numero1, (float) $numero2);
        $_SESSION['resultado'] = $resultado;
    } catch (InvalidArgumentException $e) {
        $_SESSION['error'] = $e->getMessage();
    } catch (Throwable $e) {
        $_SESSION['error'] = 'Ocurrió un error. Intenta de nuevo.';
    }
}

// Guardamos lo que escribió el usuario para no borrarlo
$_SESSION['numero1']   = $numero1;
$_SESSION['numero2']   = $numero2;
$_SESSION['operacion'] = $operacion;

header('Location: index.php');
exit;