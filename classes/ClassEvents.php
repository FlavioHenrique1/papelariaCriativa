<?php
namespace Classes;
use Models\ClassCalendario;

class ClassEvents extends ClassCalendario{
    #validação final da consulta do calendario
    public function validateFinCalend($id=null){
        $b=$this->getEvents($id);
        return $b;
    }

    #validação finaldo do insert calendario
    public function validateFinInsert($arrEvents){
        $b=$this->insertCale($arrEvents);
        
    }

    #validação finaldo do insert calendario
    public function validateFinEdit($arrEvents){
        $b=$this->editCale($arrEvents);
        
    }


}