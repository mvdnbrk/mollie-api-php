<?php

/*
 * Example 25 - Updating an existing subscription via the Mollie API.
 */

use Mollie\Api\Exceptions\ApiException;

try {
    /*
     * Initialize the Mollie API library with your API key or OAuth access token.
     */
    require "./initialize.php";

    /*
     * Retrieve an existing subscription
     */
    $customer = $mollie->customers->get("cst_cUe8HjeBuz");
    $subscription = $customer->getSubscription("sub_DRjwaT5qHx");

    /**
     * Subscription fields that can be updated are described by the link:
     * See https://docs.mollie.com/reference/v2/subscriptions-api/update-subscription
     */
    $subscription->times = 10;
    $subscription->startDate = '2018-12-02'; // Year-month-day
    $subscription->amount = (object)['amount' => '12.12', 'currency' => 'EUR'];
    $subscription->webhookUrl = 'https://some-webhook-url.com/with/path';
    $subscription->description = 'Monthly subscription';
    $subscription->update();

    echo "<p>Subscription updated: " . $subscription->id . "</p>";
} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}