<?php

namespace App\Services\WorkSector\SystemConfigurationServices\DropdownLists\ServiceCategoriesOperations;

use Exception;
use App\CustomLibs\ValidatorLib\Validator;
use App\Http\Requests\WorkSector\SystemConfigurations\ServiceCategory\StoringServiceCategoryRequest;
use App\Services\WorkSector\Interfaces\NeedToStoreDateFields;
use App\Services\WorkSector\Interfaces\MustCreatedMultiplexed;
use App\Models\WorkSector\SystemConfigurationModels\ServiceCategory;
use App\Services\WorkSector\SystemConfigurationServices\SystemConfigurationStoringService;

class ServiceCategoryStoringService extends SystemConfigurationStoringService implements MustCreatedMultiplexed, NeedToStoreDateFields
{

    protected function getDefinitionCreatingFailingErrorMessage(): string
    {
        return "Failed To Create The Given Service Category!";
    }

    protected function getDefinitionCreatingSuccessMessage(): string
    {
        return "The ServiceCategory Has Been Created Successfully!";
    }

    protected function getDefinitionModelClass(): string
    {
        return ServiceCategory::class;
    }

    protected function getRequestClass(): string
    {
        return StoringServiceCategoryRequest::class;
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
