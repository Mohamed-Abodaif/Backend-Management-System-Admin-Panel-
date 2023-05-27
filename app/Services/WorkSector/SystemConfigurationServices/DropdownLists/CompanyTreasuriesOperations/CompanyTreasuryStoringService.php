<?php

namespace App\Services\WorkSector\SystemConfigurationServices\DropdownList\CompanyTreasuriesOperations;

use Exception;
use App\CustomLibs\ValidatorLib\Validator;
use App\Models\WorkSector\SystemConfigurationModels\CompanyTreasury;
use App\Services\WorkSector\SystemConfigurationServices\SystemConfigurationStoringService;
use App\Http\Requests\SystemConfigurationsRequests\CompanyTreasurys\StoringCompanyTreasuryRequest;
use App\Services\WorkSector\SystemConfigurationsManagementServices\Interfaces\NeedToStoreDateFields;
use App\Services\WorkSector\SystemConfigurationsManagementServices\Interfaces\MustCreatedMultiplexed;

class CompanyTreasuryStoringService extends SystemConfigurationStoringService implements MustCreatedMultiplexed, NeedToStoreDateFields
{

    protected function getDefinitionCreatingFailingErrorMessage(): string
    {
        return "Failed To Create The Given CompanyTreasury !";
    }

    protected function getDefinitionCreatingSuccessMessage(): string
    {
        return "The CompanyTreasury Has Been Created Successfully !";
    }

    protected function getDefinitionModelClass(): string
    {
        return CompanyTreasury::class;
    }

    protected function getRequestClass(): string
    {
        return StoringCompanyTreasuryRequest::class;
    }

    //There Is No Key Will Be Used If IsItMultipleCreation returns false
    //Because Model itself will determine the fillable values from request main data array
    public function getRequestDataKey(): string
    {
        return "items";
    }

    protected function getFillableColumns(): array
    {
        return ["name", "status"];
    }

    public function getDateFieldNames(): array
    {
        return ["created_at", "updated_at"];
    }
    public function setRequestGeneralValidationRules(): Validator
    {
        return $this->validator->ExceptRules(["name"]);
    }

    /**
     * @return Validator
     * @throws Exception
     */
    public function setSingleRowValidationRules(): Validator
    {
        return $this->validator->OnlyRules(["name"]);
    }
}