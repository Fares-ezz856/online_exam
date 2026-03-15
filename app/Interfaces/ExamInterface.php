<?php
namespace App\Interfaces;
interface ExamInterface{
    public function all();
    public function create(array $data);

    public function delete($id);
}
