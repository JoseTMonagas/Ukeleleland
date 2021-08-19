<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = new Categoria;
        $categoria->nombre = "Soprano";
        $categoria->slug = "soprano";
        $categoria->saveOrFail();

        $categoria = new Categoria;
        $categoria->nombre = "Concierto";
        $categoria->slug = "concierto";
        $categoria->saveOrFail();

        $categoria = new Categoria;
        $categoria->nombre = "Tenor";
        $categoria->slug = "tenor";
        $categoria->saveOrFail();

        $categoria = new Categoria;
        $categoria->nombre = "Baritono";
        $categoria->slug = "baritono";
        $categoria->saveOrFail();

        $categoria = new Categoria;
        $categoria->nombre = "Guitarlele";
        $categoria->slug = "guitarlele";
        $categoria->saveOrFail();
    }
}
