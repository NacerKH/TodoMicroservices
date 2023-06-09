<?php


namespace App\Modules;


interface BaseApiRepositoryInterface
{
    public function index();

    public function store($form_data);

    public function show($resource_id);

    public function update($resource_id, $form_data);

    public function delete($resource_id);
}
