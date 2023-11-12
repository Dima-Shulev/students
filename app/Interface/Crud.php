<?php

namespace App\Interface;

interface Crud{
    public function index();
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($id);
    public function delete($id);
}
