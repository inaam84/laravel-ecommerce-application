<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    use FlashMessages;

    protected $data = null;

    protected function setPageTitle($title, $subTitle)
    {
        return view()->share([
            'pageTitle' => $title,
            'subTitle' => $subTitle,
        ]);
    }

    protected function showErrorPage($errorCode = Response::HTTP_NOT_FOUND, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    protected function responseJson($error = true, $responseCode = Response::HTTP_OK, $message = [], $data = null)
    {
        return response()->json([
            'error' => $error,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        $this->setFlashMessages($message, $type);
        $this->showFlashMessages();

        if($error && $withOldInputWhenError)
        {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    protected function responseRedirectBack($message, $type)
    {
        $this->setFlashMessages($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }
}
