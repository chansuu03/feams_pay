<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class StudentTest extends BaseCommand
{
    protected $group       = 'databases';
    protected $name        = 'quiel';
    protected $description = 'Seed all seeders';

    public function run(array $params)
    {
      echo command('migrate:rollback');
      echo command('migrate');
      echo command('db:seed UserSeeder');
      echo command('db:seed PermissionSeeder');
      echo command('db:seed RolePermissionSeeder');
      echo command('db:seed RoleSeeder');
      echo command('db:seed DictSeeder');
    }
}