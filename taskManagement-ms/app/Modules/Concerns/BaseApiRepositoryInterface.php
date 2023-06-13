<?php


namespace App\Modules\Concerns;


interface BaseApiRepositoryInterface
{
    public function index();

    public function create(array $form_data);

    public function show($resource_id);

    public function update($resource_id, array $form_data);

    public function delete($resource_id);
}
