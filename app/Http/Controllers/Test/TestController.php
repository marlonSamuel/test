<?php

namespace App\Http\Controllers\Test;

use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TestController extends ApiController
{
    /**
     *lista de tabla Test
     */
    public function index()
    {
        $tests = Test::all();
        return $this->showAll($tests);

    }

    /**
     * Guardar registro
     */
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required',
            'email' => 'required|string|email|unique:tests',
            'fecha_nac' => 'required',
            'genero' => 'required'
        ];
        $this->validate($request, $reglas);

        $data = $request->all();
        $test = Test::create($data);

        return $this->showOne($test,201);
    }

    /**
     * Mostrar un registro
     */
    public function show(Test $test)
    {
        return $this->showOne($test);
    }

    /**
     * Actualiza un registro
     */
    public function update(Request $request, Test $test)
    {
        $reglas = [
            'email' => 'required|string|unique:tests,email,' . $test->id,
            'nombre' => 'required',
            'fecha_nac' => 'required|date',
            'genero' => 'required'
        ];

        $this->validate($request, $reglas);

        $test->nombre = $request->nombre;
        $test->email = $request->email;
        $test->fecha_nac = $request->fecha_nac;
        $test->genero = $request->genero;

        if (!$test->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $test->save();
        return $this->showOne($test,201);
    }

    /**
     * Eliminar registro de manera logica
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return $this->showMessage($test);
    }
}
