<?php
class Hackathon_FixtureGenerator_Model_Processor_Category extends  Hackathon_FixtureGenerator_Model_Processor_Abstract
{
    protected $type = "category";

    protected $requiredKeys = array(
        'entity_id',
        'name'
    );

    /**
     * Process the given data
     *
     * @param array $data
     * @return mixed
     */
    public function process(array $data)
    {
        $numberOfIterations = 1;

        if (isset($data['number'])){
            $numberOfIterations = $data['number'];
            unset($data['number']);
        }

        $data = array_merge($this->getDefaultData(), $data);

        $this->initialize($data);

        $categories = array();
        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $categoryData = $this->generate($data);
            $categories[] = $categoryData;
        }

        return $categories;
    }
}