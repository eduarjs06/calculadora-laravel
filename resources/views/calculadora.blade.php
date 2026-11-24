<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
</head>
<body>
    <h1>Calculadora web</h1>

    <form method="POST" action="/calculadora">
        @csrf

        <input type="text" name="numero1" value="{{ old('numero1') }}" placeholder="Número 1">

        <select name="operacion">
            <option value="sumar" @selected(old('operacion') == 'sumar')>+</option>
            <option value="restar" @selected(old('operacion') == 'restar')>-</option>
            <option value="multiplicar" @selected(old('operacion') == 'multiplicar')>*</option>
            <option value="dividir" @selected(old('operacion') == 'dividir')>/</option>
        </select>

        <input type="text" name="numero2" value="{{ old('numero2') }}" placeholder="Número 2">

        <button type="submit">Calcular</button>
    </form>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('resultado') !== null)
        <h2>Resultado: {{ session('resultado') }}</h2>
    @endif
</body>
</html>