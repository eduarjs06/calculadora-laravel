<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        $datos = $request->validate([
            'numero1'   => 'required|numeric',
            'numero2'   => 'required|numeric',
            'operacion' => 'required|in:sumar,restar,multiplicar,dividir',
        ]);

        $a = $datos['numero1'];
        $b = $datos['numero2'];

        if ($datos['operacion'] === 'dividir' && $b == 0) {
            return back()
                ->withErrors(['numero2' => 'No se puede dividir entre cero.'])
                ->withInput();
        }

        $resultado = match ($datos['operacion']) {
            'sumar'       => $a + $b,
            'restar'      => $a - $b,
            'multiplicar' => $a * $b,
            'dividir'     => $a / $b,
        };

        return back()->withInput()->with('resultado', $resultado);
    }
}