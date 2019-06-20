<?php

namespace App\Services\Admin;

use App\Models\Admin\CompanyModel;
use App\User;

class CompanyService
{
    public function getCompaniesCollection()
    {
        return CompanyModel::all();
    }

    public function getCompanies()
    {
        return CompanyModel::all()->toArray();
    }

    public function createCompany(array $data, User $user)
    {
        $data['owner_id'] = $user->getId();
        $company = new CompanyModel($data);
        return $company->save();
    }

    public function getCompaniesSelector()
    {
        $companies = $this->getCompaniesCollection();
        $companySelector = [];
        foreach ($companies as $company) {
            $companySelector[$company->id] = $company->name;
        }

        return $companySelector;
    }
}