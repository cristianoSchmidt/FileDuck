<?php


interface iProvider
{
    public function __construct( $lang  , $config );
    public function trans( $key );
}
