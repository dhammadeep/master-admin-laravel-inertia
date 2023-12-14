<template>
    <div class="menuList">
        <ul v-if="!menuListSts">
            <li class="text-center">Result not found</li>
        </ul>
        <ul v-else>
            <li
                v-for="(menus, index) of menuList"
                :key="index"
                :class="{ active: menus.status }"
            >
                <a href="#" @click="updateMenuList(menus.status, index)">
                    <div
                        class="d-flex align-items-center"
                        style="max-width: calc(100% - 20px)"
                    >
                        <span class="icons"></span>
                        <div class="menuName">
                            {{ menus.mainMenu }}
                        </div>
                    </div>
                    <span class="caretIcon">
                        <i class="fa-solid fa-caret-down"></i>
                    </span>
                </a>
                <slide-up-down v-model="menus.status" :duration="300">
                    <ul class="submenu">
                        <li v-for="submenus in menus.subMenu" :key="submenus">
                            <NavLink
                                :href="submenus.href"
                                :title="submenus.name"
                                :active="$page.url === submenus.href"
                            >
                                <div>
                                    {{ submenus.name }}
                                </div>
                            </NavLink>
                        </li>
                    </ul>
                </slide-up-down>
            </li>
        </ul>
    </div>
</template>

<script>
import SidebarLogo from "./SidebarLogo.vue";
import SearchMenu from "./SearchMenu.vue";
import NavLink from "./NavLink.vue";
import { storeSearch } from "../templateStore";
export default {
    components: {
        SidebarLogo,
        SearchMenu,
        NavLink,
    },
    component: String,
    setup() {
        // console.log(page);
    },
    data() {
        return {
            menuList: [
                {
                    mainMenu: "Test",
                    status: false,
                    subMenu: [
                        {
                            name: "Example 1",
                            href: "/test/example",
                            component: "Test/Test-Example/TestExample",
                        },
                        {
                            name: "Demo",
                            href: "/test/demo",
                            component: "Test/Demo/ListDemo",
                        },
                        {
                            name: "Generator",
                            href: "/test/table-field-generator",
                            component: "Test/Example/TableFieldGenerator",
                        },
                        {
                            name: "Login",
                            href: "/login",
                            component: "Auth/Login",
                        },
                    ],
                },
                {
                    mainMenu: "ACL",
                    status: false,
                    subMenu: [
                        {
                            name: "Manage Role",
                            href: "/acl/role/manage-role",
                            component: "Frontend/List",
                        },
                        {
                            name: "Resource Group",
                            href: "/acl/resource-group",
                            component: "Frontend/List",
                        },
                        {
                            name: "Resources",
                            href: "/acl/resource",
                            component: "Frontend/List",
                        },
                        {
                            name: "Rights Data",
                            href: "/manual-intervention/rights-data",
                            component: "Frontend/List",
                        },
                        {
                            name: "Role Restriction",
                            href: "/acl/role/restrict-role",
                            component: "Frontend/List",
                        },
                        {
                            name: "Roles",
                            href: "/acl/role",
                            component: "Frontend/List",
                        },
                        {
                            name: "Users",
                            href: "/acl/users",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Agriculture",
                    status: false,
                    subMenu: [
                        {
                            name: "Allied Activity",
                            href: "/agriculture/allied-activity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Benchmark Variety",
                            href: "/agriculture/benchmark-variety",
                            component: "Frontend/List",
                        },
                        {
                            name: "Disposal Method",
                            href: "/agriculture/disposal-method",
                            component: "Frontend/List",
                        },
                        {
                            name: "Ecosystem",
                            href: "/agriculture/ecosystem",
                            component: "Frontend/List",
                        },
                        {
                            name: "Farm Machinery",
                            href: "/agriculture/farm-machinery",
                            component: "Frontend/List",
                        },
                        {
                            name: "Irrigation Method",
                            href: "/agriculture/irrigation-method",
                            component: "Frontend/List",
                        },
                        {
                            name: "Meteorological Week",
                            href: "/agriculture/meteorological-week",
                            component: "Frontend/List",
                        },
                        {
                            name: "Season Agri",
                            href: "/agriculture/season",
                            component: "Frontend/List",
                        },
                        {
                            name: "Seed Source",
                            href: "/agriculture/seed-source",
                            component: "Frontend/List",
                        },
                        {
                            name: "Source Of Water",
                            href: "/agriculture/source-of-water",
                            component: "Frontend/List",
                        },
                        {
                            name: "Phenophase",
                            href: "/phenophase/phenophase",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commo Phenophase",
                            href: "/phenophase/commodity-phenophase",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Agrochemicals",
                    status: false,
                    subMenu: [
                        {
                            name: "Agrochemicals Brand",
                            href: "/agrochemicals/agrochemical-brand",
                            component: "Frontend/List",
                        },
                        {
                            name: "Agro Commodity Chemical",
                            href: "/agrochemicals/agro-commodity-chemical",
                            component: "Frontend/List",
                        },
                        {
                            name: "Agrochemical",
                            href: "/agrochemicals/agrochemical",
                            component: "Frontend/List",
                        },
                        {
                            name: "Agrochemical Type",
                            href: "/agrochemicals/agrochemical-type",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Commodity",
                    status: false,
                    subMenu: [
                        {
                            name: "Commodities",
                            href: "/commodity/commodity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Alias",
                            href: "/commodity/commodity-alias",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Class",
                            href: "/commodity/commodity-class",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Group",
                            href: "/commodity/commodity-group",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Plant Part",
                            href: "/commodity/commodity-plant-part",
                            component: "Frontend/List",
                        },
                        {
                            name: "General Commodity",
                            href: "/commodity/general-commodity",
                            component: "Frontend/List",
                        },
                        {
                            name: "HSN Code",
                            href: "/commodity/hsn-code",
                            component: "Frontend/List",
                        },
                        {
                            name: "Plant Part",
                            href: "/commodity/plant-part",
                            component: "Frontend/List",
                        },
                        {
                            name: "Quality Commodity Parameter",
                            href: "/commodity/quality-commodity-parameter",
                            component: "Frontend/List",
                        },
                        {
                            name: "Quality Parameter",
                            href: "/commodity/quality-parameter",
                            component: "Frontend/List",
                        },
                        {
                            name: "State Commodity",
                            href: "/commodity/state-commodity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Variety Commodity",
                            href: "/commodity/variety",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Config",
                    status: false,
                    subMenu: [
                        {
                            name: "Sync Config",
                            href: "/config/sync-configaration",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Crop Calendar",
                    status: false,
                    subMenu: [
                        {
                            name: "Crop Calendar",
                            href: "/cropcal/crop-calendar",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Cropdata Portal",
                    status: false,
                    subMenu: [
                        {
                            name: "Department",
                            href: "/cropdata-portal/department-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Buyer Pre-Application",
                            href: "/cropdata-portal/buyer-pre-application-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Contact Request",
                            href: "/cropdata-portal/contact-request",
                            component: "Frontend/List",
                        },
                        {
                            name: "Education",
                            href: "/cropdata-portal/education-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Holiday Calendar",
                            href: "/cropdata-portal/holiday-calendar",
                            component: "Frontend/List",
                        },
                        {
                            name: "Job Application",
                            href: "/cropdata-portal/job-application-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "News",
                            href: "/cropdata-portal/news",
                            component: "Frontend/List",
                        },
                        {
                            name: "Opportunities",
                            href: "/cropdata-portal/opportunities-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Partnership Request",
                            href: "/cropdata-portal/partnership-request-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Position",
                            href: "/cropdata-portal/position-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Report Requests",
                            href: "/cropdata-portal/report-download-request-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Report",
                            href: "/cropdata-portal/reports",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Data Entry",
                    status: false,
                    subMenu: [
                        {
                            name: "IMD",
                            href: "/data-entry/imd",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Farmer",
                    status: false,
                    subMenu: [
                        {
                            name: "Education Farmer",
                            href: "/farmer/education-farmer",
                            component: "Frontend/List",
                        },
                        {
                            name: "Enrollment Place",
                            href: "/farmer/enrollment-place",
                            component: "Frontend/List",
                        },
                        {
                            name: "Farm Ownership",
                            href: "/farmer/farm-ownership-type",
                            component: "Frontend/List",
                        },
                        {
                            name: "Govt Department",
                            href: "/farmer/govt-department",
                            component: "Frontend/List",
                        },
                        {
                            name: "Id Proof",
                            href: "/farmer/id-proof",
                            component: "Frontend/List",
                        },
                        {
                            name: "Income Source",
                            href: "/farmer/income-source",
                            component: "Frontend/List",
                        },
                        {
                            name: "Insurance Company",
                            href: "/farmer/insurance-company",
                            component: "Frontend/List",
                        },
                        {
                            name: "Insurance Type",
                            href: "/farmer/insurance-type",
                            component: "Frontend/List",
                        },
                        {
                            name: "Language Farmer",
                            href: "/farmer/language-farmer",
                            component: "Frontend/List",
                        },
                        {
                            name: "Loan Purpose",
                            href: "/farmer/loan-purpose",
                            component: "Frontend/List",
                        },
                        {
                            name: "Loan Source",
                            href: "/farmer/loan-source",
                            component: "Frontend/List",
                        },
                        {
                            name: "Marital Status",
                            href: "/farmer/marital-status",
                            component: "Frontend/List",
                        },
                        {
                            name: "Mobile Type",
                            href: "/farmer/mobile-type",
                            component: "Frontend/List",
                        },
                        {
                            name: "Official Designation",
                            href: "/farmer/govt-official-designation",
                            component: "Frontend/List",
                        },
                        {
                            name: "Proxy Relation Type",
                            href: "/farmer/proxy-relation-type",
                            component: "Frontend/List",
                        },
                        {
                            name: "VIP Designation",
                            href: "/farmer/vip-designation",
                            component: "Frontend/List",
                        },
                        {
                            name: "VIP Status",
                            href: "/farmer/vip-status",
                            component: "Frontend/List",
                        },
                        {
                            name: "Validate Stress",
                            href: "/farmer/validate-stress",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Flipbook",
                    status: false,
                    subMenu: [
                        {
                            name: "Flipbook",
                            href: "/flipbook/benchmark-tag",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "General",
                    status: false,
                    subMenu: [
                        {
                            name: "Bank Branch General",
                            href: "/general/bank-branch",
                            component: "Frontend/List",
                        },
                        {
                            name: "Bank Category General",
                            href: "/general/bank-category",
                            component: "Frontend/List",
                        },
                        {
                            name: "Bank General",
                            href: "/general/bank",
                            component: "Frontend/List",
                        },
                        {
                            name: "Calling Status",
                            href: "/general/calling-status",
                            component: "Frontend/List",
                        },
                        {
                            name: "Company",
                            href: "/general/company",
                            component: "Frontend/List",
                        },
                        {
                            name: "Drop Reason",
                            href: "/general/drop-reason",
                            component: "Frontend/List",
                        },
                        {
                            name: "Mode Of Payment",
                            href: "/general/mode-of-payment",
                            component: "Frontend/List",
                        },
                        {
                            name: "POI Type",
                            href: "/general/poi-type",
                            component: "Frontend/List",
                        },
                        {
                            name: "Packaging Type",
                            href: "/general/packaging-type",
                            component: "Frontend/List",
                        },
                        {
                            name: "Type Of Service",
                            href: "/general/type-of-service",
                            component: "Frontend/List",
                        },
                        {
                            name: "Uom",
                            href: "/general/uom",
                            component: "Frontend/List",
                        },
                        {
                            name: "Weather Params",
                            href: "/general/weather-params",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Geographical",
                    status: false,
                    subMenu: [
                        {
                            name: "Country",
                            href: "/geographical/country",
                            component: "Frontend/List",
                        },
                        {
                            name: "District",
                            href: "/geographical/district",
                            component: "Frontend/List",
                        },
                        {
                            name: "District Alias",
                            href: "/geographical/district-alias",
                            component: "Frontend/List",
                        },
                        {
                            name: "Panchayat",
                            href: "/geographical/panchayat",
                            component: "Frontend/List",
                        },
                        {
                            name: "Region",
                            href: "/geographical/region",
                            component: "Frontend/List",
                        },
                        {
                            name: "State",
                            href: "/geographical/state",
                            component: "Frontend/List",
                        },
                        {
                            name: "State Alias",
                            href: "/geographical/state-alias",
                            component: "Frontend/List",
                        },
                        {
                            name: "Tehsil",
                            href: "/geographical/tehsil",
                            component: "Frontend/List",
                        },
                        {
                            name: "Tehsil Alias",
                            href: "/geographical/tehsil-alias",
                            component: "Frontend/List",
                        },
                        {
                            name: "Village",
                            href: "/geographical/village",
                            component: "Frontend/List",
                        },
                        {
                            name: "Village Alias",
                            href: "/geographical/village-alias",
                            component: "Frontend/List",
                        },
                        {
                            name: "Acz",
                            href: "/geographical/acz",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "GSTM Eye",
                    status: false,
                    subMenu: [
                        {
                            name: "Parameters",
                            href: "/gstm-eye/parameters",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Logistic Hub",
                    status: false,
                    subMenu: [
                        {
                            name: "Approved Verification",
                            href: "/logistic-hub/lh-pv-approved-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Collected-LH",
                            href: "/logistic-hub/lh-collected-hub-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Doc Approved List",
                            href: "/logistic-hub/lh-doc-approved-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Document Listing",
                            href: "/logistic-hub/doc-listing",
                            component: "Frontend/List",
                        },
                        {
                            name: "LH Registration",
                            href: "/logistic-hub/lh-rejected-hub-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "LH-Employee",
                            href: "/logistic-hub/lh-employee-list",
                            component: "Frontend/List",
                        },
                        {
                            name: "Shortlisted KYC",
                            href: "/logistic-hub/lh-shortlisted-kyc",
                            component: "Frontend/List",
                        },
                        {
                            name: "Verification Listing",
                            href: "/logistic-hub/pv-images-listing",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Manage RL",
                    status: false,
                    subMenu: [
                        {
                            name: "Employees",
                            href: "/gstm-eye/parameters",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Models",
                    status: false,
                    subMenu: [
                        {
                            name: "Add-Model",
                            href: "/models/List",
                            component: "Frontend/List",
                        },
                        {
                            name: "Manage",
                            href: "/models/manage",
                            component: "Frontend/List",
                        },
                        {
                            name: "Panchayat Map",
                            href: "/models/panchayat-map-list",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Pricing",
                    status: false,
                    subMenu: [
                        {
                            name: "Buyer Constant",
                            href: "/pricing/buyer-constant",
                            component: "Frontend/List",
                        },
                        {
                            name: "Constants",
                            href: "/pricing/constant",
                            component: "Frontend/List",
                        },
                        {
                            name: "MBEP, PMP & Spread",
                            href: "/pricing/mbep-pmp",
                            component: "Frontend/List",
                        },
                        {
                            name: "MSP & MFP",
                            href: "/pricing/msp-mfp",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Region",
                    status: false,
                    subMenu: [
                        {
                            name: "APY Data",
                            href: "/region/apydata",
                            component: "Frontend/List",
                        },
                        {
                            name: "FLS Visits",
                            href: "/region/flsvisits",
                            component: "Frontend/List",
                        },
                        {
                            name: "Irrigation Data",
                            href: "/region/irrigation-visits",
                            component: "Frontend/List",
                        },
                        {
                            name: "LUC",
                            href: "/region/luc",
                            component: "Frontend/List",
                        },
                        {
                            name: "Land Holding Area",
                            href: "/region/landholdingarea",
                            component: "Frontend/List",
                        },
                        {
                            name: "Onboarding",
                            href: "/region/onboarding",
                            component: "Frontend/List",
                        },
                        {
                            name: "Selection",
                            href: "/region/selection",
                            component: "Frontend/List",
                        },
                        {
                            name: "Source Onboard",
                            href: "/region/sourceonboard",
                            component: "Frontend/List",
                        },
                        {
                            name: "Task Specification",
                            href: "/region/taskspecification",
                            component: "Frontend/List",
                        },
                        {
                            name: "Village Data",
                            href: "/region/villagedata",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Regional",
                    status: false,
                    subMenu: [
                        {
                            name: "Bank Regional",
                            href: "/regional/bank-regional",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Regional",
                            href: "/regional/commodity-regional",
                            component: "Frontend/List",
                        },
                        {
                            name: "Language Regional",
                            href: "/regional/language-regional",
                            component: "Frontend/List",
                        },
                        {
                            name: "Monthly Travel Time",
                            href: "/regional/monthly-travel-time",
                            component: "Frontend/List",
                        },
                        {
                            name: "Regional Connectivity",
                            href: "/regional/regional-connectivity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Season Regional",
                            href: "/regional/season-regional",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stress Regional",
                            href: "/regional/stress-regional",
                            component: "Frontend/List",
                        },
                        {
                            name: "Terrain",
                            href: "/regional/terrain",
                            component: "Frontend/List",
                        },
                        {
                            name: "Weather Travel Time",
                            href: "/regional/weather-travel-time",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Stress",
                    status: false,
                    subMenu: [
                        {
                            name: "Agrochemical App",
                            href: "/stress/agrochemical-application",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stress Severity",
                            href: "/stress/stress-severity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Variety Stress",
                            href: "/stress/variety-stress",
                            component: "Frontend/List",
                        },
                        {
                            name: "Agrochemical Instructions",
                            href: "/stress/agrochemical-instructions",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Stress",
                            href: "/stress/commodity-stress",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Stress Stage",
                            href: "/stress/commodity-stress-stage",
                            component: "Frontend/List",
                        },
                        {
                            name: "Control Measures",
                            href: "/stress/control-measures",
                            component: "Frontend/List",
                        },
                        {
                            name: "Dose Factor",
                            href: "/stress/dose-factor",
                            component: "Frontend/List",
                        },
                        {
                            name: "Recommendation",
                            href: "/stress/recommendation",
                            component: "Frontend/List",
                        },
                        {
                            name: "Seed Treatment",
                            href: "/stress/seed-treatment",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stage",
                            href: "/stress/stage",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stess",
                            href: "/stress/stress",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stress Control Measures",
                            href: "/stress/stress-control-measures",
                            component: "Frontend/List",
                        },
                        {
                            name: "StessStage",
                            href: "/stress/stress-stage",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stess Type",
                            href: "/stress/stress-type",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Tickers",
                    status: false,
                    subMenu: [
                        {
                            name: "Commodity Stress Tickers",
                            href: "/tickers/commodity-stress-tickers",
                            component: "Frontend/List",
                        },
                        {
                            name: "Market Price",
                            href: "/tickers/market-price",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Yield",
                    status: false,
                    subMenu: [
                        {
                            name: "Health",
                            href: "/yields/health",
                            component: "Frontend/List",
                        },
                        {
                            name: "Health Parameter",
                            href: "/yields/health-parameter",
                            component: "Frontend/List",
                        },
                        {
                            name: "Quality Chart",
                            href: "/yields/quality-chart",
                            component: "Frontend/List",
                        },
                        {
                            name: "Quality Loss Chart",
                            href: "/yields/quantity-loss-chart",
                            component: "Frontend/List",
                        },
                    ],
                },
                {
                    mainMenu: "Zonal",
                    status: false,
                    subMenu: [
                        {
                            name: "Fertilizer(RDF)",
                            href: "/zonal/fertilizer",
                            component: "Frontend/List",
                        },
                        {
                            name: "Field Activity",
                            href: "/zonal/field-activity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Cultivation Cost",
                            href: "/zonal/commodity-cultivation-cost",
                            component: "Frontend/List",
                        },
                        {
                            name: "Commodity Zonal",
                            href: "/zonal/zonal-commodity",
                            component: "Frontend/List",
                        },
                        {
                            name: "Conducive Weather",
                            href: "/zonal/conducive-weather",
                            component: "Frontend/List",
                        },
                        {
                            name: "Favourable Weather",
                            href: "/zonal/favourable-weather",
                            component: "Frontend/List",
                        },
                        {
                            name: "Other Variety",
                            href: "/zonal/other-variety",
                            component: "Frontend/List",
                        },
                        {
                            name: "Phenophase Duration",
                            href: "/zonal/phenophase-duration",
                            component: "Frontend/List",
                        },
                        {
                            name: "Plant Health Index",
                            href: "/zonal/plant-health-index",
                            component: "Frontend/List",
                        },
                        {
                            name: "Standard Qty Chart",
                            href: "/zonal/standard-quantity-chart",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stress Control",
                            href: "/zonal/stress-control",
                            component: "Frontend/List",
                        },
                        {
                            name: "Stess Duration",
                            href: "/zonal/stress-duration",
                            component: "Frontend/List",
                        },
                        {
                            name: "Variety Quality",
                            href: "/zonal/variety-quality",
                            component: "Frontend/List",
                        },
                        {
                            name: "Variety Zonal",
                            href: "/zonal/variety-zonal",
                            component: "Frontend/List",
                        },
                    ],
                },
            ],
            storeSearch,
            cloneMenuList: [],
            menuListSts: true,
        };
    },
    methods: {
        updateMenuList(sts, idx) {
            this.menuList.filter(function (element, index) {
                if (idx === index) {
                    element.status = true;
                    if (idx === index && element.status == sts) {
                        element.status = !element.status;
                    }
                } else {
                    element.status = false;
                }
            });
        },

        searchMenuList(txt) {
            if (txt != "" || txt != null || txt != undefined) {
                this.menuList = this.cloneMenuList;
                const filteredMenuList = this.menuList
                    .map((menu) => {
                        const filteredSubMenu = menu.subMenu.filter((sub) =>
                            sub.name.toLowerCase().includes(txt.toLowerCase())
                        );
                        return filteredSubMenu.length > 0
                            ? { ...menu, subMenu: filteredSubMenu }
                            : null;
                    })
                    .filter((menu) => menu);
                this.menuList = [];
                this.menuList = filteredMenuList;
                setTimeout(
                    () =>
                        this.menuList.length > 0
                            ? ((this.menuList[0].status = true),
                              (this.menuListSts = true))
                            : (this.menuListSts = false),
                    300
                );
            } else {
                this.menuList = this.cloneMenuList;
                this.menuListSts = true;
            }
        },
    },
    created() {
        let url = window.location.pathname;
        this.cloneMenuList = this.menuList;
        this.menuList.filter(function (element) {
            element.subMenu.filter(function (submenuUrl) {
                if (submenuUrl.href == url || url.includes(submenuUrl.href)) {
                    element.status = !element.status;
                    return;
                }
            });
        });
    },

    watch: {
        storeSearch: {
            handler(newValue) {
                this.searchMenuList(newValue.searchValue);
            },
            deep: true,
        },

        // menuListSts: {
        // 	handler(newValue) {
        // 		return newValue;
        // 	},
        // 	deep: true,
        // },
    },
};
</script>
