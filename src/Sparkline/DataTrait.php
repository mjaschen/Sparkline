<?php

namespace Davaxi\Sparkline;

/**
 * Trait DataTrait.
 */
trait DataTrait
{
    /**
     * @var int
     *          Base of value
     */
    protected $base;

    /**
     * @var int
     *          Original value of chart
     */
    protected $originValue = 0;

    /**
     * @var array
     */
    protected $data = [0, 0];

    /**
     * @param $base
     * Set base for values
     */
    public function setBase($base)
    {
        $this->base = $base;
    }

    /**
     * @param float $originValue
     *                           Set origin value of chart
     */
    public function setOriginValue($originValue)
    {
        $this->originValue = $originValue;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $data = array_values($data);
        $count = count($data);
        if (!$count) {
            $this->data = [0, 0];

            return;
        }
        if ($count < static::MIN_DATA_LENGTH) {
            $this->data = array_fill(0, 2, $data[0]);

            return;
        }
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getNormalizedData()
    {
        $data = $this->data;
        foreach ($data as $i => $value) {
            $data[$i] = max(0, $value - $this->originValue);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->data);
    }

    /**
     * @return int
     */
    public function getMaxValue()
    {
        return max($this->data);
    }

    /**
     * @return mixed
     */
    public function getMinValue()
    {
        return min($this->data);
    }
}
