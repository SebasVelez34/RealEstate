<?php

class QueryBuilder
{

    /**
     * Permite obtener el archivo JSON llamado 'data-1.json'
     * @author = Sebastián Vélez Velásquez
     * @param 'data-1.json' $jsonFile
     * @throws Exception
     */
    public function __construct($jsonFile = 'data-1.json')
    {
        if (!is_null($jsonFile)) {
            $path = pathinfo($jsonFile);
            $extension = isset($path['extension']) ? $path['extension'] : null;
            if ($extension != 'json') {
                throw new Exception('Archivo no es formato JSON');
            }
            $this->import($jsonFile);
        }
    }

    public function import($file = null)
    {
        if (!is_null($file)) {
            if (is_string($file) && file_exists($file)) {
                $this->_map = $this->getDataFromFile($file);
                $this->_baseContents = $this->_map;
                return true;
            }
        }

        throw new Exception();
    }

    protected function getDataFromFile($file, $type = 'application/json')
    {
        if (file_exists($file)) {
            $opts = [
                'http' => [
                    'header' => 'Content-Type: '.$type.'; charset=utf-8',
                ],
            ];

            $context = stream_context_create($opts);
            $data = file_get_contents($file, 0, $context);
            $json = $this->isJson($data, true);

            if (!$json) {
                throw new Exception();
            }

            return $json;
        }

        throw new Exception();
    }

    public function isJson($value, $isReturnMap = false)
    {
        if (is_array($value) || is_object($value)) {
            return false;
        }

        $data = json_decode($value, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $isReturnMap ? $data : true;
    }

    public function from($node = null)
    {
        $this->_isProcessed = false;

        if (is_null($node) || $node == '') {
            throw new Exception("Null node exception");
        }

        $this->_node = $node;

        return $this;
    }
}
