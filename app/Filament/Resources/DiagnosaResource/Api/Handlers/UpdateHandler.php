<?php
namespace App\Filament\Resources\DiagnosaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\DiagnosaResource;
use App\Filament\Resources\DiagnosaResource\Api\Requests\UpdateDiagnosaRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = DiagnosaResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Diagnosa
     *
     * @param UpdateDiagnosaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateDiagnosaRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}