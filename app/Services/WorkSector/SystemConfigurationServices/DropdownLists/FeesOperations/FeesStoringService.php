<?php

namespace App\Services\WorkSector\SystemConfigurationServices\DropdownList\FeesOperations;

use Exception;
use App\CustomLibs\ValidatorLib\Validator;

use App\Models\WorkSector\SystemConfigurationModels\Fees;
use App\Services\WorkSector\SystemConfigurationServices\SystemConfigurationStoringService;
use App\Services\WorkSector\SystemConfigurationsManagementServices\Interfaces\NeedToStoreDateFields;
use App\Services\WorkSector\SystemConfigurationsManagementServices\Interfaces\MustCreatedMultiplexed;

class FeesStoringService extends SystemConfigurationStoringService implements MustCreatedMultiplexed, NeedToStoreDateFields
{

    protected function getDefinitionCreatingFailingErrorMessage(): string
    {
        return "Failed To Create The Given Fees !";
    }

    protected function getDefinitionCreatingSuccessMessage(): string
    {
        return "The Fees Has Been Created Successfully !";
    }

    protected function getDefinitionModelClass(): string
    {
        return Fees::class;
    }

    protected function getRequestClass(): string
    {
        return StoringFeesRequest::class;
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
