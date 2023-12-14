<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test\Demo\DemoController;
use App\Http\Controllers\General\Uom\UomController;
use App\Http\Controllers\General\Bank\BankController;
use App\Http\Controllers\Stress\Stage\StageController;
use App\Http\Controllers\Geographical\Acz\AczController;
use App\Http\Controllers\Stress\Stress\StressController;
use App\Http\Controllers\Test\Example\ExampleController;
use App\Http\Controllers\Yields\Health\HealthController;
use App\Http\Controllers\General\Company\CompanyController;
use App\Http\Controllers\General\PoiType\PoiTypeController;
use App\Http\Controllers\Geographical\State\StateController;
use App\Http\Controllers\Regional\Terrain\TerrainController;
use App\Http\Controllers\Agriculture\Season\SeasonController;
use App\Http\Controllers\Commodity\HSNCode\HSNCodeController;
use App\Http\Controllers\Commodity\Variety\VarietyController;
use App\Http\Controllers\Geographical\Region\RegionController;
use App\Http\Controllers\Geographical\Tehsil\TehsilController;
use App\Http\Controllers\Zonal\Fertilizer\FertilizerController;
use App\Http\Controllers\Config\SyncConfig\SyncConfigController;
use App\Http\Controllers\Geographical\Country\CountryController;
use App\Http\Controllers\Geographical\Village\VillageController;
use App\Http\Controllers\Stress\DoseFactor\DoseFactorController;
use App\Http\Controllers\Stress\StressType\StressTypeController;
use App\Http\Controllers\Commodity\PlantPart\PlantPartController;
use App\Http\Controllers\General\BankBranch\BankBranchController;
use App\Http\Controllers\General\DropReason\DropReasonController;
use App\Http\Controllers\Geographical\District\DistrictController;
use App\Http\Controllers\Stress\StressStage\StressStageController;
use App\Http\Controllers\Agriculture\Ecosystem\EcosystemController;
use App\Http\Controllers\Zonal\VarietyZonal\VarietyZonalController;
use App\Http\Controllers\Geographical\Panchayat\PanchayatController;
use App\Http\Controllers\Phenophase\Phenophase\PhenophaseController;
use App\Http\Controllers\Yields\QualityChart\QualityChartController;
use App\Http\Controllers\Agriculture\SeedSource\SeedSourceController;
use App\Http\Controllers\Commodity\Commodity\CommodityController;
use App\Http\Controllers\General\BankCategory\BankCategoryController;
use App\Http\Controllers\Zonal\FieldActivity\FieldActivityController;
use App\Http\Controllers\Zonal\StressControl\StressControlController;
use App\Http\Controllers\Farmer\FarmerIdProof\FarmerIdProofController;
use App\Http\Controllers\Geographical\StateAlias\StateAliasController;
use App\Http\Controllers\Regional\BankRegional\BankRegionalController;
use App\Http\Controllers\Stress\SeedTreatment\SeedTreatmentController;
use App\Http\Controllers\General\CallingStatus\CallingStatusController;
use App\Http\Controllers\General\ModeOfPayment\ModeOfPaymentController;
use App\Http\Controllers\General\PackagingType\PackagingTypeController;
use App\Http\Controllers\General\TypeOfService\TypeOfServiceController;
use App\Http\Controllers\General\WeatherParams\WeatherParamsController;
use App\Http\Controllers\Zonal\StressDuration\StressDurationController;
use App\Http\Controllers\Zonal\VarietyQuality\VarietyQualityController;
use App\Http\Controllers\Zonal\ZonalCommodity\ZonalCommodityController;
use App\Http\Controllers\Farmer\LanguageFarmer\LanguageFarmerController;
use App\Http\Controllers\Geographical\TehsilAlias\TehsilAliasController;
use App\Http\Controllers\Stress\Recommendation\RecommendationController;
use App\Http\Controllers\Stress\StressSeverity\StressSeverityController;
use App\Http\Controllers\Farmer\EducationFarmer\EducationFarmerController;
use App\Http\Controllers\Farmer\FarmerVIPStatus\FarmerVIPStatusController;
use App\Http\Controllers\Geographical\VillageAlias\VillageAliasController;
use App\Http\Controllers\Regional\SeasonRegional\SeasonRegionalController;
use App\Http\Controllers\Regional\StressRegional\StressRegionalController;
use App\Http\Controllers\Stress\CommodityStress\CommodityStressController;
use App\Http\Controllers\Stress\ControlMeasures\ControlMeasuresController;
use App\Http\Controllers\Yields\HealthParameter\HealthParameterController;
use App\Http\Controllers\Agriculture\FarmMachinery\FarmMachineryController;
use App\Http\Controllers\Agriculture\SourceOfWater\SourceOfWaterController;
use App\Http\Controllers\Agrochemicals\Agrochemical\AgrochemicalController;
use App\Http\Controllers\Commodity\CommodityAlias\CommodityAliasController;
use App\Http\Controllers\Commodity\CommodityClass\CommodityClassController;
use App\Http\Controllers\Commodity\CommodityGroup\CommodityGroupController;
use App\Http\Controllers\Commodity\StateCommodity\StateCommodityController;
use App\Http\Controllers\Zonal\ConduciveWeather\ConduciveWeatherController;
use App\Http\Controllers\Zonal\PlantHealthIndex\PlantHealthIndexController;
use App\Http\Controllers\Farmer\FarmerLoanSource\FarmerLoanSourceController;
use App\Http\Controllers\Farmer\FarmerMobileType\FarmerMobileTypeController;
use App\Http\Controllers\Geographical\DistrictAlias\DistrictAliasController;
use App\Http\Controllers\Agriculture\AlliedActivity\AlliedActivityController;
use App\Http\Controllers\Agriculture\DisposalMethod\DisposalMethodController;
use App\Http\Controllers\Zonal\FavourableWeather\FavourableWeatherController;
use App\Http\Controllers\Farmer\FarmerLoanPurpose\FarmerLoanPurposeController;
use App\Http\Controllers\Farmer\FarmOwnershipType\FarmOwnershipTypeController;
use App\Http\Controllers\Regional\LanguageRegional\LanguageRegionalController;
use App\Http\Controllers\Yields\QuantityLossChart\QuantityLossChartController;
use App\Http\Controllers\Commodity\GeneralCommodity\GeneralCommodityController;
use App\Http\Controllers\Commodity\QualityParameter\QualityParameterController;
use App\Http\Controllers\Zonal\PhenophaseDuration\PhenophaseDurationController;
use App\Http\Controllers\Farmer\FarmerIncomeSource\FarmerIncomeSourceController;
use App\Http\Controllers\Regional\CommodityRegional\CommodityRegionalController;
use App\Http\Controllers\Regional\MonthlyTravelTime\MonthlyTravelTimeController;
use App\Http\Controllers\Regional\WeatherTravelTime\WeatherTravelTimeController;
use App\Http\Controllers\Agriculture\BenchmarkVariety\BenchmarkVarietyController;
use App\Http\Controllers\Agriculture\IrrigationMethod\IrrigationMethodController;
use App\Http\Controllers\Farmer\FarmerInsuranceType\FarmerInsuranceTypeController;
use App\Http\Controllers\Farmer\FarmerMaritalStatus\FarmerMaritalStatusController;
use App\Http\Controllers\Agrochemicals\AgrochemicalType\AgrochemicalTypeController;
use App\Http\Controllers\Commodity\CommodityPlantPart\CommodityPlantPartController;
use App\Http\Controllers\Farmer\FarmerGovtDepartment\FarmerGovtDepartmentController;
use App\Http\Controllers\Farmer\FarmerValidateStress\FarmerValidateStressController;
use App\Http\Controllers\Farmer\FarmerVIPDesignation\FarmerVIPDesignationController;
use App\Http\Controllers\Stress\CommodityStressStage\CommodityStressStageController;
use App\Http\Controllers\Agriculture\MeteorologicalWeek\MeteorologicalWeekController;
use App\Http\Controllers\Agrochemicals\AgrochemicalBrand\AgrochemicalBrandController;
use App\Http\Controllers\Zonal\StandardQuantityChart\StandardQuantityChartController;
use App\Http\Controllers\Farmer\FarmerEnrollmentPlace\FarmerEnrollmentPlaceController;
use App\Http\Controllers\Phenophase\CommodityPhenophase\CommodityPhenophaseController;
use App\Http\Controllers\Regional\RegionalConnectivity\RegionalConnectivityController;
use App\Http\Controllers\Stress\StressControlMeasures\StressControlMeasuresController;
use App\Http\Controllers\Farmer\FarmerInsuranceCompany\FarmerInsuranceCompanyController;
use App\Http\Controllers\Farmer\FarmerProxyRelationType\FarmerProxyRelationTypeController;
use App\Http\Controllers\Stress\AgrochemicalApplication\AgrochemicalApplicationController;
use App\Http\Controllers\Agriculture\AgricultureFertilizer\AgricultureFertilizerController;
use App\Http\Controllers\Zonal\CommodityCultivationCost\CommodityCultivationCostController;
use App\Http\Controllers\Stress\AgrochemicalInstructions\AgrochemicalInstructionsController;
use App\Http\Controllers\Agrochemicals\AgroCommoditychemical\AgroCommoditychemicalController;
use App\Http\Controllers\Commodity\QualityCommodityParameter\QualityCommodityParameterController;
use App\Http\Controllers\Farmer\FarmerGovtOfficialDesignation\FarmerGovtOfficialDesignationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
* php artisan make:module Farmer/LanguageFarmer --table='farmer_language' --title='Language Farmer' --include='R S C M Q L T G' --overwrite=''
*/

//php artisan make:module Agriculture/Band --table='agri_band' --title='Agriculture Band' --include='R S C M Q L T G' --overwrite=''


Route::get('/', function () {
    return inertia('Home');
});


/**
 * Commodity
 */
Route::resource('/commodity/commodity', CommodityController::class);
Route::get('/commodity/commodity/download/{file}', [CommodityController::class, 'download']);
Route::resource('/commodity/commodity-group', CommodityGroupController::class);
Route::resource('/commodity/commodity-class', CommodityClassController::class);
Route::get('/commodity/commodity-class/download/{file}', [CommodityClassController::class, 'download']);
Route::resource('/commodity/commodity-alias', CommodityAliasController::class);
Route::get('/commodity/commodity-alias/download/{file}', [CommodityAliasController::class, 'download']);
Route::resource('/commodity/commodity-plant-part', CommodityPlantPartController::class);
Route::get('/commodity/commodity-plant-part/download/{file}', [CommodityPlantPartController::class, 'download']);
Route::resource('/commodity/plant-part', PlantPartController::class);
Route::get('/commodity/plant-part/download/{file}', [PlantPartController::class, 'download']);
Route::resource('/commodity/general-commodity', GeneralCommodityController::class);
Route::get('/commodity/general-commodity/download/{file}', [GeneralCommodityController::class, 'download']);
Route::resource('/commodity/hsn-code', HSNCodeController::class);
Route::get('/commodity/hsn-code/download/{file}', [HSNCodeController::class, 'download']);
Route::resource('/commodity/quality-commodity-parameter', QualityCommodityParameterController::class);
Route::resource('/commodity/quality-parameter', QualityParameterController::class);
Route::resource('/commodity/state-commodity', StateCommodityController::class);
Route::resource('/commodity/variety', VarietyController::class);
Route::get('/commodity/variety/download/{file}', [VarietyController::class, 'download']);

/**
 * Farmer
 */
Route::resource('/farmer/education-farmer', EducationFarmerController::class);
Route::get('/farmer/education-farmer/download/{file}', [EducationFarmerController::class, 'download']);
Route::resource('/farmer/enrollment-place', FarmerEnrollmentPlaceController::class);
Route::get('/farmer/enrollment-place/download/{file}', [FarmerEnrollmentPlaceController::class, 'download']);
Route::resource('/farmer/farm-ownership-type', FarmOwnershipTypeController::class);
Route::get('/farmer/farm-ownership-type/download/{file}', [FarmOwnershipTypeController::class, 'download']);
Route::resource('/farmer/govt-department', FarmerGovtDepartmentController::class);
Route::get('/farmer/govt-department/download/{file}', [FarmerGovtDepartmentController::class, 'download']);
Route::resource('/farmer/id-proof', FarmerIdProofController::class);
Route::get('/farmer/id-proof/download/{file}', [FarmerIdProofController::class, 'download']);
Route::resource('/farmer/income-source', FarmerIncomeSourceController::class);
Route::get('/farmer/income-source/download/{file}', [FarmerIncomeSourceController::class, 'download']);
Route::resource('/farmer/insurance-company', FarmerInsuranceCompanyController::class);
Route::get('/farmer/insurance-company/download/{file}', [FarmerInsuranceCompanyController::class, 'download']);
Route::resource('/farmer/insurance-type', FarmerInsuranceTypeController::class);
Route::get('/farmer/insurance-type/download/{file}', [FarmerInsuranceTypeController::class, 'download']);
Route::resource('/farmer/language-farmer', LanguageFarmerController::class);
Route::get('/farmer/language-farmer/download/{file}', [LanguageFarmerController::class, 'download']);
Route::resource('/farmer/loan-purpose', FarmerLoanPurposeController::class);
Route::get('/farmer/loan-purpose/download/{file}', [FarmerLoanPurposeController::class, 'download']);
Route::resource('/farmer/loan-source', FarmerLoanSourceController::class);
Route::get('/farmer/loan-source/download/{file}', [FarmerLoanSourceController::class, 'download']);
Route::resource('/farmer/marital-status', FarmerMaritalStatusController::class);
Route::get('/farmer/marital-status/download/{file}', [FarmerMaritalStatusController::class, 'download']);
Route::resource('/farmer/mobile-type', FarmerMobileTypeController::class);
Route::get('/farmer/mobile-type/download/{file}', [FarmerMobileTypeController::class, 'download']);
Route::resource('/farmer/govt-official-designation', FarmerGovtOfficialDesignationController::class);
Route::get('/farmer/govt-official-designation/download/{file}', [FarmerGovtOfficialDesignationController::class, 'download']);
Route::resource('/farmer/proxy-relation-type', FarmerProxyRelationTypeController::class);
Route::get('/farmer/proxy-relation-type/download/{file}', [FarmerProxyRelationTypeController::class, 'download']);
Route::resource('/farmer/vip-designation', FarmerVIPDesignationController::class);
Route::get('/farmer/vip-designation/download/{file}', [FarmerVIPDesignationController::class, 'download']);
Route::resource('/farmer/vip-status', FarmerVIPStatusController::class);
Route::get('/farmer/vip-status/download/{file}', [FarmerVIPStatusController::class, 'download']);
Route::resource('/farmer/validate-stress', FarmerValidateStressController::class);
Route::get('/farmer/validate-stress/download/{file}', [FarmerValidateStressController::class, 'download']);

/**
 * Testing routes
 */
Route::resource('test/example', ExampleController::class);
Route::resource('test/demo', DemoController::class);
Route::get('/test/table-names', [ExampleController::class, 'tableNames']);
Route::get('/test/table-field-generator/{tableName?}', [ExampleController::class, 'tableFieldsGenerator', 'tableNames']);
Route::post('/test/generate-table-fields', [ExampleController::class, 'generateTableFields']);
Route::get('test/example/download/{file}', [ExampleController::class, 'download']);

/**
 * Agrochemical routes
 */
Route::resource('/agrochemicals/agrochemical-brand', AgrochemicalBrandController::class);
Route::get('/agrochemicals/agrochemical-brand/{file}', [AgrochemicalBrandController::class, 'download']);
Route::resource('/agrochemicals/agro-commodity-chemical', AgroCommoditychemicalController::class);
Route::resource('/agrochemicals/agrochemical-type', AgrochemicalTypeController::class);
Route::resource('/agrochemicals/agrochemical', AgrochemicalController::class);
/**
 * Configaration routes
 */
Route::resource('/config/sync-configaration', SyncConfigController::class);
/**
 * Geographical routes
 */
Route::resource('/geographical/country', CountryController::class);
Route::resource('/geographical/state', StateController::class);
Route::resource('/geographical/state-alias', StateAliasController::class);
Route::resource('/geographical/district', DistrictController::class);
Route::resource('/geographical/district-alias', DistrictAliasController::class);
Route::resource('/geographical/region', RegionController::class);
Route::resource('/geographical/tehsil', TehsilController::class);
Route::resource('/geographical/tehsil-alias', TehsilAliasController::class);
Route::resource('/geographical/panchayat', PanchayatController::class);
Route::resource('/geographical/village', VillageController::class);
Route::resource('/geographical/village-alias', VillageAliasController::class);
Route::resource('/geographical/acz', AczController::class);

/**
 * Zonal module routes
 */
Route::resource('/zonal/fertilizer', FertilizerController::class);
Route::resource('/zonal/zonal-commodity', ZonalCommodityController::class);
Route::resource('/zonal/commodity-cultivation-cost', CommodityCultivationCostController::class);
Route::resource('/zonal/conducive-weather', ConduciveWeatherController::class);
Route::resource('/zonal/field-activity', FieldActivityController::class);
Route::get('/zonal/zonal-commodity/list-stress/{id}', [ZonalCommodityController::class,'listStressByZonalCommodityAndStreeType']);
Route::get('/zonal/zonal-commodity/list-phenophase/{id}', [ZonalCommodityController::class,'listPhenophaseByZonalCommodity']);
Route::get('/zonal/zonal-commodity/list-agrochemical/{id}', [ZonalCommodityController::class,'listAgrochemicalByZonalCommodity']);
Route::get('/zonal/zonal-commodity/list-meteorological-week/{name}/{id}', [ZonalCommodityController::class,'listMeteorologicalWeekByZonalCommodity']);

Route::resource('/zonal/favourable-weather', FavourableWeatherController::class);
Route::resource('/zonal/variety-zonal', VarietyZonalController::class);
Route::get('/zonal/variety-zonal/list-variety/{id}', [VarietyZonalController::class,'listPhenophaseByZonalCommodity']);
Route::resource('/zonal/phenophase-duration', PhenophaseDurationController::class);
Route::resource('/zonal/plant-health-index', PlantHealthIndexController::class);
Route::resource('/zonal/standard-quantity-chart', StandardQuantityChartController::class);
Route::resource('/zonal/stress-control', StressControlController::class);
Route::resource('/zonal/stress-duration', StressDurationController::class);
Route::resource('/zonal/variety-quality', VarietyQualityController::class);
/**
 *
 * Agriculture module routes
 *
 */
Route::resource('/agriculture/allied-activity', AlliedActivityController::class);
Route::get('/agriculture/allied-activity/download/{file}', [AlliedActivityController::class, 'download']);
Route::resource('/agriculture/benchmark-variety', BenchmarkVarietyController::class);
Route::resource('/agriculture/disposal-method', DisposalMethodController::class);
Route::resource('/agriculture/ecosystem', EcosystemController::class);
Route::resource('/agriculture/farm-machinery', FarmMachineryController::class);
Route::post('agriculture/farm-machinery/import', [FarmMachineryController::class, 'import']);
Route::resource('/agriculture/irrigation-method', IrrigationMethodController::class);
Route::resource('/agriculture/season', SeasonController::class);
Route::resource('/agriculture/meteorological-week', MeteorologicalWeekController::class);
Route::resource('/agriculture/seed-source', SeedSourceController::class);
Route::resource('/agriculture/source-of-water', SourceOfWaterController::class);
Route::resource('/agriculture/agriculture-fertilizer', AgricultureFertilizerController::class);

Route::resource('/agriculture/band', AgricultureBandController::class);
/**
 * Phenophase module routes
 */
Route::resource('/phenophase/phenophase', PhenophaseController::class);
Route::get('/commodity/phenophase/download/{file}', [PhenophaseController::class, 'download']);

Route::resource('/phenophase/commodity-phenophase', CommodityPhenophaseController::class);
Route::get('/phenophase/commodity-phenophase/download/{file}', [CommodityPhenophaseController::class, 'download']);

/**
 * Stress module routes
 */
Route::resource('/stress/stress-type', StressTypeController::class);
Route::get('/stress/stress-type/download/{file}', [StressTypeController::class, 'download']);

Route::resource('/stress/stress', StressController::class);
Route::get('/stress/stress/download/{file}', [StressController::class, 'download']);

Route::resource('/stress/stage', StageController::class);

Route::resource('/stress/agrochemical-application', AgrochemicalApplicationController::class);
Route::get('/stress/agrochemical-application/download/{file}', [AgrochemicalApplicationController::class, 'download']);

Route::resource('/stress/stress-severity', StressSeverityController::class);
Route::get('/stress/stress-severity/download/{file}', [StressSeverityController::class, 'download']);

Route::resource('/stress/agrochemical-instructions', AgrochemicalInstructionsController::class);

Route::resource('/stress/commodity-stress', CommodityStressController::class);

Route::resource('/stress/control-measures', ControlMeasuresController::class);
Route::get('/stress/control-measures/download/{file}', [ControlMeasuresController::class, 'download']);

Route::resource('/stress/dose-factor', DoseFactorController::class);
Route::get('/stress/dose-factor/download/{file}', [DoseFactorController::class, 'download']);

Route::resource('/stress/recommendation', RecommendationController::class);
Route::get('/stress/recommendation/download/{file}', [RecommendationController::class, 'download']);

Route::resource('/stress/stress-stage', StressStageController::class);

Route::resource('/stress/stress-control-measures', StressControlMeasuresController::class);

Route::resource('/stress/seed-treatment', SeedTreatmentController::class);
Route::get('/stress/seed-treatment/download/{file}', [SeedTreatmentController::class, 'download']);

Route::resource('/stress/commodity-stress-stage', CommodityStressStageController::class);
Route::get('/stress/commodity-stress-stage/download/{file}', [CommodityStressStageController::class, 'download']);

/**
 * Yield module routes
 */
Route::resource('/yields/health-parameter', HealthParameterController::class);
Route::get('/yields/health-parameter/download/{file}', [HealthParameterController::class, 'download']);

Route::resource('/yields/health', HealthController::class);
Route::get('/yields/health/download/{file}', [HealthController::class, 'download']);

Route::resource('/yields/quality-chart', QualityChartController::class);
Route::get('/yields/quality-chart/download/{file}', [QualityChartController::class, 'download']);

Route::resource('/yields/quantity-loss-chart', QuantityLossChartController::class);
Route::get('/yields/quantity-loss-chart/download/{file}', [QuantityLossChartController::class, 'download']);

/**
 * General module routes
 */
Route::resource('/general/company', CompanyController::class);
Route::get('/general/company/download/{file}', [CompanyController::class, 'download']);

Route::resource('/general/bank-category', BankCategoryController::class);
Route::get('/general/bank-category/download/{file}', [BankCategoryController::class, 'download']);

Route::resource('/general/bank', BankController::class);
Route::get('/general/bank/download/{file}', [BankController::class, 'download']);

Route::resource('/general/uom', UomController::class);
Route::get('/general/uom/download/{file}', [UomController::class, 'download']);

Route::resource('/general/bank-branch', BankBranchController::class);
Route::get('/general/bank-branch/download/{file}', [BankBranchController::class, 'download']);

Route::resource('/general/calling-status', CallingStatusController::class);
Route::get('/general/calling-status/download/{file}', [CallingStatusController::class, 'download']);

Route::resource('/general/drop-reason', DropReasonController::class);
Route::get('/general/drop-reason/download/{file}', [DropReasonController::class, 'download']);

Route::resource('/general/mode-of-payment', ModeOfPaymentController::class);
Route::get('/general/mode-of-payment/download/{file}', [ModeOfPaymentController::class, 'download']);

Route::resource('/general/poi-type', PoiTypeController::class);
Route::get('/general/poi-type/download/{file}', [PoiTypeController::class, 'download']);

Route::resource('/general/packaging-type', PackagingTypeController::class);

Route::resource('/general/type-of-service', TypeOfServiceController::class);
Route::get('/general/type-of-service/download/{file}', [TypeOfServiceController::class, 'download']);

Route::resource('/general/weather-params', WeatherParamsController::class);
Route::get('/general/weather-params/download/{file}', [WeatherParamsController::class, 'download']);

/**
 * Regional module routes
 */
Route::resource('/regional/bank-regional', BankRegionalController::class);
Route::get('/regional/bank-regional/download/{file}', [BankRegionalController::class, 'download']);

Route::resource('/regional/commodity-regional', CommodityRegionalController::class);
Route::get('/regional/commodity-regional/download/{file}', [CommodityRegionalController::class, 'download']);

Route::resource('/regional/language-regional', LanguageRegionalController::class);
Route::get('/regional/language-regional/download/{file}', [LanguageRegionalController::class, 'download']);

Route::resource('/regional/monthly-travel-time', MonthlyTravelTimeController::class);
Route::resource('/regional/regional-connectivity', RegionalConnectivityController::class);
Route::resource('/regional/season-regional', SeasonRegionalController::class);
Route::resource('/regional/stress-regional', StressRegionalController::class);
Route::resource('/regional/terrain', TerrainController::class);
Route::resource('/regional/weather-travel-time', WeatherTravelTimeController::class);

Route::middleware(['table'])->group(function () {
    Route::post('test/example/import', [ExampleController::class, 'import']);
    // agrochemical
    Route::post('/agrochemicals/agrochemical-brand/import', [AgrochemicalBrandController::class, 'import']);
    //Agriculture
    Route::post('/agriculture/commodity/import', [CommodityController::class, 'import']);
    Route::post('/agriculture/commodity-phenophase/import', [CommodityPhenophaseController::class, 'import']);
    Route::post('/agriculture/source-of-water/import', [SourceOfWaterController::class, 'import']);
    Route::post('/agriculture/phenophase/import', [PhenophaseController::class, 'import']);
    Route::post('/agriculture/season/import', [SeasonController::class, 'import']);
    Route::post('/agriculture/seed-source/import', [SeedSourceController::class, 'import']);
    Route::post('/agriculture/farm-machinery/import', [FarmMachineryController::class, 'import']);
    Route::post('/agriculture/irrigation-method/import', [IrrigationMethodController::class, 'import']);
    Route::post('agriculture/commodity-phenophase/import', [CommodityPhenophaseController::class, 'import']);
    Route::post('agriculture/source-of-water/import', [SourceOfWaterController::class, 'import']);
    Route::post('agriculture/phenophase/import', [PhenophaseController::class, 'import']);
    Route::post('agriculture/season/import', [SeasonController::class, 'import']);
    Route::post('agriculture/seed-source/import', [SeedSourceController::class, 'import']);
    Route::post('agriculture/farm-machinery/import', [FarmMachineryController::class, 'import']);
    Route::post('agriculture/irrigation-method/import', [IrrigationMethodController::class, 'import']);
    Route::post('/agriculture/disposal-method/import', [DisposalMethodController::class, 'import']);
    Route::post('/agriculture/ecosystem/import', [EcosystemController::class, 'import']);
    Route::post('/agriculture/benchmark-variety/import', [BenchmarkVarietyController::class, 'import']);
    Route::post('/agriculture/allied-activity/import', [AlliedActivityController::class, 'import']);
    //Yeild
    Route::post('yields/health/import', [HealthController::class, 'import']);
    Route::post('yields/health-parameter/import', [HealthParameterController::class, 'import']);
    Route::post('yields/quality-chart/import', [QualityChartController::class, 'import']);
    Route::post('yields/quantity-loss-chart/import', [QuantityLossChartController::class, 'import']);
    //Phenophase
    Route::post('agriculture/phenophase/import', [PhenophaseController::class, 'import']);
    Route::post('agriculture/commodity-phenophase/import', [CommodityPhenophaseController::class, 'import']);
    // Commodity
    Route::post('/commodity/commodity-class/import', [CommodityClassController::class, 'import']);
    Route::post('/commodity/commodity/import', [CommodityController::class, 'import']);
    Route::post('/commodity/general-commodity/import', [GeneralCommodityController::class, 'import']);
    Route::post('/commodity/hsn-code/import', [HSNCodeController::class, 'import']);
    Route::post('/commodity/commodity-plant-part/import', [CommodityPlantPartController::class, 'import']);
    Route::post('/commodity/plant-part/import', [PlantPartController::class, 'import']);
    Route::post('/commodity/variety/import', [VarietyController::class, 'import']);
    // General
    Route::post('/general/company/import', [CompanyController::class, 'import']);
    Route::post('/general/bank-category/import', [BankCategoryController::class, 'import']);
    Route::post('/general/bank/import', [BankController::class, 'import']);
    Route::post('/general/uom/import', [UomController::class, 'import']);
    Route::post('/general/bank-branch/import', [BankBranchController::class, 'import']);
    Route::post('/general/calling-status/import', [CallingStatusController::class, 'import']);
    Route::post('/general/drop-reason/import', [DropReasonController::class, 'import']);
    Route::post('/general/mode-of-payment/import', [ModeOfPaymentController::class, 'import']);
    Route::post('/general/poi-type/import', [PoiTypeController::class, 'import']);
    Route::post('/general/type-of-service/import', [TypeOfServiceController::class, 'import']);
    Route::post('/general/weather-params/import', [WeatherParamsController::class, 'import']);
    //Regional
    Route::post('/regional/bank-regional/import', [BankRegionalController::class, 'import']);
    Route::post('/regional/language-regional/import', [LanguageRegionalController::class, 'import']);
    Route::post('/regional/commodity-regional/import', [CommodityRegionalController::class, 'import']);
    // Farmer
    Route::post('/farmer/education-farmer/import', [EducationFarmerController::class, 'import']);
    Route::post('/farmer/enrollment-place/import', [FarmerEnrollmentPlaceController::class, 'import']);
    Route::post('/farmer/farm-ownership-type/import', [FarmOwnershipTypeController::class, 'import']);
    Route::post('/farmer/govt-department/import', [FarmerGovtDepartmentController::class, 'import']);
    Route::resource('/farmer/id-proof', FarmerIdProofController::class);
    Route::post('/farmer/id-proof/import', [FarmerIdProofController::class, 'import']);
    Route::post('/farmer/income-source/import', [FarmerIncomeSourceController::class, 'import']);
    Route::post('/farmer/insurance-type/import', [FarmerInsuranceTypeController::class, 'import']);
    Route::post('/farmer/insurance-company/import', [FarmerInsuranceCompanyController::class, 'import']);
    Route::post('/farmer/loan-purpose/import', [FarmerLoanPurposeController::class, 'import']);
    Route::post('/farmer/loan-source/import', [FarmerLoanSourceController::class, 'import']);
    Route::post('/farmer/marital-status/import', [FarmerMaritalStatusController::class, 'import']);
    Route::post('/farmer/mobile-type/import', [FarmerMobileTypeController::class, 'import']);
    Route::post('/farmer/govt-official-designation/import', [FarmerGovtOfficialDesignationController::class, 'import']);
    Route::post('/farmer/proxy-relation-type/import', [FarmerProxyRelationTypeController::class, 'import']);
    Route::post('/farmer/vip-designation/import', [FarmerVIPDesignationController::class, 'import']);
    Route::post('/farmer/vip-status/import', [FarmerVIPStatusController::class, 'import']);
    Route::post('/farmer/validate-stress/import', [FarmerValidateStressController::class, 'import']);
    //Stress
    Route::post('/stress/seed-treatment/import', [SeedTreatmentController::class, 'import']);
    Route::post('/stress/recommendation/import', [RecommendationController::class, 'import']);
    Route::post('/stress/stress/import', [StressController::class, 'import']);

});
