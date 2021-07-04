<?php

namespace Drupal\commerce_custom_fees;

use Drupal\commerce_order\Adjustment;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\commerce_order\OrderProcessorInterface;
use Drupal\commerce_price\Price;

/**
 * Add fees on certain conditions.
 */
class FeeOrderProcessor implements OrderProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function process(OrderInterface $order) {
    $payment = $order->get('payment_gateway')->first()->entity;
    if ($payment->id() == 'cod') {
      $fee = 1.8;
      $order->addAdjustment(new Adjustment([
        'type' => 'fee',
        'label' => $payment->label(),
        'amount' => new Price($fee, 'EUR')
      ]));  
    } 
  }
}