<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackfillRoleSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:backfill-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill slugs for existing roles that do not have one.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roles = \App\Models\Role::whereNull('slug')->get();

        if ($roles->isEmpty()) {
            $this->info('All roles already have slugs.');
            return;
        }

        $this->info(sprintf('Backfilling slugs for %d roles.', $roles->count()));

        $roles->each(function (\App\Models\Role $role) {
            do {
                $slug = \Illuminate\Support\Str::random(22);
            } while (\App\Models\Role::where('slug', $slug)->exists());

            $role->slug = $slug;
            $role->save();
            $this->line(sprintf('Generated slug for role: %s', $role->name));
        });

        $this->info('Finished backfilling slugs.');
    }
}
