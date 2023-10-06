<?php

namespace App\Http\Controllers;

use App\Contracts\Service\CompanyServiceInterface;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyServiceInterface $companyService
    ) {
    }

    public function index(): JsonResource
    {
        $companies = $this->companyService->findByUser(Auth::user());

        return CompanyResource::collection($companies);
    }

    public function create(Request $request): JsonResponse
    {
        // NOTE: Better to use CompanyRequest so we can move all validation there, but this is not supported by Lumen
        // @see https://lumen.laravel.com/docs/master/validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'phone' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect($request->path())
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $company = $this->companyService->create(Auth::user(), $validated);

        return response()->json($company, 201);
    }
}
