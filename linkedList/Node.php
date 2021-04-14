<?php
/**
 * Node of the list
 * 
 * PHP version 7.4.3
 * @author Igor Gomes Oliveira Ramos <igor.gomesz55@gmail.com>
 */
class Node {
    public int $data;
    public Node $next;

    function __construct(int $data) {
        $this->data = $data;
    }
}