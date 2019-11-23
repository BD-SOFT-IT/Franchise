<?php

use Illuminate\Database\Seeder;

class ApiAgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api_agents')->insert([
            'agent_creator_id'  => 1,
            'agent_api_key'     => 'eerGXVj0lEimbK2Y180827',
            'agent_api_secret'  => 'KFWptTLw6dYCNx2H',
            'agent_type'        => 'web',
            'agent_name'        => 'web_computer',
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now(),
        ]);

        DB::table('api_agents')->insert([
            'agent_creator_id'  => 1,
            'agent_api_key'     => 'X6J2J1bEANej6b2Hc1IKXI',
            'agent_api_secret'  => '4kcQlWD73mqBjWDb',
            'agent_type'        => 'web',
            'agent_name'        => 'web_mobile',
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now(),
        ]);

        DB::table('api_agents')->insert([
            'agent_creator_id'  => 1,
            'agent_api_key'     => '22Rc2WIfQ4JWWkhB180827',
            'agent_api_secret'  => 'xh0XogymroH69QNc',
            'agent_type'        => 'android',
            'agent_name'        => 'android',
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now(),
        ]);
    }
}
