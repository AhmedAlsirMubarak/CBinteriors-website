<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProcessStep;

class ProcessStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['step_number' => 1, 'title' => 'Consultation',       'description' => 'A detailed discussion to understand your needs, budget, and timeline.',                                    'sort_order' => 1],
            ['step_number' => 2, 'title' => 'Initial Design Draft','description' => 'Preliminary sketches and mood boards to align our visions.',                                              'sort_order' => 2],
            ['step_number' => 3, 'title' => 'Revisions',           'description' => 'Fine-tuning the design based on your feedback.',                                                          'sort_order' => 3],
            ['step_number' => 4, 'title' => 'Finalisation',        'description' => 'Complete architectural plans, 3D models, and material lists.',                                            'sort_order' => 4],
            ['step_number' => 5, 'title' => 'Implementation',      'description' => 'Overseeing construction, procurement, and installation.',                                                 'sort_order' => 5],
            ['step_number' => 6, 'title' => 'Handover',            'description' => 'A final walkthrough to ensure every detail meets your approval.',                                         'sort_order' => 6],
        ];

        foreach ($steps as $data) {
            ProcessStep::firstOrCreate(['step_number' => $data['step_number']], array_merge($data, ['active' => true]));
        }
    }
}
