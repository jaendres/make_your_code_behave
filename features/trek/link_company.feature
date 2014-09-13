# features/link_company.feature
Feature: Company
  In order to spread word about the company
  We need a section of the site to display the information


  @javascript
  Scenario: Landing Page loads
    Given I am on "http://www.trekbikes.com/us/en/company"
    Then I should see "Believe"

  @javascript
  Scenario: Products Page load
    Given I am on "http://www.trekbikes.com/us/en/company"
    When I click on the element with css selector "li.products a"
    Then I should be on "/us/en/company/products/"
    And I should see "We believe in bikes"