<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Patient;
use Illuminate\Support\Str;

class GeneratePatientSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patients:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for patients that do not have one.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $patients = Patient::whereNull('slug')->orWhere('slug', '=', '')->get();

        if ($patients->isEmpty()) {
            $this->info('All patients already have slugs.');
            return 0;
        }

        $this->info('Generating slugs for ' . $patients->count() . ' patients.');

        foreach ($patients as $patient) {
            $patient->slug = Str::slug($patient->name . ' ' . $patient->lastname . '-' . uniqid());
            $patient->save();
            $this->info('Generated slug for patient: ' . $patient->name . ' ' . $patient->lastname);
        }

        $this->info('Finished generating slugs.');
        return 0;
    }
}
