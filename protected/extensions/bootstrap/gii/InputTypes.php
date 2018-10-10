<?php
class InputTypes {
    const primary=0;
    const editor=1;
    const textArea=2;
  //const datePicker=3;
    const boolean=4;
    const image=5;
    const file=6;
    const imageAjax=7;
    const fileAjax=8;
    const checkBoxGroup=9;
    const dropDownList=10;
    const dateBox=11;
    const dateTimeBox=12;
    const textBox=13;
    const oneToManyR=14;
    const manyToManyR=15;
    const radioButtonGroup=16;
    const gallery=17;
    const password=18; // not supported yet
    const slug=19; // not supported yet
    const slugColumn=20; // not supported yet
    const dropDownAsArray=21;

    public static function checkColumnType($column){
        $comment = mb_strtolower($column->comment);
        if(stripos($column->dbType,'int') !== false && $column->autoIncrement && $column->isPrimaryKey){
            return InputTypes::primary;
        }
        elseif(stripos($column->dbType,'tinyint') !== false){
            return InputTypes::boolean;
        }
        elseif($column->name=='slug'){
            return InputTypes::slugColumn;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/image upload/', $comment)) {
            return InputTypes::image;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/ajax image upload/',$comment)){
            return InputTypes::imageAjax;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/file upload/',$comment)){
            return InputTypes::file;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/ajax file upload/',$comment)){
            return InputTypes::fileAjax;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/radio:/', $comment)){
            return InputTypes::radioButtonGroup;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/check:/', $comment)){
            return InputTypes::checkBoxGroup;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/dropdown:/', $comment)){
            return InputTypes::dropDownList;
        }
        elseif(stripos($column->dbType,'int') !== false && preg_match('/dropdown:/', $comment)){
            return InputTypes::dropDownAsArray;
        }
        elseif(stripos($column->dbType,'int') !== false && preg_match('/r1:/', $comment)){
            return InputTypes::oneToManyR;
        }
        elseif(stripos($column->dbType,'text') !== false && preg_match('/r2:/', $comment)){
            return InputTypes::manyToManyR;
        }
        elseif(stripos($column->dbType,'text') !== false && preg_match('/editor/',$comment)){
            return InputTypes::editor;
        }
        elseif(stripos($column->dbType,'varchar') !== false && preg_match('/slug/',$comment)){
            return InputTypes::slug;
        }
        elseif(stripos($column->dbType,'text') !== false){
            return InputTypes::textArea;
        }
        elseif(stripos($column->dbType,'date') !== false){
            return InputTypes::dateBox;
        }
        elseif(stripos($column->dbType,'datetime') !== false){
            return InputTypes::dateTimeBox;
        }
        elseif(stripos($column->dbType,'varchar') !== false){
            return InputTypes::textBox;
        }
        elseif($column->name=="gallery_id"){
            return InputTypes::gallery;
        }
    }

    public static function checkSlugExist($table){
        foreach($table->columns as $column){
            if(InputTypes::checkColumnType($column)==InputTypes::slug)
                return true;
        }
        return false;
    }

    public static function checkColumnsDateExist($table){
        foreach($table->columns as $column){
            if(InputTypes::checkColumnType($column)==InputTypes::dateTimeBox || InputTypes::checkColumnType($column)==InputTypes::dateBox)
                return true;
        }
        return false;
    }

    public static function checkGalleryExist($table){
        foreach($table->columns as $column){
            if(InputTypes::checkColumnType($column)==InputTypes::gallery)
                return true;
        }
        return false;
    }

    public static function checkImageExist($table){
        foreach($table->columns as $column){
            if(InputTypes::checkColumnType($column)==InputTypes::image)
                return true;
        }
        return false;
    }

}