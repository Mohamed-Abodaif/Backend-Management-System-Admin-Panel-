<?php

namespace App\Services\WorkSector\SystemConfigurationServices\DropdownList\CurrenciesOperations;


use App\Http\Requests\SystemConfigurationsRequests\Currencies\UpdatingCurrencyRequest;
use App\Services\WorkSector\SystemConfigurationServices\SystemConfigurationUpdatingService;

class CurrencyUpdatingService extends SystemConfigurationUpdatingService
{

    protected function getDefinitionUpdatingFailingErrorMessage(): string
    {
        return "Failed To Update The Given Currency !";
    }

    protected function getDefinitionUpdatingSuccessMessage(): string
    {
        return "The Currency Has Been Updated Successfully !";
    }

    protected function getRequestClass(): string
    {
        return UpdatingCurrencyRequest::class;
    }
}
