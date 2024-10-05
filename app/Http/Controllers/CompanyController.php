<?php

namespace App\Http\Controllers;

use App\Models\Company;
use http\Env\Response;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function getAll()
    {
        $companies = Company::all();
        if ($companies->count() > 0)
        {
            return response()->json($companies);
        } else
        {
            return response()->json(["message" => "No companies found."], 404);
        }
    }

    public function getById($id)
    {
        $company = Company::find($id);

        if ($company)
        {
            $result = [
                'message' => 'Company retrieved successfully.',
                'company' => $company
            ];
            return response()->json($result);
        } else
        {
            $result = [
                'message' => 'Company not found.',
                'company' => $company,
            ];
            return response()->json($result, 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:40',
            'description' => 'required|string|min:150|max:400',
            'logo' => 'nullable|image|mimes:png,jpg|max:3072',
        ]);
        $company = Company::create($validatedData);
        $result = [
            'message' => 'Company created successfully.',
            'company' => $company
        ];
        return response()->json($result);
    }

    public function update($id)
    {
        $company = Company::find($id);
        $validatedData = request()->validate([
            'name' => 'string|min:3|max:40',
            'description' => 'string|min:150|max:400',
            'logo' => 'nullable|image|mimes:png,jpg|max:3072'
        ]);

        if ($company)
        {
            $company->update($validatedData);
            $result = [
                'message' => 'Company updated successfully.',
                'company' => $company
            ];
            return response()->json($result);
        } else
        {
            return response()->json(["message" => "Company not found."], 404);
        }
    }
    public function destroy($id)
    {
        $company = Company::find($id);

        if ($company)
        {
            $company->delete();
            $result = [
                'message' => 'Company deleted successfully.',
                'company' => $company
            ];
            return response()->json($result);
        } else
        {
            return response()->json(["message" => "Company not found."], 404);
        }
    }

    public function getComments($id)
    {
        $company = Company::find($id);
        if ($company)
        {
            $comments = $company->comments()->get();
            if ($comments)
            {
                return response()->json($comments);
            } else
            {
                return response()->json(["message" => "No comments found."], 404);
            }
        } else
        {
            return response()->json(["message" => "Company not found."], 404);
        }
    }

    public function getRating($id)
    {
        $company = Company::find($id);
        if ($company)
        {
            $averageRating = $company->comments()->avg('rating');
            if ($averageRating)
            {
                return response()->json($averageRating);
            } else
            {
                return response()->json(["message" => "No comments found."], 404);
            }
        } else
        {
            return response()->json(["message" => "Company not found."], 404);
        }
    }

    public function getTop10()
    {
        return response()->json(
            Company::all()->map(fn($company) => ['company' => $company, 'averageRating' => $company
                ->comments()
                ->avg('rating')])
                ->sortByDesc('averageRating')
                ->take(10)
        );
    }
}
