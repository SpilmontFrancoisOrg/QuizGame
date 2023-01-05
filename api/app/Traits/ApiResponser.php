<?php

namespace App\Traits;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
| This trait will be used for any response we sent to clients.
  Response code ->
    200: OK. The standard success code and default option.
    201: Object created. Useful for the store actions.
    204: No content. When an action was executed successfully, but there is no content to return.
    206: Partial content. Useful when you have to return a paginated list of resources.
    400: Bad request. The standard option for requests that fail to pass validation.
    401: Unauthorized. The user needs to be authenticated.
    403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    404: Not found. This will be returned automatically by Laravel when the resource is not found.
    409: Not created or updated.
         This will be returned automatically by Laravel when the resource is not created or updated.
    500: Internal server error.
         Ideally you're not going to be explicitly returning this, but if something unexpected breaks,
         this is what your user is going to receive.
    503: Service unavailable.
         Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
|--------------------------------------------------------------------------
*/

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait ApiResponser
{
    protected function success($data = [], $message = null, $code = 200): JsonResponse
    {
        $response = [
            'data' => $data,
            'meta' => [
                'success' => true,
                'message' => $message,
            ],
        ];

        return response()->json($response, $code);
    }

    protected function error($error = "Not Found", $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'data' => $code,
            'meta' => [
                'success' => false,
                'message' => $error,
            ]
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    protected function collectionPaginate(AnonymousResourceCollection $content, $message = null): JsonResponse
    {
        return $content->additional(
            [
                'meta' => [
                    'success' => true,
                    'message' => $message
                ]
            ]
        )->response()->setStatusCode(206);
    }

    protected function resourceCreated($data = null, $message = 'resource created with success.'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    protected function resourceUpdated($data = null, $message = 'resource updated with success.'): JsonResponse
    {
        return $this->success($data, $message);
    }


    protected function resourceDeleted(): JsonResponse
    {
        return $this->success(null, null, 204);
    }

    protected function resourceNotFound(): JsonResponse
    {
        return $this->error('Not Found', 'Resource not found');
    }

    protected function resourceNotCreated($errors): JsonResponse
    {
        return $this->error('Not Created', $errors, 409);
    }

    protected function resourceNotUpdated($errors): JsonResponse
    {
        return $this->error('Not Updated', $errors, 409);
    }
}
