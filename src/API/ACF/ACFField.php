<?php
namespace Sarcofag\API\ACF;


use Sarcofag\API\WP;
use Sarcofag\Exception\RuntimeException;
use Sarcofag\Filter\WidgetIdFilter;

class ACFField
{
    /**
     * @var WP
     */
    protected $wpService;

    /**
     * @var WidgetIdFilter
     */
    protected $widgetIdFilter;

    /**
     * ACFField constructor.
     *
     * @param WP $wpService
     * @param WidgetIdFilter $widgetIdFilter
     */
    public function __construct(WP $wpService, WidgetIdFilter $widgetIdFilter)
    {
        $this->wpService = $wpService;
        $this->widgetIdFilter = $widgetIdFilter;
    }

    /**
     * @param string $name
     * @param string $widgetId
     *
     * @return mixed
     */
    public function getWidgetField($name, $widgetId)
    {
        if (!class_exists( 'acf' )) {
            throw new RuntimeException('ACF plugin not active.');
        }
        
        return $this->wpService->get_field($name, 'widget_'.$this->widgetIdFilter->filter($widgetId));
    }
}
