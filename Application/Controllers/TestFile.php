<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/6/14
 * Time: 3:22 PM
 */
interface OutputInterface
{
    public function load();
}
class JsonOutput implements OutputInterface
{
    private $data;
    public function __construct($sampleData)
    {
        $this->data = $sampleData;
    }
    public function load()
    {
        return json_encode($this->data);
    }
}
class SerializeOutput implements OutputInterface
{
    private $data;
    public function __construct($sampleData)
    {
        $this->data = $sampleData;
    }
    public function load()
    {
        return serialize($data);
    }
}
class SomeClient
{
    private $output;

    public function setOutput(OutputInterface $outputInterface)
    {
        $this->output = $outputInterface;
    }

    public function loadOutput()
    {
        $this->output->load();
    }
}
$sampleData = ['a'=>'b'];
$client = new SomeClient();
$client->setOutput(new JsonOutput($sampleData));
$data = $client->loadOutput();