<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Auth & Access
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminUserSeeder::class,

            // 2. Structure
            DivisionSeeder::class,
            SectorSeeder::class,
            SectorTypeSeeder::class,

            // 3. Pricing & Options
            OptionCategorySeeder::class,
            OptionSeeder::class,
            PricingRuleSeeder::class,
            PricingCoefficientSeeder::class,

            // 4. Business & Simulation - Commented out to prevent fake admin data
            // LeadSeeder::class,
            // SimulationSeeder::class,
            // SimulationResultSeeder::class,
            // QuotationSeeder::class,
            // AppointmentSeeder::class,

            // 5. Config & System
            CurrencySeeder::class,
            ExchangeRateSeeder::class,
            AdminSettingSeeder::class,

            // 6. V4.0 & V5.0 Updates (Specific to AIAE Simulation Engine)
            ReferenceDataSeeder::class,
            TemplateSeeder::class,
            EquipementOptionSeeder::class,
        ]);
    }
}
