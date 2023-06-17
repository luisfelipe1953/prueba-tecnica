<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ApiResponser
{
    /**
     * Genera una respuesta de éxito.
     *
     * @param string $action La acción realizada.
     * @param mixed $value El valor asociado a la acción (opcional).
     * @return JsonResponse
     */
    public function successReponse(string $action, mixed $value = null): JsonResponse
    {
        $data = [
            'msg' => "Se ha {$action} satisfactoriamente.",
            ($value === null) ?: 'data' => $value,
        ];

        // Retorna una respuesta JSON con código de estado HTTP 200 (OK).
        return response()->json(array_filter($data), Response::HTTP_OK);
    }

    /**
     * Genera una respuesta de error para modelos.
     *
     * @param string $message El mensaje de error.
     * @param string $type El tipo de modelo que no existe.
     * @return JsonResponse
     */
    public function ModelErrorResponse(string $message, string $type): JsonResponse
    {
        // Registra el error en los logs.
        Log::error('Ocurrió un error: ' . $message);

        // Retorna una respuesta JSON con un mensaje de error específico.
        return response()->json([
            'error' => "El {$type} no existe, vuelve a intentarlo"
        ], response::HTTP_NOT_FOUND );
    }

    /**
     * Genera una respuesta de error genérica.
     *
     * @param string $message El mensaje de error.
     * @return JsonResponse
     */
    public function errorResponse(string $message): JsonResponse
    {
        // Registra el error en los logs.
        Log::error('Ocurrió un error: ' . $message);

        // Retorna una respuesta JSON con un mensaje de error genérico y código de estado HTTP 500 (Internal Server Error).
        return response()->json([
            'error' => 'Problema inesperado al procesar la solicitud.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
