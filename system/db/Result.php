<?php
    namespace DB;

    /**
     * Database result when Query is performed regardless query is successful or
     * failed.
     *
     * @package Core
     */
    class Result
    {
        private $sql;
        private $data;
        private $dataLength = 0;

        private $pos = 0;

        public function __construct($sql, $data)
        {
            $this->sql = $sql;
            $this->data = $data;
            $this->dataLength = count($data);
        }

        /**
         * Get syntax used when performing the query
         *
         * @return string SQL Syntax
         */
        public function syntax()
        {
            return $this->sql;
        }

        /**
         * Change result pointer position
         *
         * @param  string $pos Pointer position
         */
        public function seek($pos)
        {
            $this->pos = ($pos > $this->dataLength) ? $this->dataLength-1: $pos;
        }

        /**
         * Reset result pointer to first row element.
         */
        public function reset()
        {
            $this->pos = 0;
        }

        /**
         * Get query result per row
         *
         * @return array Result row
         */
        public function row()
        {
            return $this->at($this->pos++);
        }

        /**
         * Get query result count
         *
         * @return int Query result count
         */
        public function count()
        {
            return $this->dataLength;
        }

        /**
         * Get first row from query result data
         *
         * @return array First row on Query result
         */
        public function first()
        {
            return $this->at(0);
        }

        /**
         * Get query result at specific row
         *
         * @param  int $pos Row number, start with 0
         *
         * @return array    Row on query result
         */
        public function at($pos)
        {
            return isset($this->data[$pos]) ? $this->data[$pos] : false;
        }

        /**
         * Get last row from query result
         *
         * @return array Last Row on query result
         */
        public function last()
        {
            return $this->at($this->dataLength-1);
        }
    }

?>
