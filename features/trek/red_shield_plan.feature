# features/page_loading/red_shield_plan.feature
Feature: Red Shield Plan
  In order to confirm a page is loading
  Page content needs to appear.

  @javascript
  Scenario: Red Shield Plan
    Given I am on "http://www.trekbikes.com/us/en/support/red_shield_plan/"
    Then I should see "Extend the ride"