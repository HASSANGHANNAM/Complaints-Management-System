<?php

namespace Database\Seeders;

use App\Repositories\Contracts\GovernmentAgencyEmploymentTypeRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernmentAgencyEmploymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function __construct(
        private GovernmentAgencyEmploymentTypeRepositoryInterface $governmentAgencyEmploymentTypeRepo,
    ) {}

    public function run(): void
    {
        $employment_types = [
            [
                'NameAr' => 'موظف دائم',
                'NameEn' => 'Permanent Employee',
            ],
            [
                'NameAr' => 'موظف مؤقت',
                'NameEn' => 'Temporary Employee',
            ],
            [
                'NameAr' => 'متعاقد',
                'NameEn' => 'Contractor',
            ],
            [
                'NameAr' => 'مدير',
                'NameEn' => 'Manager',
            ],
            [
                'NameAr' => 'رئيس قسم',
                'NameEn' => 'Department Head',
            ],
        ];

        DB::transaction(function () use ($employment_types) {
            foreach ($employment_types as $type) {
                $this->governmentAgencyEmploymentTypeRepo->create($type);
            }
        });
    }
}

