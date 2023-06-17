<?php

namespace App\Services\UserManagementServices\UsersExportingServices\SignUpExportingServices;


use App\CustomLibs\ReportingAndBackupSystem\ExportersManagement\ExporterTypes\PDFExporter\PDFExporter;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;

class SignUpPDFExporter extends PDFExporter
{

    protected function getModelClass(): string
    {
        return User::class;
    }

    protected function getModelSelectingQueryColumns(): array|null
    {
        return null;
    }

    protected function getWithRelationshipsArray(): array
    {
        return ["profile"];
    }

    protected function getFiltersArray(): array
    {
        return [
            "created_at",
            "accepted_at",
            "status" ,
            AllowedFilter::callback('name', function (Builder $query, $value) {
                $query->where('first_name', 'LIKE', "%{$value}%")
                    ->orWhere('last_name', 'LIKE', "%{$value}%")
                    ->orWhere('mobile', 'LIKE', "%{$value}%")
                    ->orWhere('email', 'LIKE', "%{$value}%");
            })
        ];
    }

    protected function getDocumentTitle(): string
    {
        return "Sign Up Users";
    }

    protected function getModelDesiredFinalColumns(): array
    {
        return ["name" , "email" , "mobile"];
    }

    protected function getRelationshipsDesiredFinalColumns(): array
    {
        return [
            'role' => ["columns" => ["name"  ] ] ,
            "profile" => [
                "columns" => [
                    "gender" , "passport_number" , "national_id_number" ,
                    "country" => ["columns" => ["name" ]  ]
                ],
                "columns_prefix" => ""
            ],
            "department" => [
                "columns" => ["name"]
            ]
        ];
    }
}
